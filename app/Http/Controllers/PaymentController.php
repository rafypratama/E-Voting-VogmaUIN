<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Create a new vote transaction and get Midtrans Snap Token or enter Simulator Mode.
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'voter_name' => 'required|string|max:100',
            'voter_email' => 'required|email|max:100',
            'voter_whatsapp' => 'required|string|max:20',
            'vote_amount' => 'required|integer|min:1',
        ]);

        $candidate = Candidate::findOrFail($request->candidate_id);
        
        // Calculate price: 1 vote = Rp 1.000
        $pricePerVote = 1000;
        $baseVotes = $request->vote_amount;
        $bonusVotes = 0;

        // Apply premium gold bundles bonuses
        if ($baseVotes == 25) {
            $bonusVotes = 2;
        } elseif ($baseVotes == 50) {
            $bonusVotes = 5;
        } elseif ($baseVotes == 100) {
            $bonusVotes = 15;
        }

        $totalVotesCredited = $baseVotes + $bonusVotes;
        $priceTotal = $baseVotes * $pricePerVote;

        // Generate custom invoice ID: VOG-UIN-XXXXX
        $invoiceId = 'VOG-UIN-' . strtoupper(Str::random(6));

        // Create initial pending payment record
        $payment = Payment::create([
            'id' => $invoiceId,
            'candidate_id' => $candidate->id,
            'voter_name' => $request->voter_name,
            'voter_email' => $request->voter_email,
            'voter_whatsapp' => $request->voter_whatsapp,
            'vote_amount' => $totalVotesCredited, // Credit including bonus votes!
            'price_total' => $priceTotal,
            'payment_status' => 'pending',
            'payment_method' => 'Pending Checkout',
        ]);

        // Check if Midtrans keys are set in .env
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        $clientKey = env('MIDTRANS_CLIENT_KEY');

        if ($serverKey && $clientKey) {
            // Midtrans is fully configured! Request a Snap Token
            $baseUrl = $isProduction 
                ? 'https://app.midtrans.com/snap/v1/transactions' 
                : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $payload = [
                'transaction_details' => [
                    'order_id' => $invoiceId,
                    'gross_amount' => (int) $priceTotal,
                ],
                'item_details' => [
                    [
                        'id' => 'VOTE-' . $candidate->candidate_number,
                        'price' => (int) $pricePerVote,
                        'quantity' => (int) $baseVotes,
                        'name' => 'Vote Duta ' . $candidate->name . ' (' . ($totalVotesCredited) . ' Suara)',
                    ]
                ],
                'customer_details' => [
                    'first_name' => $request->voter_name,
                    'email' => $request->voter_email,
                    'phone' => $request->voter_whatsapp,
                ],
                'callbacks' => [
                    'finish' => route('home') . '?invoice=' . $invoiceId
                ]
            ];

            try {
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->withBasicAuth($serverKey, '')
                ->post($baseUrl, $payload);

                if ($response->successful()) {
                    $snapToken = $response->json()['token'];
                    
                    // Update Snap Token in payment database
                    $payment->update([
                        'midtrans_snap_token' => $snapToken,
                        'payment_method' => 'Midtrans Snap',
                    ]);

                    return response()->json([
                        'success' => true,
                        'mode' => 'midtrans',
                        'invoice_id' => $invoiceId,
                        'snap_token' => $snapToken,
                        'client_key' => $clientKey,
                        'is_production' => $isProduction,
                        'price_total' => $priceTotal,
                        'total_votes' => $totalVotesCredited
                    ]);
                } else {
                    Log::error('Midtrans API Failed: ' . $response->body());
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal menghubungi gerbang pembayaran Midtrans. Silakan coba beberapa saat lagi.'
                    ], 500);
                }
            } catch (\Exception $e) {
                Log::error('Midtrans Exception: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan koneksi saat memproses pembayaran. Silakan coba beberapa saat lagi.'
                ], 500);
            }
        }

        // Fallback to EXQUISITE SIMULATOR MODE (Only when Midtrans is not configured in .env)
        return response()->json([
            'success' => true,
            'mode' => 'simulator',
            'invoice_id' => $invoiceId,
            'price_total' => $priceTotal,
            'total_votes' => $totalVotesCredited,
            'candidate_name' => $candidate->name,
            'candidate_number' => $candidate->candidate_number,
            'voter_name' => $request->voter_name
        ]);
    }

    /**
     * Handle Midtrans Webhook Callback notifications.
     */
    public function callback(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Webhook Callback Received:', $payload);

        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;
        $transactionId = $payload['transaction_id'] ?? null;

        if (!$orderId || !$signatureKey || !$statusCode || !$grossAmount) {
            return response()->json(['success' => false, 'message' => 'Invalid payload'], 400);
        }

        // Verify Signature
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($localSignature !== $signatureKey) {
            Log::warning('Midtrans Callback Signature Verification Failed for order: ' . $orderId);
            return response()->json(['success' => false, 'message' => 'Signature verification failed'], 403);
        }

        // Find payment
        $payment = Payment::where('id', $orderId)->first();

        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        // Process status changes
        if ($payment->payment_status !== 'success') {
            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                // Success!
                $payment->update([
                    'payment_status' => 'success',
                    'payment_method' => strtoupper($paymentType),
                    'midtrans_transaction_id' => $transactionId,
                    'completed_at' => now(),
                ]);

                // Increment Candidate's current_votes
                $candidate = Candidate::find($payment->candidate_id);
                if ($candidate) {
                    $candidate->increment('current_votes', $payment->vote_amount);
                }

                Log::info("Payment Success via Webhook: {$orderId}. Added {$payment->vote_amount} votes for Candidate ID {$payment->candidate_id}");
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'failed'])) {
                $payment->update(['payment_status' => 'failed']);
            } elseif ($transactionStatus === 'expire') {
                $payment->update(['payment_status' => 'expired']);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Simulate Payment Success instantly in Simulator Mode.
     */
    public function simulateSuccess(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $clientKey = env('MIDTRANS_CLIENT_KEY');

        if ($serverKey && $clientKey) {
            return response()->json([
                'success' => false,
                'message' => 'Mode Simulator diblokir karena gerbang pembayaran Midtrans sedang aktif.'
            ], 403);
        }

        $request->validate(['invoice_id' => 'required|exists:payments,id']);

        $payment = Payment::findOrFail($request->invoice_id);

        if ($payment->payment_status === 'success') {
            return response()->json([
                'success' => true,
                'message' => 'Payment has already been simulated as success.'
            ]);
        }

        // Set success
        $payment->update([
            'payment_status' => 'success',
            'payment_method' => $request->payment_method ?? 'SIMULATOR_QRIS',
            'completed_at' => now(),
        ]);

        // Increment votes
        $candidate = Candidate::find($payment->candidate_id);
        if ($candidate) {
            $candidate->increment('current_votes', $payment->vote_amount);
        }

        return response()->json([
            'success' => true,
            'message' => 'Simulation successful! Vote has been recorded.',
            'data' => [
                'invoice_id' => $payment->id,
                'voter_name' => $payment->voter_name,
                'vote_amount' => $payment->vote_amount,
                'candidate_name' => $candidate->name,
                'current_votes' => $candidate->current_votes
            ]
        ]);
    }

    /**
     * Get transaction status details (real-time checking for UI).
     */
    public function checkStatus($invoice_id)
    {
        $payment = Payment::with('candidate')->where('id', $invoice_id)->first();

        if (!$payment) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $payment->id,
                'voter_name' => $payment->voter_name,
                'voter_email' => $payment->voter_email,
                'voter_whatsapp' => $payment->voter_whatsapp,
                'vote_amount' => $payment->vote_amount,
                'price_total' => $payment->price_total,
                'payment_method' => $payment->payment_method ?? 'Belum Dibayar',
                'payment_status' => $payment->payment_status,
                'candidate' => [
                    'name' => $payment->candidate->name,
                    'candidate_number' => $payment->candidate->candidate_number,
                    'gender' => $payment->candidate->gender,
                    'faculty' => $payment->candidate->faculty,
                ],
                'completed_at' => $payment->completed_at ? $payment->completed_at->format('d M Y H:i:s') : null,
            ]
        ]);
    }

    /**
     * Render the official luxury supporter certificate.
     */
    public function receipt($invoice_id)
    {
        $payment = Payment::with('candidate')->where('id', $invoice_id)->firstOrFail();

        if ($payment->payment_status !== 'success') {
            abort(403, 'Invoice ini belum berhasil dibayar.');
        }

        return view('receipt', compact('payment'));
    }
}
