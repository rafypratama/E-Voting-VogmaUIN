@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Statistics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat card 1: Revenue -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl relative overflow-hidden shadow-lg shadow-black/20">
        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-gray-400 font-bold">TOTAL PENDAPATAN</span>
            <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-400 shrink-0">
                Rp
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-white font-serif">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        <span class="text-[10px] text-gray-500 mt-2 block">Dihitung dari semua vote berbayar sukses</span>
    </div>

    <!-- Stat card 2: Votes -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl relative overflow-hidden shadow-lg shadow-black/20">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-gray-400 font-bold">TOTAL SUARA MASUK</span>
            <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-400 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-white font-serif">{{ number_format($totalVotes) }} Suara</span>
        <span class="text-[10px] text-gray-500 mt-2 block">Akumulasi real-time secara nasional</span>
    </div>

    <!-- Stat card 3: Candidates -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl relative overflow-hidden shadow-lg shadow-black/20">
        <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-gray-400 font-bold">FINALIS DUTA KAMPUS</span>
            <div class="w-8 h-8 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-400 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-white font-serif">{{ $totalCandidates }} Finalis</span>
        <span class="text-[10px] text-gray-500 mt-2 block">Kategori Putra dan Putri aktif</span>
    </div>

    <!-- Stat card 4: Admins -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl relative overflow-hidden shadow-lg shadow-black/20">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-gray-400 font-bold">PENGGUNA ADMINISTRATOR</span>
            <div class="w-8 h-8 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-400 shrink-0">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-white font-serif">{{ $totalAdmins }} Pengguna</span>
        <span class="text-[10px] text-gray-500 mt-2 block">Akses penuh pengelolaan sistem</span>
    </div>
</div>

<!-- Standings and Analytics breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    <!-- Candidates votes bar chart standing -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl lg:col-span-2 shadow-2xl">
        <h3 class="text-sm font-bold tracking-wider uppercase text-white mb-6 border-b border-gray-800 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
            Klasemen Perolehan Suara
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Prince Column -->
            @php
                $maxPrinceVotes = $princeCandidates->max('current_votes');
            @endphp
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-amber-400 mb-5 flex items-center gap-2">
                    <span>👑</span> Klasemen Prince (Putra)
                </h4>
                <div class="space-y-4.5">
                    @forelse($princeCandidates as $candidate)
                    @php
                        $pct = $maxPrinceVotes > 0 ? ($candidate->current_votes / $maxPrinceVotes) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="px-1.5 py-0.5 rounded text-[8px] uppercase tracking-wider font-extrabold bg-[#050a08] border border-blue-500/20 text-blue-400 shrink-0">
                                    Rank {{ $loop->iteration }}
                                </span>
                                <span class="font-bold text-white truncate max-w-[130px]">{{ $candidate->name }}</span>
                                <span class="text-[9px] text-gray-500 font-semibold shrink-0">({{ $candidate->candidate_number }})</span>
                            </div>
                            <span class="font-extrabold text-blue-400 shrink-0 text-[11px]">{{ number_format($candidate->current_votes) }} Suara</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-blue-950/20 border border-white/5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-600 to-indigo-500 shadow-[0_0_8px_rgba(59,130,246,0.3)] transition-all duration-1000" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-xs">Belum ada kandidat putra.</p>
                    @endforelse
                </div>
            </div>

            <!-- Princess Column -->
            @php
                $maxPrincessVotes = $princessCandidates->max('current_votes');
            @endphp
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-pink-400 mb-5 flex items-center gap-2">
                    <span>👑</span> Klasemen Princess (Putri)
                </h4>
                <div class="space-y-4.5">
                    @forelse($princessCandidates as $candidate)
                    @php
                        $pct = $maxPrincessVotes > 0 ? ($candidate->current_votes / $maxPrincessVotes) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="px-1.5 py-0.5 rounded text-[8px] uppercase tracking-wider font-extrabold bg-[#050a08] border border-pink-500/20 text-pink-400 shrink-0">
                                    Rank {{ $loop->iteration }}
                                </span>
                                <span class="font-bold text-white truncate max-w-[130px]">{{ $candidate->name }}</span>
                                <span class="text-[9px] text-gray-500 font-semibold shrink-0">({{ $candidate->candidate_number }})</span>
                            </div>
                            <span class="font-extrabold text-pink-400 shrink-0 text-[11px]">{{ number_format($candidate->current_votes) }} Suara</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-pink-950/20 border border-white/5 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-rose-600 to-pink-500 shadow-[0_0_8px_rgba(244,63,94,0.3)] transition-all duration-1000" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-xs">Belum ada kandidat putri.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Faculty vote distribution -->
    <div class="glass-panel border border-amber-500/10 p-6 rounded-2xl shadow-2xl flex flex-col justify-between">
        <div>
            <h3 class="text-sm font-bold tracking-wider uppercase text-white mb-6 border-b border-gray-800 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                Penyebaran Suara Fakultas
            </h3>
            
            <div class="space-y-4">
                @foreach($facultyVotes as $fac)
                @php
                    $facPct = $totalVotes > 0 ? ($fac->total_votes / $totalVotes) * 100 : 0;
                @endphp
                <div>
                    <div class="flex justify-between items-center text-xs mb-1">
                        <span class="text-gray-300 font-medium truncate max-w-[150px]">{{ $fac->faculty }}</span>
                        <span class="font-bold text-emerald-400">{{ number_format($fac->total_votes) }} ({{ number_format($facPct, 1) }}%)</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-[#050a08]">
                        <div class="h-full rounded-full bg-amber-500 transition-all duration-700" style="width: {{ $facPct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 p-4 rounded-xl bg-amber-500/5 border border-amber-500/15 text-[10px] text-gray-400 leading-relaxed">
            <span class="font-bold text-white block mb-1">💡 Tips Admin:</span>
            Papan klasemen ini tersinkronisasi langsung dengan landing page pengguna. Jika ingin menambahkan suara offline, silakan buka menu <strong>Manajemen Finalis</strong>.
        </div>
    </div>
</div>

<!-- Recent Transactions Log -->
<div class="glass-panel border border-amber-500/10 p-6 rounded-2xl shadow-2xl">
    <div class="flex justify-between items-center border-b border-gray-800 pb-4 mb-6">
        <h3 class="text-sm font-bold tracking-wider uppercase text-white flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            Aktivitas Vote Terbaru
        </h3>
        <a href="{{ route('admin.transactions') }}" class="text-[10px] uppercase font-bold tracking-wider text-amber-400 border border-amber-500/20 hover:border-amber-400 px-3 py-1.5 rounded-lg transition-all">
            Lihat Semua Log
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-800 text-[10px] text-gray-500 uppercase tracking-widest font-semibold">
                    <th class="py-3 px-4">Invoice</th>
                    <th class="py-3 px-4">Pendukung</th>
                    <th class="py-3 px-4">WhatsApp</th>
                    <th class="py-3 px-4">Kandidat Terpilih</th>
                    <th class="py-3 px-4 text-center">Jumlah Vote</th>
                    <th class="py-3 px-4 text-right">Pembayaran</th>
                    <th class="py-3 px-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-xs divide-y divide-gray-800/50">
                @forelse($recentTransactions as $tx)
                @php
                    $statusColor = $tx->payment_status === 'success' 
                        ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' 
                        : 'text-amber-400 bg-amber-500/10 border-amber-500/20';
                @endphp
                <tr class="hover:bg-white/5 transition-all">
                    <td class="py-3.5 px-4 font-bold text-white tracking-widest">{{ $tx->id }}</td>
                    <td class="py-3.5 px-4 font-semibold text-gray-300">
                        {{ $tx->voter_name }}
                        <span class="block text-[10px] text-gray-500 font-light mt-0.5">{{ $tx->voter_email }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-gray-400">{{ $tx->voter_whatsapp }}</td>
                    <td class="py-3.5 px-4">
                        <span class="font-bold text-white">{{ $tx->candidate->gender === 'putra' ? 'Prince' : 'Princess' }} {{ $tx->candidate->name }}</span>
                        <span class="block text-[9px] text-amber-500 font-semibold uppercase mt-0.5">Nomor: {{ $tx->candidate->candidate_number }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center font-extrabold text-emerald-400">{{ number_format($tx->vote_amount) }}</td>
                    <td class="py-3.5 px-4 text-right font-semibold text-gray-300">
                        Rp {{ number_format($tx->price_total, 0, ',', '.') }}
                        <span class="block text-[9px] text-gray-500 font-light mt-0.5">Metode: {{ $tx->payment_method ?: '-' }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold border uppercase {{ $statusColor }}">
                            {{ $tx->payment_status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-500 text-xs">Belum ada aktivitas transaksi vote terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
