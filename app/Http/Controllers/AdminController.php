<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show the login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Administrator!');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang dimasukkan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    /**
     * Log out the admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar sistem.');
    }

    /**
     * Show the main admin dashboard.
     */
    public function dashboard()
    {
        $totalRevenue = Payment::where('payment_status', 'success')->sum('price_total');
        $totalVotes = Candidate::sum('current_votes');
        $totalCandidates = Candidate::count();
        $totalAdmins = User::count();

        // Candidates vote data for charts
        $candidates = Candidate::orderBy('current_votes', 'desc')->get();
        $princeCandidates = Candidate::where('gender', 'putra')->orderBy('current_votes', 'desc')->get();
        $princessCandidates = Candidate::where('gender', 'putri')->orderBy('current_votes', 'desc')->get();
        
        // Recent 5 transactions
        $recentTransactions = Payment::with('candidate')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Vote distribution by faculty
        $facultyVotes = Candidate::selectRaw('faculty, sum(current_votes) as total_votes')
            ->groupBy('faculty')
            ->orderBy('total_votes', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalVotes',
            'totalCandidates',
            'totalAdmins',
            'candidates',
            'princeCandidates',
            'princessCandidates',
            'recentTransactions',
            'facultyVotes'
        ));
    }

    /**
     * List all admin users (Admin Management).
     */
    public function listUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    /**
     * Store a new admin user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('success', 'Akun Administrator baru berhasil ditambahkan.');
    }

    /**
     * Update an admin user.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Data Administrator berhasil diperbarui.');
    }

    /**
     * Delete an admin user.
     */
    public function deleteUser($id)
    {
        // Don't let users delete their own account or the last admin
        if (Auth::id() == $id) {
            return redirect()->route('admin.users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if (User::count() <= 1) {
            return redirect()->route('admin.users')->with('error', 'Sistem membutuhkan minimal satu Administrator.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Akun Administrator berhasil dihapus.');
    }

    /**
     * List all candidates.
     */
    public function listCandidates()
    {
        $candidates = Candidate::orderBy('gender', 'asc')
            ->orderBy('candidate_number', 'asc')
            ->get();
        return view('admin.candidates', compact('candidates'));
    }

    /**
     * Store a new candidate.
     */
    public function storeCandidate(Request $request)
    {
        $request->validate([
            'candidate_number' => 'required|string|max:10|unique:candidates,candidate_number',
            'name' => 'required|string|max:100',
            'gender' => 'required|in:putra,putri',
            'faculty' => 'required|string|max:100',
            'prodi' => 'required|string|max:100',
            'photo_url' => 'required|url', // Let's support direct URL for simplicity, or upload
            'bio' => 'nullable|string',
            'vision' => 'nullable|string',
            'missions' => 'nullable|array',
        ]);

        $missions = $request->missions ? array_filter($request->missions) : [];

        Candidate::create([
            'candidate_number' => $request->candidate_number,
            'name' => $request->name,
            'gender' => $request->gender,
            'faculty' => $request->faculty,
            'prodi' => $request->prodi,
            'photo_path' => $request->photo_url,
            'bio' => $request->bio,
            'vision' => $request->vision,
            'mission' => json_encode($missions),
            'current_votes' => 0
        ]);

        return redirect()->route('admin.candidates')->with('success', 'Kandidat baru berhasil ditambahkan.');
    }

    /**
     * Update candidate details.
     */
    public function updateCandidate(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);

        $request->validate([
            'candidate_number' => 'required|string|max:10|unique:candidates,candidate_number,' . $candidate->id,
            'name' => 'required|string|max:100',
            'gender' => 'required|in:putra,putri',
            'faculty' => 'required|string|max:100',
            'prodi' => 'required|string|max:100',
            'photo_url' => 'required|url',
            'bio' => 'nullable|string',
            'vision' => 'nullable|string',
            'missions' => 'nullable|array',
        ]);

        $missions = $request->missions ? array_filter($request->missions) : [];

        $candidate->update([
            'candidate_number' => $request->candidate_number,
            'name' => $request->name,
            'gender' => $request->gender,
            'faculty' => $request->faculty,
            'prodi' => $request->prodi,
            'photo_path' => $request->photo_url,
            'bio' => $request->bio,
            'vision' => $request->vision,
            'mission' => json_encode($missions),
        ]);

        return redirect()->route('admin.candidates')->with('success', 'Data kandidat berhasil diperbarui.');
    }

    /**
     * Delete candidate.
     */
    public function deleteCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.candidates')->with('success', 'Kandidat berhasil dihapus.');
    }

    /**
     * List all transactions (Vote Log / WHO VOTED FOR WHOM).
     */
    public function listTransactions()
    {
        $transactions = Payment::with('candidate')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.transactions', compact('transactions'));
    }

    /**
     * Inject votes manually for off-line voting.
     */
    public function injectVotes(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
            'vote_amount' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:200'
        ]);

        $candidate = Candidate::findOrFail($request->candidate_id);
        $candidate->increment('current_votes', $request->vote_amount);

        // Record a success offline payment for transparency
        $invoiceId = 'OFFLINE-' . strtoupper(Str::random(6));
        Payment::create([
            'id' => $invoiceId,
            'candidate_id' => $candidate->id,
            'voter_name' => 'PANITIA OFFLINE (' . ($request->notes ?: 'Manual Inject') . ')',
            'voter_email' => 'panitia@uinmadura.ac.id',
            'voter_whatsapp' => '08000000000',
            'vote_amount' => $request->vote_amount,
            'price_total' => 0,
            'payment_status' => 'success',
            'payment_method' => 'OFFLINE_PANITIA',
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', "Berhasil menyuntikkan {$request->vote_amount} suara ke kandidat {$candidate->name} secara offline!");
    }
}
