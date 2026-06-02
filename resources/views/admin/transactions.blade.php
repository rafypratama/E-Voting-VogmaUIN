@extends('layouts.admin')

@section('title', 'Log Aktivitas & Transaksi')

@section('content')
<div class="glass-panel border border-amber-500/20 p-6 rounded-2xl shadow-lg">
    <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-6">
        <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Siapa Memilih Siapa (Log Vote)
        </h3>
        <span class="text-xs text-slate-500 font-medium">Tercatat {{ $transactions->total() }} Total Transaksi Masuk</span>
    </div>

    <!-- Search/Filters (Static mockup client-side search or native laravel) -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <input type="text" id="tx-search" oninput="filterTransactions()" placeholder="Cari nama, invoice, email, atau whatsapp..." class="flex-1 px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-700 font-medium shadow-sm">
        
        <select id="tx-status-filter" onchange="filterTransactions()" class="px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs text-slate-500 font-medium cursor-pointer shadow-sm">
            <option value="all">Semua Status</option>
            <option value="success">Success</option>
            <option value="pending">Pending</option>
        </select>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-[10px] text-slate-500 uppercase tracking-widest font-semibold">
                    <th class="py-3 px-4">Invoice</th>
                    <th class="py-3 px-4">Data Pendukung</th>
                    <th class="py-3 px-4">Kontak (WA)</th>
                    <th class="py-3 px-4">Pilihan Finalis</th>
                    <th class="py-3 px-4 text-center">Jumlah Suara</th>
                    <th class="py-3 px-4 text-right">Gross Total</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Sertifikat</th>
                </tr>
            </thead>
            <tbody id="tx-table-body" class="text-xs divide-y divide-slate-50">
                @forelse($transactions as $tx)
                @php
                    $statusColor = $tx->payment_status === 'success' 
                        ? 'text-emerald-700 bg-emerald-50 border-emerald-300' 
                        : 'text-amber-700 bg-amber-50 border-amber-300';
                @endphp
                <tr class="hover:bg-amber-50/30 transition-all tx-row" 
                    data-search="{{ strtolower($tx->id . ' ' . $tx->voter_name . ' ' . $tx->voter_email . ' ' . $tx->voter_whatsapp) }}"
                    data-status="{{ $tx->payment_status }}">
                    
                    <td class="py-3.5 px-4 font-bold text-slate-800 tracking-widest">{{ $tx->id }}</td>
                    <td class="py-3.5 px-4 font-semibold text-slate-700">
                        {{ $tx->voter_name }}
                        <span class="block text-[10px] text-slate-500 font-medium mt-0.5">{{ $tx->voter_email }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-slate-600">{{ $tx->voter_whatsapp }}</td>
                    <td class="py-3.5 px-4">
                        <span class="font-bold text-slate-800">{{ $tx->candidate->gender === 'putra' ? 'Prince' : 'Princess' }} {{ $tx->candidate->name }}</span>
                        <span class="block text-[9px] text-amber-700 font-bold uppercase mt-0.5">Nomor: {{ $tx->candidate->candidate_number }} | Kategori: {{ strtoupper($tx->candidate->gender) }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center font-extrabold text-amber-700 text-sm">{{ number_format($tx->vote_amount) }}</td>
                    <td class="py-3.5 px-4 text-right font-semibold text-slate-700">
                        Rp {{ number_format($tx->price_total, 0, ',', '.') }}
                        <span class="block text-[9px] text-slate-500 font-medium mt-0.5">Metode: {{ $tx->payment_method ?: '-' }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold border uppercase {{ $statusColor }}">
                            {{ $tx->payment_status }}
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        @if($tx->payment_status === 'success')
                        <a href="{{ route('vote.receipt', $tx->id) }}" target="_blank" class="px-2.5 py-1 rounded bg-amber-50 border border-amber-300 text-amber-700 hover:bg-amber-100 transition-all font-bold text-[9px] uppercase tracking-wide">
                            Lihat
                        </a>
                        @else
                        <span class="text-slate-400">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-slate-500 text-xs">Belum ada catatan aktivitas transaksi masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-6 pt-4 border-t border-slate-100">
        {{ $transactions->links() }}
    </div>
</div>

<script>
    function filterTransactions() {
        const query = document.getElementById('tx-search').value.toLowerCase().trim();
        const status = document.getElementById('tx-status-filter').value;
        
        document.querySelectorAll('.tx-row').forEach(row => {
            const searchData = row.getAttribute('data-search');
            const rowStatus = row.getAttribute('data-status');
            
            const matchSearch = !query || searchData.includes(query);
            const matchStatus = status === 'all' || rowStatus === status;
            
            if (matchSearch && matchStatus) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
