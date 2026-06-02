<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Voting Prince & Princess English Department UIN Madura 2026</title>
    <link rel="icon" type="image/png" href="/images/favicon.png?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fail-safe Tailwind CSS v4 CDN in case compilation is pending -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <!-- Custom Luxury Styling -->
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF5;
            color: #1A1A2E;
            overflow-x: hidden;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Royal Cream & Gold Gradients with Royal Damask Motif */
        .bg-mesh {
            background-color: #FFFDF5;
            background-image: 
                radial-gradient(at 0% 0%, rgba(245, 197, 24, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(232, 165, 152, 0.08) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(232, 229, 248, 0.3) 0px, transparent 60%);
        }

        .gold-glow {
            box-shadow: 0 10px 30px rgba(245, 197, 24, 0.15);
        }

        .gold-border {
            border: 1px solid rgba(245, 197, 24, 0.25);
        }

        .gold-border-hover {
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        .gold-border-hover:hover {
            border-color: rgba(245, 197, 24, 0.7);
            box-shadow: 0 12px 32px rgba(245, 197, 24, 0.18);
            transform: translateY(-6px);
        }

        .gold-text-gradient {
            background: linear-gradient(135deg, #F5C518 0%, #D97706 50%, #C69B00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .purple-text-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #4c1d95 50%, #8b5cf6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glassmorphism base for light theme */
        .glass-panel {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(245, 197, 24, 0.15);
        }

        .glass-navbar {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(245, 197, 24, 0.2);
            box-shadow: 0 4px 25px rgba(26, 26, 46, 0.04);
        }

        /* Card 3D Tilt Effect */
        .candidate-card {
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: transform 0.5s cubic-bezier(0.23, 1, 0.32, 1), box-shadow 0.5s;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #FFFDF5;
        }
        ::-webkit-scrollbar-thumb {
            background: #E8A598;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #F5C518;
        }

        /* Dynamic Animations */
        @keyframes floatCrown {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50%       { transform: translateY(-6px) rotate(2deg); }
        }
        .animate-float-crown {
            animation: floatCrown 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        .btn-shimmer {
            background: linear-gradient(90deg, #F5C518 25%, #FFF8C0 50%, #F5C518 75%);
            background-size: 200%;
            animation: shimmer 2s infinite linear;
        }

        @keyframes sparkle {
            0%, 100% { opacity: 0.4; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        .animate-sparkle {
            animation: sparkle 2s infinite ease-in-out;
        }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            opacity: 0;
            animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fillBar {
            from { width: 0%; }
            to   { width: var(--target-width); }
        }
        .animate-fill-bar {
            animation: fillBar 1.2s ease-out forwards;
        }

        @keyframes pulse-gold {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .pulse-glow {
            animation: pulse-gold 4s infinite;
        }

        /* Hide elements helper */
        .hidden-fade {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .show-fade {
            opacity: 1;
            pointer-events: auto;
        }

        /* 🚀 High-End Premium Scroll-Reveal Animations */
        .reveal-element {
            opacity: 0;
            transform: translateY(35px) scale(0.97);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(40px);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.9s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.9s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .revealed {
            opacity: 1 !important;
            transform: translateY(0) translateX(0) scale(1) !important;
        }
    </style>
</head>
<body class="bg-mesh min-h-screen">

    <!-- 🌌 Floating Particle/Ambient Lights -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute top-[10%] left-[5%] w-[35rem] h-[35rem] rounded-full bg-amber-200/30 blur-[120px] pulse-glow"></div>
        <div class="absolute bottom-[15%] right-[5%] w-[40rem] h-[40rem] rounded-full bg-rose-200/25 blur-[150px] pulse-glow" style="animation-delay: 2s;"></div>
    </div>

    <!-- 🧭 Premium Glassmorphism Navbar -->
    <nav class="fixed top-0 inset-x-0 z-50 glass-navbar py-3 px-6 md:px-12 flex justify-between items-center transition-all duration-300">
        <a href="#" class="flex items-center gap-2 md:gap-3">
            <!-- Logo -->
            <div class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center overflow-hidden shrink-0">
                <img src="/images/logo_vogma.png" alt="Logo" class="h-full w-full object-contain">
            </div>
            <div>
                <span class="block text-xs font-bold tracking-[0.1em] text-amber-600 leading-none">PRINCE & PRINCESS</span>
                <span class="text-[8px] md:text-[9px] tracking-[0.12em] uppercase text-slate-500 block mt-0.5">English Department UIN Madura</span>
            </div>
        </a>
        <div class="hidden md:flex items-center gap-8 text-sm font-semibold tracking-wide text-slate-700">
            <a href="#beranda" class="hover:text-amber-600 transition-colors">Beranda</a>
            <a href="#leaderboard" class="hover:text-amber-600 transition-colors">Papan Klasemen</a>
            <a href="#finalis" class="hover:text-amber-600 transition-colors">Kandidat Duta</a>
            <a href="#faq" class="hover:text-amber-600 transition-colors">Informasi</a>
            <a href="#lookup" class="hover:text-amber-600 transition-colors">Cek Invoice</a>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.login') }}" class="text-xs font-bold uppercase tracking-widest border border-amber-500/50 hover:border-amber-500 px-4 py-2 rounded-full text-amber-700 hover:bg-amber-50 transition-all">
                Admin Panel
            </a>
        </div>
    </nav>

    <!-- 🏛️ Welcome / Hero Section -->
    <header id="beranda" class="relative pt-32 pb-20 px-6 md:px-12 flex flex-col items-center text-center max-w-7xl mx-auto z-10">
        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel border border-amber-500/30 shadow-lg mb-8 animate-bounce reveal-scale">
            <span class="w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
            <span class="text-xs font-bold tracking-widest text-amber-700 uppercase">PRINCE & PRINCESS ENGLISH DEPARTMENT</span>
        </div>
        
        <!-- Headline -->
        <h1 class="text-4xl md:text-7xl font-serif font-bold tracking-tight max-w-5xl leading-tight mb-8 reveal-element text-slate-800">
            Beauty in the Journey, <br class="hidden md:block">
            <span class="gold-text-gradient">Together will be Free</span>
        </h1>
        
        <p class="text-slate-600 text-sm md:text-lg max-w-2xl leading-relaxed mb-12 reveal-element">
            Pilihlah Representasi Terbaik Prince & Princess English Department UIN Madura 2026. Dukung kandidat favoritmu melalui e-voting terintegrasi pembayaran digital aman. Satu suara Anda menentukan masa depan akademik-budaya.
        </p>

        <!-- Stats Panel -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-full max-w-4xl glass-panel p-6 rounded-2xl border border-amber-500/20 mb-16 shadow-2xl relative overflow-hidden reveal-scale">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-50/10 to-rose-50/10 opacity-50"></div>
            <div class="relative text-center border-r border-slate-200">
                <span class="block text-2xl md:text-4xl font-extrabold text-amber-600 font-serif">{{ number_format($totalVotes) }}</span>
                <span class="text-[10px] md:text-xs text-slate-500 uppercase tracking-widest mt-1 block">Total Suara Masuk</span>
            </div>
            <div class="relative text-center border-r border-slate-200">
                <span class="block text-2xl md:text-4xl font-extrabold text-rose-500 font-serif">{{ $totalCandidates }}</span>
                <span class="text-[10px] md:text-xs text-slate-500 uppercase tracking-widest mt-1 block">Finalis Duta</span>
            </div>
            <div class="relative text-center border-r border-slate-200">
                <span class="block text-2xl md:text-4xl font-extrabold text-amber-600 font-serif">{{ $totalFaculties }}</span>
                <span class="text-[10px] md:text-xs text-slate-500 uppercase tracking-widest mt-1 block">Fakultas Terlibat</span>
            </div>
            <div class="relative text-center">
                <span id="countdown" class="block text-xl md:text-2xl font-extrabold text-rose-500 font-serif py-1">12 Hari Terbuka</span>
                <span class="text-[10px] md:text-xs text-slate-500 uppercase tracking-widest mt-1 block">Waktu Voting Tersisa</span>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 items-center justify-center reveal-element">
            <a href="#finalis" class="px-8 py-4 rounded-full btn-shimmer text-slate-900 font-bold tracking-wider hover:scale-105 hover:shadow-lg transition-all text-sm uppercase">
                Jelajahi Kandidat
            </a>
            <a href="#leaderboard" class="px-8 py-4 rounded-full border border-rose-400/30 hover:border-amber-400 text-amber-700 font-semibold tracking-wider hover:bg-amber-50 transition-all text-sm uppercase">
                Lihat Klasemen Live
            </a>
        </div>
    </header>

    <!-- 🏆 Interactive Leaderboard Section -->
    <section id="leaderboard" class="py-20 px-6 md:px-12 max-w-7xl mx-auto z-10 relative">
        <div class="text-center mb-16 reveal-element">
            <h2 class="text-3xl md:text-5xl font-serif font-bold mb-4 text-slate-800">Papan <span class="gold-text-gradient">Klasemen</span></h2>
            <p class="text-slate-600 max-w-md mx-auto text-xs md:text-sm">Posisi klasemen perolehan suara ter-update secara otomatis begitu transaksi pembayaran pendukung sukses diverifikasi.</p>
        </div>

        <!-- Category Tabs -->
        <div class="flex justify-center gap-4 mb-12 reveal-scale">
            <button onclick="switchLeaderboard('putra')" id="btn-tab-putra" class="px-6 py-2.5 rounded-full font-bold tracking-wider text-sm transition-all duration-300 bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 shadow-md">
                Kategori Putra
            </button>
            <button onclick="switchLeaderboard('putri')" id="btn-tab-putri" class="px-6 py-2.5 rounded-full font-bold tracking-wider text-sm transition-all duration-300 border border-slate-300 text-slate-500 hover:text-slate-900 hover:bg-slate-50">
                Kategori Putri
            </button>
        </div>

        <!-- 👑 PUTRA LEADERBOARD DISPLAY -->
        <div id="leaderboard-putra" class="space-y-12">
            <!-- 🏆 3D CSS Aesthetic Podium -->
            <div class="grid grid-cols-3 gap-2 md:gap-6 items-end max-w-3xl mx-auto mb-16 pt-16 reveal-scale">
                <!-- 🥈 Rank 2 (Left) -->
                @if($podiumPutraAesthetic->has(0))
                <div class="flex flex-col items-center">
                    <div class="relative w-16 h-16 md:w-28 md:h-28 rounded-full border-4 border-slate-300 overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutraAesthetic[0]->photo_path }}" alt="{{ $podiumPutraAesthetic[0]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutraAesthetic[0]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-800 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutraAesthetic[0]->name)[0] }}</span>
                    <span class="text-[10px] md:text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutraAesthetic[0]->current_votes) }} Suara</span>
                    
                    <!-- Silver Podium Base -->
                    <div class="w-full h-20 md:h-32 bg-gradient-to-t from-slate-200 via-slate-100 to-white border border-slate-300/50 rounded-t-xl mt-4 flex items-center justify-center shadow-lg relative">
                        <span class="text-2xl md:text-5xl font-extrabold text-slate-400 font-serif">2</span>
                    </div>
                </div>
                @endif

                <!-- 🥇 Rank 1 (Center) -->
                @if($podiumPutraAesthetic->has(1))
                <div class="flex flex-col items-center">
                    <!-- Elegant Crown over Rank 1 -->
                    <div class="animate-float-crown">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-amber-500 animate-sparkle mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="relative w-20 h-20 md:w-36 md:h-36 rounded-full border-4 border-amber-400 overflow-hidden shadow-2xl shadow-amber-500/10 hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutraAesthetic[1]->photo_path }}" alt="{{ $podiumPutraAesthetic[1]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutraAesthetic[1]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-900 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutraAesthetic[1]->name)[0] }}</span>
                    <span class="text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutraAesthetic[1]->current_votes) }} Suara</span>
                    
                    <!-- Gold Podium Base -->
                    <div class="w-full h-28 md:h-44 bg-gradient-to-t from-amber-100 via-amber-50 to-white border border-amber-300/50 rounded-t-2xl mt-4 flex items-center justify-center shadow-xl relative">
                        <span class="text-3xl md:text-6xl font-extrabold text-amber-500 font-serif">1</span>
                    </div>
                </div>
                @endif

                <!-- 🥉 Rank 3 (Right) -->
                @if($podiumPutraAesthetic->has(2))
                <div class="flex flex-col items-center">
                    <div class="relative w-14 h-14 md:w-24 md:h-24 rounded-full border-4 border-orange-300 overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutraAesthetic[2]->photo_path }}" alt="{{ $podiumPutraAesthetic[2]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutraAesthetic[2]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-800 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutraAesthetic[2]->name)[0] }}</span>
                    <span class="text-[10px] md:text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutraAesthetic[2]->current_votes) }} Suara</span>
                    
                    <!-- Bronze Podium Base -->
                    <div class="w-full h-16 md:h-24 bg-gradient-to-t from-orange-100 via-orange-50 to-white border border-orange-200/50 rounded-t-xl mt-4 flex items-center justify-center shadow-lg relative">
                        <span class="text-xl md:text-4xl font-extrabold text-orange-400 font-serif">3</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Table Standings -->
            <div class="max-w-4xl mx-auto glass-panel border border-amber-500/25 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-amber-500/5 text-slate-600 text-[10px] md:text-xs uppercase tracking-widest font-bold">
                                <th class="py-4 px-6">Rank</th>
                                <th class="py-4 px-6">Nomor</th>
                                <th class="py-4 px-6">Nama Finalis</th>
                                <th class="py-4 px-6">Fakultas</th>
                                <th class="py-4 px-6 text-right">Total Suara</th>
                                <th class="py-4 px-6 text-right">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs md:text-sm divide-y divide-slate-100 bg-white/40">
                            @foreach($putraLeaderboard as $index => $item)
                            <tr class="hover:bg-amber-50/50 transition-all">
                                <td class="py-4 px-6 font-bold text-slate-500">#{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-amber-600">{{ $item->candidate_number }}</td>
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center gap-3">
                                    <img src="{{ $item->photo_path }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                    {{ $item->name }}
                                </td>
                                <td class="py-4 px-6 text-slate-600">{{ $item->faculty }}</td>
                                <td class="py-4 px-6 text-right font-extrabold text-amber-600">{{ number_format($item->current_votes) }}</td>
                                <td class="py-4 px-6 text-right font-bold text-slate-700">
                                    {{ $totalVotes > 0 ? number_format(($item->current_votes / $totalVotes) * 100, 1) : 0 }}%
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 👑 PUTRI LEADERBOARD DISPLAY -->
        <div id="leaderboard-putri" class="space-y-12 hidden">
            <!-- 🏆 3D CSS Aesthetic Podium -->
            <div class="grid grid-cols-3 gap-2 md:gap-6 items-end max-w-3xl mx-auto mb-16 pt-16 reveal-scale">
                <!-- 🥈 Rank 2 -->
                @if($podiumPutriAesthetic->has(0))
                <div class="flex flex-col items-center">
                    <div class="relative w-16 h-16 md:w-28 md:h-28 rounded-full border-4 border-slate-300 overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutriAesthetic[0]->photo_path }}" alt="{{ $podiumPutriAesthetic[0]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutriAesthetic[0]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-800 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutriAesthetic[0]->name)[0] }}</span>
                    <span class="text-[10px] md:text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutriAesthetic[0]->current_votes) }} Suara</span>
                    
                    <!-- Silver Podium Base -->
                    <div class="w-full h-20 md:h-32 bg-gradient-to-t from-slate-200 via-slate-100 to-white border border-slate-300/50 rounded-t-xl mt-4 flex items-center justify-center shadow-lg relative">
                        <span class="text-2xl md:text-5xl font-extrabold text-slate-400 font-serif">2</span>
                    </div>
                </div>
                @endif

                <!-- 🥇 Rank 1 -->
                @if($podiumPutriAesthetic->has(1))
                <div class="flex flex-col items-center">
                    <div class="animate-float-crown">
                        <svg class="w-8 h-8 md:w-12 md:h-12 text-amber-500 animate-sparkle mb-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="relative w-20 h-20 md:w-36 md:h-36 rounded-full border-4 border-amber-400 overflow-hidden shadow-2xl shadow-amber-500/10 hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutriAesthetic[1]->photo_path }}" alt="{{ $podiumPutriAesthetic[1]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutriAesthetic[1]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-900 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutriAesthetic[1]->name)[0] }}</span>
                    <span class="text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutriAesthetic[1]->current_votes) }} Suara</span>
                    
                    <!-- Gold Podium Base -->
                    <div class="w-full h-28 md:h-44 bg-gradient-to-t from-amber-100 via-amber-50 to-white border border-amber-300/50 rounded-t-2xl mt-4 flex items-center justify-center shadow-xl relative">
                        <span class="text-3xl md:text-6xl font-extrabold text-amber-500 font-serif">1</span>
                    </div>
                </div>
                @endif

                <!-- 🥉 Rank 3 -->
                @if($podiumPutriAesthetic->has(2))
                <div class="flex flex-col items-center">
                    <div class="relative w-14 h-14 md:w-24 md:h-24 rounded-full border-4 border-orange-300 overflow-hidden shadow-2xl hover:scale-105 transition-transform duration-300">
                        <img src="{{ $podiumPutriAesthetic[2]->photo_path }}" alt="{{ $podiumPutriAesthetic[2]->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <span class="absolute bottom-1 inset-x-0 text-center text-[10px] md:text-xs font-bold text-white uppercase">{{ $podiumPutriAesthetic[2]->candidate_number }}</span>
                    </div>
                    <span class="text-xs md:text-sm font-bold tracking-wide text-slate-800 mt-3 text-center truncate max-w-full">{{ explode(' ', $podiumPutriAesthetic[2]->name)[0] }}</span>
                    <span class="text-[10px] md:text-xs text-amber-600 font-bold mt-1">{{ number_format($podiumPutriAesthetic[2]->current_votes) }} Suara</span>
                    
                    <!-- Bronze Podium Base -->
                    <div class="w-full h-16 md:h-24 bg-gradient-to-t from-orange-100 via-orange-50 to-white border border-orange-200/50 rounded-t-xl mt-4 flex items-center justify-center shadow-lg relative">
                        <span class="text-xl md:text-4xl font-extrabold text-orange-400 font-serif">3</span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Table Standings -->
            <div class="max-w-4xl mx-auto glass-panel border border-amber-500/25 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 bg-amber-500/5 text-slate-600 text-[10px] md:text-xs uppercase tracking-widest font-bold">
                                <th class="py-4 px-6">Rank</th>
                                <th class="py-4 px-6">Nomor</th>
                                <th class="py-4 px-6">Nama Finalis</th>
                                <th class="py-4 px-6">Fakultas</th>
                                <th class="py-4 px-6 text-right">Total Suara</th>
                                <th class="py-4 px-6 text-right">Persentase</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs md:text-sm divide-y divide-slate-100 bg-white/40">
                            @foreach($putriLeaderboard as $index => $item)
                            <tr class="hover:bg-amber-50/50 transition-all">
                                <td class="py-4 px-6 font-bold text-slate-500">#{{ $index + 1 }}</td>
                                <td class="py-4 px-6 font-bold text-amber-600">{{ $item->candidate_number }}</td>
                                <td class="py-4 px-6 font-bold text-slate-800 flex items-center gap-3">
                                    <img src="{{ $item->photo_path }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                    {{ $item->name }}
                                </td>
                                <td class="py-4 px-6 text-slate-600">{{ $item->faculty }}</td>
                                <td class="py-4 px-6 text-right font-extrabold text-amber-600">{{ number_format($item->current_votes) }}</td>
                                <td class="py-4 px-6 text-right font-bold text-slate-700">
                                    {{ $totalVotes > 0 ? number_format(($item->current_votes / $totalVotes) * 100, 1) : 0 }}%
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- 👥 Showcase Candidates Grid -->
    <section id="finalis" class="py-20 px-6 md:px-12 max-w-7xl mx-auto z-10 relative">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="reveal-left">
                <h2 class="text-3xl md:text-5xl font-serif font-bold mb-4 text-slate-800">Daftar Finalis <span class="gold-text-gradient">Unggulan</span></h2>
                <p class="text-slate-600 text-xs md:text-sm">Jelajahi profil lengkap, visi, misi, dan dukung langsung kandidat favorit Anda.</p>
            </div>
            
            <!-- Search & Filter Controls -->
            <div class="flex flex-wrap gap-3 items-center w-full md:w-auto reveal-right">
                <input type="text" id="candidate-search" oninput="filterCandidates()" placeholder="Cari nama finalis..." class="px-5 py-3 rounded-full bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm placeholder-slate-400 text-slate-700 shadow-sm w-full sm:w-64">
                
                <select id="gender-filter" onchange="filterCandidates()" class="px-4 py-3 rounded-full bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-medium cursor-pointer shadow-sm">
                    <option value="all">Semua Kategori</option>
                    <option value="putra">Putra</option>
                    <option value="putri">Putri</option>
                </select>

                <select id="faculty-filter" onchange="filterCandidates()" class="px-4 py-3 rounded-full bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-medium cursor-pointer shadow-sm">
                    <option value="all">Semua Fakultas</option>
                    @foreach($candidates->pluck('faculty')->unique() as $faculty)
                    <option value="{{ $faculty }}">{{ $faculty }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- 3D Card Grid -->
        <div id="candidates-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($candidates as $candidate)
            <div class="candidate-item candidate-card group relative rounded-3xl glass-panel border border-amber-500/20 p-4 gold-border-hover transition-all duration-500 flex flex-col justify-between reveal-element shadow-md"
                 data-id="{{ $candidate->id }}"
                 data-name="{{ strtolower($candidate->name) }}"
                 data-gender="{{ $candidate->gender }}"
                 data-faculty="{{ $candidate->faculty }}"
                 data-prodi="{{ strtolower($candidate->prodi) }}">
                
                <div>
                    <!-- Portrait Image Frame -->
                    <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-6 group-hover:shadow-2xl transition-all duration-500">
                        <img src="{{ $candidate->photo_path }}" alt="{{ $candidate->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                        
                        <!-- Floating Category Badge -->
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-amber-500/90 border border-amber-400/30 text-slate-900 shadow-md">
                            {{ $candidate->gender }}
                        </span>
 
                        <!-- Candidate Number Circle -->
                        <div class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-400 shadow-lg flex items-center justify-center">
                            <span class="text-slate-900 font-bold text-lg font-serif">{{ $candidate->candidate_number }}</span>
                        </div>
                    </div>
 
                    <!-- Finalist Details -->
                    <div class="px-2">
                        <h3 class="text-lg font-bold font-serif text-slate-800 tracking-wide leading-snug group-hover:text-amber-600 transition-colors mb-1">{{ $candidate->name }}</h3>
                        <span class="text-xs font-bold text-rose-500 tracking-wider block mb-3 uppercase">{{ $candidate->faculty }} &bull; {{ $candidate->prodi }}</span>
                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-6 font-medium italic">"{{ $candidate->bio }}"</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2 mt-4 px-2 pb-2">
                    <button onclick="openDetailModal({{ $candidate->id }})" class="flex-1 px-4 py-2.5 rounded-xl border border-amber-500/30 hover:border-amber-500 text-amber-700 font-bold text-xs transition-all uppercase tracking-wider hover:bg-amber-50">
                        Profil
                    </button>
                    <button onclick="openCheckoutModal({{ $candidate->id }}, '{{ $candidate->name }}', '{{ $candidate->candidate_number }}', '{{ $candidate->gender }}')" class="flex-1 px-4 py-2.5 rounded-xl btn-shimmer text-slate-900 hover:shadow-lg font-bold text-xs transition-all uppercase tracking-wider">
                        Vote
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Empty State Search -->
        <div id="search-empty-state" class="hidden text-center py-20">
            <svg class="w-16 h-16 text-amber-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Finalis Tidak Ditemukan</h3>
            <p class="text-slate-600 text-sm">Coba cari dengan kata kunci lain atau bersihkan filter.</p>
        </div>
    </section>

    <!-- 🙋 FAQ / Information Accordion -->
    <section id="faq" class="py-20 px-6 md:px-12 max-w-4xl mx-auto z-10 relative">
        <div class="text-center mb-16 reveal-element">
            <h2 class="text-3xl md:text-5xl font-serif font-bold mb-4 text-slate-800">Informasi & <span class="gold-text-gradient">Panduan Vote</span></h2>
            <p class="text-slate-600 text-xs md:text-sm">Pertanyaan umum seputar pemilihan dan integrasi sistem pembayaran.</p>
        </div>

        <div class="space-y-4 reveal-scale">
            <!-- FAQ 1 -->
            <div class="glass-panel border border-amber-500/20 rounded-2xl overflow-hidden transition-all duration-300 shadow-sm">
                <button onclick="toggleFaq(1)" class="w-full text-left p-6 flex justify-between items-center gap-4 focus:outline-none bg-white/40">
                    <span class="font-bold text-sm md:text-base text-slate-800 hover:text-amber-600 transition-colors">Bagaimana cara memberikan dukungan suara (vote)?</span>
                    <span id="faq-icon-1" class="text-amber-600 font-bold transition-transform duration-300">+</span>
                </button>
                <div id="faq-ans-1" class="max-h-0 overflow-hidden transition-all duration-500">
                    <div class="p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-slate-100 bg-white/20 leading-relaxed">
                        Anda dapat mengklik tombol "Vote" pada kandidat pilihan Anda, memilih paket jumlah vote (atau kustom), melengkapi data diri, dan melanjutkan pembayaran menggunakan Midtrans. Setelah pembayaran berhasil, suara Anda langsung diakumulasikan ke papan klasemen.
                    </div>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="glass-panel border border-amber-500/20 rounded-2xl overflow-hidden transition-all duration-300 shadow-sm">
                <button onclick="toggleFaq(2)" class="w-full text-left p-6 flex justify-between items-center gap-4 focus:outline-none bg-white/40">
                    <span class="font-bold text-sm md:text-base text-slate-800 hover:text-amber-600 transition-colors">Apakah metode pembayarannya aman dan terintegrasi?</span>
                    <span id="faq-icon-2" class="text-amber-600 font-bold transition-transform duration-300">+</span>
                </button>
                <div id="faq-ans-2" class="max-h-0 overflow-hidden transition-all duration-500">
                    <div class="p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-slate-100 bg-white/20 leading-relaxed">
                        Sistem ini menggunakan gerbang pembayaran Midtrans resmi yang terenkripsi dan diverifikasi oleh Bank Indonesia. Mendukung QRIS, GoPay, ShopeePay, dan Transfer Virtual Account bank terpopuler.
                    </div>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="glass-panel border border-amber-500/20 rounded-2xl overflow-hidden transition-all duration-300 shadow-sm">
                <button onclick="toggleFaq(3)" class="w-full text-left p-6 flex justify-between items-center gap-4 focus:outline-none bg-white/40">
                    <span class="font-bold text-sm md:text-base text-slate-800 hover:text-amber-600 transition-colors">Apakah saya mendapatkan sertifikat / tanda terima resmi?</span>
                    <span id="faq-icon-3" class="text-amber-600 font-bold transition-transform duration-300">+</span>
                </button>
                <div id="faq-ans-3" class="max-h-0 overflow-hidden transition-all duration-500">
                    <div class="p-6 pt-0 text-xs md:text-sm text-slate-600 border-t border-slate-100 bg-white/20 leading-relaxed">
                        Ya! Setiap pendukung yang sukses memberikan vote berbayar akan mendapatkan **"Sertifikat Bukti Vote Resmi"** yang mewah dalam bentuk halaman cetak siap diunduh berformat PDF/Kertas A4 untuk koleksi/tanda partisipasi resmi.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🔍 Invoice Lookup Section -->
    <section id="lookup" class="py-20 px-6 md:px-12 max-w-4xl mx-auto z-10 relative">
        <div class="glass-panel border border-amber-500/30 rounded-3xl p-8 md:p-12 text-center shadow-2xl relative overflow-hidden reveal-scale bg-white/80">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full blur-2xl"></div>
            
            <h2 class="text-2xl md:text-4xl font-serif font-bold mb-4 text-slate-800">Verifikasi & Lacak <span class="gold-text-gradient">Transaksi</span></h2>
            <p class="text-slate-600 max-w-lg mx-auto text-xs md:text-sm mb-8 leading-relaxed">Masukkan Kode Invoice Anda (misal: VOG-UIN-AAAAAA) di bawah ini untuk melihat status transaksi dan mengunduh ulang Sertifikat Bukti Vote.</p>

            <form onsubmit="handleInvoiceLookup(event)" class="flex flex-col sm:flex-row gap-3 max-w-xl mx-auto">
                <input type="text" id="lookup-invoice-id" placeholder="Masukkan Kode Invoice (e.g. VOG-UIN-ABCDEF)" required class="flex-1 px-5 py-4 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm placeholder-slate-400 text-slate-700 font-semibold uppercase shadow-sm">
                <button type="submit" class="px-6 py-4 rounded-xl btn-shimmer text-slate-900 font-bold tracking-wide hover:shadow-lg transition-all text-xs uppercase">
                    Lacak Vote
                </button>
            </form>

            <!-- Results container -->
            <div id="lookup-results" class="hidden mt-8 text-left p-6 rounded-2xl bg-white/90 border border-amber-500/20 shadow-md">
                <!-- dynamic content -->
            </div>
        </div>
    </section>

    <!-- 👣 Footer -->
    <footer class="border-t border-amber-100 bg-amber-50/50 py-12 px-6 md:px-12 text-center text-slate-500 text-xs tracking-wider z-10 relative reveal-element">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <!-- Logo -->
                <div class="w-10 h-10 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="/images/logo_vogma.png" alt="Logo" class="h-full w-full object-contain">
                </div>
                <span class="font-bold text-slate-600">PRINCE & PRINCESS &copy; 2026 | ENGLISH DEPARTMENT UIN MADURA</span>
            </div>
            <p class="text-slate-500">Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </footer>

    <!-- ==================== 🎭 MODALS CONTAINER ==================== -->

    <!-- 🔎 MODAL 1: CANDIDATE DETAIL PROFILE -->
    <div id="detail-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm hidden-fade">
        <div class="relative w-full max-w-4xl glass-panel border border-amber-500/30 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row max-h-[90vh] md:max-h-[85vh] bg-white">
            <!-- Close button -->
            <button onclick="closeDetailModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-white/90 text-slate-600 hover:text-slate-900 flex items-center justify-center border border-slate-200 hover:border-amber-500 shadow-md transition-all focus:outline-none">
                &times;
            </button>

            <!-- Left: Photo -->
            <div class="w-full md:w-2/5 aspect-[3/4] md:aspect-auto relative bg-slate-50">
                <img id="modal-photo" src="" alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-slate-900/60 md:from-transparent to-transparent"></div>
                <span id="modal-gender-badge" class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-amber-500/90 border border-amber-400/30 text-slate-900 shadow-md"></span>
            </div>

            <!-- Right: Content Scrollable -->
            <div class="w-full md:w-3/5 p-6 md:p-10 overflow-y-auto flex flex-col justify-between">
                <div>
                    <!-- Title block -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-400 flex items-center justify-center shrink-0 shadow-sm">
                            <span id="modal-number" class="text-slate-900 font-bold text-lg font-serif"></span>
                        </div>
                        <div>
                            <h3 id="modal-name" class="text-xl md:text-2xl font-serif font-bold text-slate-800 leading-tight"></h3>
                            <span id="modal-faculty" class="text-xs font-bold text-rose-500 uppercase tracking-wider block"></span>
                        </div>
                    </div>

                    <hr class="border-slate-100 my-6">

                    <!-- Bio -->
                    <div class="mb-6">
                        <h4 class="text-xs uppercase tracking-widest text-amber-600 font-bold mb-2">Biografi Pendek</h4>
                        <p id="modal-bio" class="text-xs md:text-sm text-slate-600 leading-relaxed font-medium italic"></p>
                    </div>

                    <!-- Vision -->
                    <div class="mb-6">
                        <h4 class="text-xs uppercase tracking-widest text-amber-600 font-bold mb-2">Visi Utama</h4>
                        <p id="modal-vision" class="text-xs md:text-sm text-slate-700 leading-relaxed font-bold italic border-l-2 border-amber-400 pl-3"></p>
                    </div>

                    <!-- Mission -->
                    <div class="mb-6">
                        <h4 class="text-xs uppercase tracking-widest text-amber-600 font-bold mb-2">Misi Aksi</h4>
                        <ul id="modal-missions" class="space-y-2 text-xs md:text-sm text-slate-600 list-disc pl-4 leading-relaxed font-medium">
                            <!-- dynamic -->
                        </ul>
                    </div>
                </div>

                <!-- Action inside modal -->
                <div class="mt-8">
                    <button id="modal-vote-btn" class="w-full py-3.5 rounded-xl btn-shimmer text-slate-900 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase shadow-md">
                        Vote Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- 💳 MODAL 2: DYNAMIC MULTI-STEP CHECKOUT -->
    <div id="checkout-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/80 backdrop-blur-sm hidden-fade">
        <div class="w-full max-w-lg glass-panel border border-amber-500/30 rounded-3xl overflow-hidden shadow-2xl p-6 md:p-8 relative max-h-[95vh] overflow-y-auto bg-white">
            
            <!-- Close button -->
            <button onclick="closeCheckoutModal()" class="absolute top-4 right-4 z-10 w-8 h-8 rounded-full bg-white/90 text-slate-600 hover:text-slate-900 flex items-center justify-center border border-slate-200 hover:border-amber-500 shadow-md transition-all focus:outline-none">
                &times;
            </button>

            <!-- Checkout Header -->
            <div class="text-center mb-6">
                <span class="text-[10px] tracking-widest uppercase text-amber-600 font-bold">PORTAL CHECKOUT VOTE</span>
                <h3 id="checkout-title" class="text-lg md:text-xl font-serif font-bold text-slate-800 mt-1">Dukung Duta</h3>
            </div>

            <!-- Steps Progress Tracker -->
            <div class="flex items-center justify-center gap-3 mb-8">
                <div id="step-dot-1" class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                <div class="w-8 h-[1px] bg-slate-200" id="step-line-1"></div>
                <div id="step-dot-2" class="w-2.5 h-2.5 rounded-full bg-slate-200"></div>
                <div class="w-8 h-[1px] bg-slate-200" id="step-line-2"></div>
                <div id="step-dot-3" class="w-2.5 h-2.5 rounded-full bg-slate-200"></div>
                <div class="w-8 h-[1px] bg-slate-200" id="step-line-3"></div>
                <div id="step-dot-4" class="w-2.5 h-2.5 rounded-full bg-slate-200"></div>
            </div>

            <!-- hidden variables -->
            <input type="hidden" id="checkout-candidate-id">

            <!-- ==================== STEP 1: SELECT PACKAGE & DATA ==================== -->
            <div id="checkout-step-1" class="space-y-6">
                <!-- Package Select Grid -->
                <div>
                    <label class="block text-xs uppercase tracking-wider text-amber-600 font-bold mb-3">Pilih Paket Dukungan</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" onclick="selectPackage(5)" class="package-card p-3 rounded-xl border border-amber-500/20 hover:border-amber-500 bg-white text-left transition-all relative overflow-hidden group shadow-sm">
                            <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">5 Votes</span>
                            <span class="block text-[10px] text-slate-500 mt-1">Rp 5.000</span>
                        </button>
                        <button type="button" onclick="selectPackage(25)" class="package-card p-3 rounded-xl border border-amber-500/20 hover:border-amber-500 bg-white text-left transition-all relative overflow-hidden group shadow-sm">
                            <span class="absolute top-1 right-1 bg-amber-500 text-slate-900 font-bold text-[8px] px-1 rounded-sm">BEST VALUE</span>
                            <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">25 Votes (+2)</span>
                            <span class="block text-[10px] text-slate-500 mt-1">Rp 25.000</span>
                        </button>
                        <button type="button" onclick="selectPackage(50)" class="package-card p-3 rounded-xl border border-amber-500/20 hover:border-amber-500 bg-white text-left transition-all relative overflow-hidden group shadow-sm">
                            <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">50 Votes (+5)</span>
                            <span class="block text-[10px] text-slate-500 mt-1">Rp 50.000</span>
                        </button>
                        <button type="button" onclick="selectPackage(100)" class="package-card p-3 rounded-xl border border-amber-500 bg-amber-50 text-left transition-all relative overflow-hidden group shadow-md shadow-amber-500/5">
                            <span class="absolute top-1 right-1 bg-amber-500 text-slate-900 font-bold text-[8px] px-1 rounded-sm">POPULER</span>
                            <span class="block text-xs font-bold text-amber-600">100 Votes (+15)</span>
                            <span class="block text-[10px] text-slate-500 mt-1">Rp 100.000</span>
                        </button>
                    </div>

                    <!-- Custom input -->
                    <div class="mt-3">
                        <input type="number" id="checkout-custom-votes" oninput="calculateCustomPrice(this.value)" placeholder="Atau ketik jumlah vote kustom..." min="1" class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                        <span id="custom-price-hint" class="block text-[10px] text-amber-600 mt-1.5 font-bold"></span>
                    </div>
                </div>

                <!-- Voter Information -->
                <div class="space-y-3">
                    <label class="block text-xs uppercase tracking-wider text-amber-600 font-bold">Biodata Pemilih</label>
                    <input type="text" id="checkout-voter-name" placeholder="Nama Lengkap Pemilih..." required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                    <input type="email" id="checkout-voter-email" placeholder="Alamat Email Pemilih..." required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                    <input type="tel" id="checkout-voter-whatsapp" placeholder="Nomor WhatsApp (Aktif)..." required class="w-full px-4 py-3 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                </div>

                <button type="button" onclick="goToStep2()" class="w-full py-3.5 rounded-xl btn-shimmer text-slate-900 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase mt-6">
                    Lanjut Pilih Pembayaran
                </button>
            </div>

            <!-- ==================== STEP 2: SIMULATOR METHOD SELECT ==================== -->
            <div id="checkout-step-2" class="space-y-6 hidden">
                <label class="block text-xs uppercase tracking-wider text-amber-600 font-bold mb-3">Pilih Metode Pembayaran</label>
                <div class="grid grid-cols-1 gap-3">
                    <button type="button" onclick="selectPaymentMethod('QRIS')" class="payment-method-card p-4 rounded-xl border border-amber-500 bg-amber-50/50 text-left transition-all flex items-center justify-between group shadow-sm">
                        <div class="flex items-center gap-3">
                            <!-- QRIS icon placeholder -->
                            <div class="w-10 h-6 bg-slate-100 rounded border border-slate-200 flex items-center justify-center shrink-0">
                                <span class="text-[8px] font-bold text-rose-500">QRIS</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">QRIS (Gopay, OVO, ShopeePay, Dana)</span>
                                <span class="block text-[9px] text-amber-600 font-bold">Biaya Admin: Rp 0 (Instan)</span>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('VA_BCA')" class="payment-method-card p-4 rounded-xl border border-amber-500/20 hover:border-amber-500/40 bg-white text-left transition-all flex items-center justify-between group shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-6 bg-slate-100 rounded border border-slate-200 flex items-center justify-center shrink-0">
                                <span class="text-[8px] font-extrabold text-blue-500">BCA</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">BCA Virtual Account</span>
                                <span class="block text-[9px] text-slate-500">Diverifikasi dalam 1 menit</span>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span>
                    </button>

                    <button type="button" onclick="selectPaymentMethod('VA_MANDIRI')" class="payment-method-card p-4 rounded-xl border border-amber-500/20 hover:border-amber-500/40 bg-white text-left transition-all flex items-center justify-between group shadow-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-6 bg-slate-100 rounded border border-slate-200 flex items-center justify-center shrink-0">
                                <span class="text-[8px] font-extrabold text-yellow-600">MANDIRI</span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-slate-800 group-hover:text-amber-600">Mandiri Virtual Account</span>
                                <span class="block text-[9px] text-slate-500">Diverifikasi dalam 1 menit</span>
                            </div>
                        </div>
                        <span class="w-2.5 h-2.5 rounded-full bg-slate-200"></span>
                    </button>
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="button" onclick="backToStep(1)" class="flex-1 py-3.5 rounded-xl border border-slate-300 text-slate-700 font-bold tracking-wider transition-all text-xs uppercase hover:bg-slate-50">
                        Kembali
                    </button>
                    <button type="button" onclick="submitCheckout()" class="flex-1 py-3.5 rounded-xl btn-shimmer text-slate-900 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase">
                        Bayar Sekarang
                    </button>
                </div>
            </div>

            <!-- ==================== STEP 3: TRANSACTION DETAILS & SIMULATOR ==================== -->
            <div id="checkout-step-3" class="space-y-6 hidden">
                <div class="p-6 rounded-2xl bg-amber-50/50 border border-amber-500/20 text-center relative overflow-hidden shadow-inner">
                    <div class="absolute top-2 right-2 flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-amber-500/20 border border-amber-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                        <span class="text-[8px] font-bold text-amber-700 uppercase tracking-widest">Simulator Mode</span>
                    </div>

                    <span class="text-[10px] text-slate-500 uppercase tracking-widest block mb-1">KODE INVOICE</span>
                    <span id="simulator-invoice-id" class="text-lg font-bold font-serif text-slate-800 tracking-widest block mb-4">VOG-UIN-XXXXXX</span>
                    
                    <div class="flex justify-between items-center text-xs py-2.5 border-t border-b border-slate-200">
                        <span class="text-slate-500">Dukungan Untuk:</span>
                        <span id="simulator-candidate-details" class="font-bold text-slate-800">Putra 01</span>
                    </div>
                    <div class="flex justify-between items-center text-xs py-2.5 border-b border-slate-200">
                        <span class="text-slate-500">Jumlah Vote:</span>
                        <span id="simulator-vote-amount" class="font-bold text-amber-600">50 Votes</span>
                    </div>
                    <div class="flex justify-between items-center text-xs py-2.5 border-b border-slate-200 mb-6">
                        <span class="text-slate-500">Total Pembayaran:</span>
                        <span id="simulator-price-total" class="font-extrabold text-amber-600 text-sm">Rp 50.000</span>
                    </div>

                    <!-- QRIS DISPLAY -->
                    <div id="simulator-qris-display" class="flex flex-col items-center">
                        <div class="w-44 h-44 p-3 bg-white rounded-2xl shadow-xl flex items-center justify-center mb-4 border border-amber-500/20">
                            <!-- Realistic QR Code Mock -->
                            <svg class="w-36 h-36 text-slate-800" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm1 1h2v2H5V5zm9-3h8v8h-8V2zm2 2v4h4V4h-4zm1 1h2v2h-2V5zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm1 1h2v2H5v-2zm12-3h3v2h-3v-2zm3 3h2v3h-2v-3zm-3 3h3v2h-3v-2zm-3-6h2v3h-2v-3zm3 0h2v2h-2v-2zm-3 3h2v5h-2v-5zm6-3h2v2h-2v-2zm0 5h2v3h-2v-3zm-6-2h2v2h-2v-2zm3 2h2v2h-2v-2z"/>
                            </svg>
                        </div>
                        <span class="text-[10px] text-slate-500 uppercase tracking-widest animate-pulse font-medium">Pindai Kode QRIS di atas untuk membayar</span>
                    </div>

                    <!-- VIRTUAL ACCOUNT DISPLAY -->
                    <div id="simulator-va-display" class="hidden text-left space-y-3">
                        <div class="p-4 rounded-xl bg-white border border-amber-500/20 shadow-sm">
                            <span class="text-[10px] text-slate-500 uppercase tracking-wider block mb-1">Nomor Virtual Account</span>
                            <div class="flex justify-between items-center">
                                <span id="simulator-va-number" class="text-lg font-bold tracking-widest text-slate-800 font-serif">88270812345678</span>
                                <button onclick="copyVaText()" class="text-[10px] uppercase font-bold text-amber-700 border border-amber-500/30 px-2.5 py-1 rounded hover:bg-amber-50 transition-all bg-white">Salin</button>
                            </div>
                        </div>
                        <div class="text-xs text-slate-600 space-y-1">
                            <span class="block font-bold text-slate-800">Petunjuk Transfer:</span>
                            <span class="block">1. Salin nomor Virtual Account di atas.</span>
                            <span class="block">2. Gunakan M-Banking/ATM pilihan Anda untuk mentransfer.</span>
                            <span class="block">3. Jumlah tagihan harus sesuai persis dengan nominal di atas.</span>
                        </div>
                    </div>
                </div>

                <!-- Simulation controls -->
                <button type="button" onclick="simulatePaymentSuccess()" class="w-full py-4 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold tracking-wider hover:scale-[1.02] transition-all text-xs uppercase shadow-md">
                    Simulasikan Pembayaran Sukses
                </button>
            </div>

            <!-- ==================== STEP 4: SUCCESS CELEBRATION ==================== -->
            <div id="checkout-step-4" class="text-center space-y-6 hidden">
                <div class="flex flex-col items-center">
                    <!-- Elegant success checkmark -->
                    <div class="w-16 h-16 rounded-full bg-emerald-50 border-2 border-emerald-500 flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    <span class="text-[10px] text-emerald-600 font-extrabold uppercase tracking-widest">Transaksi Berhasil</span>
                    <h3 class="text-xl md:text-2xl font-serif font-bold text-slate-800 mt-1">Terima Kasih Atas Dukungan Anda</h3>
                    <p class="text-slate-600 text-xs md:text-sm mt-3 max-w-sm mx-auto leading-relaxed">
                        Suara Anda telah sukses diverifikasi dan langsung ditambahkan ke kandidat pilihan Anda pada klasemen real-time.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200 text-left space-y-3 max-w-sm mx-auto shadow-inner">
                    <div class="flex justify-between text-xs py-1 border-b border-slate-200">
                        <span class="text-slate-500">No. Invoice:</span>
                        <span id="success-invoice-id" class="font-bold text-slate-800">VOG-UIN-78A16</span>
                    </div>
                    <div class="flex justify-between text-xs py-1 border-b border-slate-200">
                        <span class="text-slate-500">Pendukung:</span>
                        <span id="success-voter-name" class="font-bold text-slate-800">Rafy Pratama</span>
                    </div>
                    <div class="flex justify-between text-xs py-1 border-b border-slate-200">
                        <span class="text-slate-500">Jumlah Vote:</span>
                        <span id="success-vote-amount" class="font-bold text-emerald-600">115 Votes</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2 max-w-sm mx-auto pt-4">
                    <a id="success-certificate-btn" href="#" target="_blank" class="w-full py-3.5 rounded-xl btn-shimmer text-slate-900 font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase flex items-center justify-center gap-2">
                        <!-- Certificate Icon -->
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Cetak Sertifikat Vote
                    </a>
                    
                    <a id="success-whatsapp-btn" href="#" target="_blank" class="w-full py-3.5 rounded-xl border border-emerald-500 text-emerald-600 font-bold tracking-wide transition-all text-xs uppercase flex items-center justify-center gap-2 hover:bg-emerald-50">
                        <!-- Whatsapp Icon -->
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.517 2.266 2.27 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.725 1.451 5.402.002 9.799-4.393 9.802-9.799.002-2.618-1.01-5.078-2.852-6.921-1.843-1.843-4.297-2.857-6.917-2.859-5.405 0-9.802 4.393-9.806 9.8-.001 1.992.519 3.93 1.508 5.662l-1.007 3.679 3.77-.988z"/>
                        </svg>
                        Bagikan ke WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- ==================== 🎉 CLIENT JS INTERACTION ==================== -->
    <script>
        // Set Countdown timer target: 12 days from now
        const targetDate = new Date();
        targetDate.setDate(targetDate.getDate() + 12);
        
        function updateCountdown() {
            const now = new Date().getTime();
            const difference = targetDate.getTime() - now;
            
            const days = Math.floor(difference / (1000 * 60 * 60 * 24));
            const hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);
            
            const countdownEl = document.getElementById('countdown');
            if (countdownEl) {
                if (difference < 0) {
                    countdownEl.innerHTML = "Voting Selesai";
                } else {
                    countdownEl.innerHTML = `${days}h : ${hours}j : ${minutes}m : ${seconds}d`;
                }
            }
        }
        
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // 3D Card Tilt Effect on Mouse Move
        document.querySelectorAll('.candidate-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width/2;
                const y = e.clientY - rect.top - rect.height/2;
                
                card.style.transform = `perspective(1000px) rotateY(${x / 12}deg) rotateX(${-y / 12}deg) scale3d(1.02, 1.02, 1.02)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg) scale3d(1, 1, 1)';
            });
        });

        // Search & Filter
        function filterCandidates() {
            const query = document.getElementById('candidate-search').value.toLowerCase();
            const gender = document.getElementById('gender-filter').value;
            const faculty = document.getElementById('faculty-filter').value;
            
            let visibleCount = 0;

            document.querySelectorAll('.candidate-item').forEach(card => {
                const nameMatch = card.getAttribute('data-name').includes(query) || (card.getAttribute('data-prodi') && card.getAttribute('data-prodi').includes(query));
                const genderMatch = (gender === 'all' || card.getAttribute('data-gender') === gender);
                const facultyMatch = (faculty === 'all' || card.getAttribute('data-faculty') === faculty);
                
                if (nameMatch && genderMatch && facultyMatch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('search-empty-state');
            const grid = document.getElementById('candidates-grid');
            if (visibleCount === 0) {
                emptyState.classList.remove('hidden');
                grid.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                grid.classList.remove('hidden');
            }
        }

        // Leaderboard switch tab
        function switchLeaderboard(category) {
            const tabPutra = document.getElementById('btn-tab-putra');
            const tabPutri = document.getElementById('btn-tab-putri');
            const boardPutra = document.getElementById('leaderboard-putra');
            const boardPutri = document.getElementById('leaderboard-putri');

            if (category === 'putra') {
                tabPutra.className = "px-6 py-2.5 rounded-full font-semibold tracking-wider text-sm transition-all duration-300 bg-gradient-to-r from-amber-600 to-yellow-500 text-emerald-950 shadow-md";
                tabPutri.className = "px-6 py-2.5 rounded-full font-semibold tracking-wider text-sm transition-all duration-300 border border-gray-800 text-gray-400 hover:text-white";
                boardPutra.classList.remove('hidden');
                boardPutri.classList.add('hidden');
            } else {
                tabPutri.className = "px-6 py-2.5 rounded-full font-semibold tracking-wider text-sm transition-all duration-300 bg-gradient-to-r from-amber-600 to-yellow-500 text-emerald-950 shadow-md";
                tabPutra.className = "px-6 py-2.5 rounded-full font-semibold tracking-wider text-sm transition-all duration-300 border border-gray-800 text-gray-400 hover:text-white";
                boardPutri.classList.remove('hidden');
                boardPutra.classList.add('hidden');
            }
        }

        // FAQ accordion
        function toggleFaq(num) {
            const ans = document.getElementById(`faq-ans-${num}`);
            const icon = document.getElementById(`faq-icon-${num}`);
            
            if (ans.style.maxHeight === '0px' || !ans.style.maxHeight) {
                ans.style.maxHeight = ans.scrollHeight + 'px';
                icon.innerHTML = '&minus;';
                icon.style.transform = 'rotate(180deg)';
            } else {
                ans.style.maxHeight = '0px';
                icon.innerHTML = '+';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // --- 🔎 DETAIL MODAL SCRIPTS ---
        function openDetailModal(id) {
            fetch(`/candidate/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const item = data.data;
                        document.getElementById('modal-photo').src = item.photo_path;
                        document.getElementById('modal-photo').alt = item.name;
                        document.getElementById('modal-gender-badge').innerHTML = item.gender;
                        document.getElementById('modal-number').innerHTML = item.candidate_number;
                        document.getElementById('modal-name').innerHTML = item.name;
                        document.getElementById('modal-faculty').innerHTML = `${item.faculty} &bull; ${item.prodi || 'Tadris Bahasa Inggris'}`;
                        document.getElementById('modal-bio').innerHTML = `"${item.bio}"`;
                        document.getElementById('modal-vision').innerHTML = item.vision;
                        
                        // Missions rendering
                        const missionsContainer = document.getElementById('modal-missions');
                        missionsContainer.innerHTML = '';
                        item.missions.forEach(mission => {
                            const li = document.createElement('li');
                            li.innerHTML = mission;
                            missionsContainer.appendChild(li);
                        });

                        // Set checkout btn action inside modal
                        document.getElementById('modal-vote-btn').onclick = function() {
                            closeDetailModal();
                            openCheckoutModal(item.id, item.name, item.candidate_number, item.gender);
                        };

                        const modal = document.getElementById('detail-modal');
                        modal.classList.remove('hidden');
                        setTimeout(() => modal.classList.add('show-fade'), 50);
                    }
                });
        }

        function closeDetailModal() {
            const modal = document.getElementById('detail-modal');
            modal.classList.remove('show-fade');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        // --- 💳 CHECKOUT MODAL SCRIPTS ---
        let selectedVotes = 5;
        let checkoutPaymentMethod = 'QRIS';

        function openCheckoutModal(id, name, number, gender) {
            document.getElementById('checkout-candidate-id').value = id;
            document.getElementById('checkout-title').innerHTML = `Dukung Duta: ${name} (${number})`;
            
            // Set default selected package: Harapan (5 votes)
            selectPackage(5);

            // Back to Step 1
            backToStep(1);

            const modal = document.getElementById('checkout-modal');
            modal.classList.remove('hidden');
            setTimeout(() => modal.classList.add('show-fade'), 50);
        }

        function closeCheckoutModal() {
            const modal = document.getElementById('checkout-modal');
            modal.classList.remove('show-fade');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }

        function selectPackage(amount) {
            selectedVotes = amount;
            
            // Remove custom input value
            document.getElementById('checkout-custom-votes').value = '';
            document.getElementById('custom-price-hint').innerHTML = '';

            // Update border visual
            document.querySelectorAll('.package-card').forEach(card => {
                card.classList.remove('border-amber-500', 'border-amber-500/40', 'bg-amber-500/5');
                card.classList.add('border-gray-800', 'bg-emerald-950/5');
            });

            // Highlight selected card
            const cards = document.querySelectorAll('.package-card');
            if (amount === 5) cards[0].className = "package-card p-3 rounded-xl border border-amber-500/50 bg-amber-500/5 text-left transition-all relative overflow-hidden group";
            if (amount === 25) cards[1].className = "package-card p-3 rounded-xl border border-amber-500/50 bg-amber-500/5 text-left transition-all relative overflow-hidden group";
            if (amount === 50) cards[2].className = "package-card p-3 rounded-xl border border-amber-500/50 bg-amber-500/5 text-left transition-all relative overflow-hidden group";
            if (amount === 100) cards[3].className = "package-card p-3 rounded-xl border border-amber-500/50 bg-amber-500/5 text-left transition-all relative overflow-hidden group shadow-lg shadow-amber-500/5";
        }

        function calculateCustomPrice(value) {
            if (value > 0) {
                selectedVotes = parseInt(value);
                const price = selectedVotes * 1000;
                document.getElementById('custom-price-hint').innerHTML = `Nominal Pembayaran: Rp ${price.toLocaleString('id-ID')} (1 vote = Rp 1.000)`;

                // Remove highlight from pre-defined packages
                document.querySelectorAll('.package-card').forEach(card => {
                    card.className = "package-card p-3 rounded-xl border border-gray-800 bg-emerald-950/5 text-left transition-all relative overflow-hidden group";
                });
            } else {
                document.getElementById('custom-price-hint').innerHTML = '';
            }
        }

        function selectPaymentMethod(method) {
            checkoutPaymentMethod = method;

            // Update visuals
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.className = "payment-method-card p-4 rounded-xl border border-gray-800 hover:border-amber-500/30 bg-emerald-950/5 text-left transition-all flex items-center justify-between group";
                card.querySelector('.rounded-full').className = "w-2.5 h-2.5 rounded-full bg-gray-800";
            });

            // Find selected button
            const btn = event.currentTarget;
            btn.className = "payment-method-card p-4 rounded-xl border border-amber-500/50 bg-amber-500/5 text-left transition-all flex items-center justify-between group";
            btn.querySelector('.rounded-full').className = "w-2.5 h-2.5 rounded-full bg-amber-500";
        }

        function goToStep2() {
            // Validate form
            const name = document.getElementById('checkout-voter-name').value;
            const email = document.getElementById('checkout-voter-email').value;
            const whatsapp = document.getElementById('checkout-voter-whatsapp').value;

            if (!name || !email || !whatsapp || selectedVotes < 1) {
                alert('Silakan isi biodata lengkap dan pilih jumlah vote.');
                return;
            }

            // Update dots
            document.getElementById('step-dot-2').classList.replace('bg-gray-800', 'bg-amber-500');
            document.getElementById('step-line-1').classList.replace('bg-gray-800', 'bg-amber-500/50');

            document.getElementById('checkout-step-1').classList.add('hidden');
            document.getElementById('checkout-step-2').classList.remove('hidden');
        }

        function backToStep(num) {
            if (num === 1) {
                document.getElementById('step-dot-2').classList.replace('bg-amber-500', 'bg-gray-800');
                document.getElementById('step-line-1').classList.replace('bg-amber-500/50', 'bg-gray-800');
                
                document.getElementById('checkout-step-2').classList.add('hidden');
                document.getElementById('checkout-step-1').classList.remove('hidden');
            } else if (num === 2) {
                document.getElementById('step-dot-3').classList.replace('bg-amber-500', 'bg-gray-800');
                document.getElementById('step-line-2').classList.replace('bg-amber-500/50', 'bg-gray-800');

                document.getElementById('checkout-step-3').classList.add('hidden');
                document.getElementById('checkout-step-2').classList.remove('hidden');
            }
        }

        // --- SUBMIT CHECKOUT FORM ---
        function submitCheckout() {
            const candidateId = document.getElementById('checkout-candidate-id').value;
            const name = document.getElementById('checkout-voter-name').value;
            const email = document.getElementById('checkout-voter-email').value;
            const whatsapp = document.getElementById('checkout-voter-whatsapp').value;

            // Disable buttons for loading
            const payBtn = event.currentTarget;
            payBtn.innerHTML = "Memproses...";
            payBtn.disabled = true;

            fetch('{{ route('vote.checkout') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    candidate_id: candidateId,
                    voter_name: name,
                    voter_email: email,
                    voter_whatsapp: whatsapp,
                    vote_amount: selectedVotes
                })
            })
            .then(res => res.json())
            .then(data => {
                payBtn.innerHTML = "Bayar Sekarang";
                payBtn.disabled = false;

                if (data.success) {
                    if (data.mode === 'midtrans') {
                        // 💳 REAL MIDTRANS MODE
                        // Close checkout modal first
                        closeCheckoutModal();
                        
                        // Load Midtrans Snap Widget
                        if (window.snap) {
                            window.snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    alert('Pembayaran sukses! Terima kasih atas suara Anda.');
                                    window.location.reload();
                                },
                                onPending: function(result) {
                                    alert('Pembayaran pending. Silakan selesaikan pembayaran Anda.');
                                    window.location.href = `/?invoice=${data.invoice_id}`;
                                },
                                onError: function(result) {
                                    alert('Pembayaran gagal! Silakan coba lagi.');
                                }
                            });
                        } else {
                            // Load Midtrans library dynamically
                            const script = document.createElement('script');
                            const src = data.is_production 
                                ? 'https://app.midtrans.com/snap/snap.js' 
                                : 'https://app.sandbox.midtrans.com/snap/snap.js';
                            script.src = src;
                            script.setAttribute('data-client-key', data.client_key);
                            script.onload = () => {
                                window.snap.pay(data.snap_token, {
                                    onSuccess: function(result) {
                                        window.location.reload();
                                    },
                                    onPending: function(result) {
                                        window.location.href = `/?invoice=${data.invoice_id}`;
                                    }
                                });
                            };
                            document.head.appendChild(script);
                        }
                    } else {
                        // 🎮 FALLBACK SIMULATOR MODE
                        document.getElementById('simulator-invoice-id').innerHTML = data.invoice_id;
                        document.getElementById('simulator-candidate-details').innerHTML = `Duta ${data.candidate_name} (${data.candidate_number})`;
                        document.getElementById('simulator-vote-amount').innerHTML = `${data.total_votes} Votes`;
                        document.getElementById('simulator-price-total').innerHTML = `Rp ${data.price_total.toLocaleString('id-ID')}`;

                        if (checkoutPaymentMethod === 'QRIS') {
                            document.getElementById('simulator-qris-display').classList.remove('hidden');
                            document.getElementById('simulator-va-display').classList.add('hidden');
                        } else {
                            document.getElementById('simulator-qris-display').classList.add('hidden');
                            document.getElementById('simulator-va-display').classList.remove('hidden');
                            
                            // Mock VA generation
                            const vaPrefix = checkoutPaymentMethod === 'VA_BCA' ? '8827' : '8950';
                            document.getElementById('simulator-va-number').innerHTML = vaPrefix + Math.floor(1000000000 + Math.random() * 9000000000);
                        }

                        // Move to Step 3
                        document.getElementById('step-dot-3').classList.replace('bg-gray-800', 'bg-amber-500');
                        document.getElementById('step-line-2').classList.replace('bg-gray-800', 'bg-amber-500/50');

                        document.getElementById('checkout-step-2').classList.add('hidden');
                        document.getElementById('checkout-step-3').classList.remove('hidden');
                    }
                } else {
                    alert('Gagal membuat transaksi. Hubungi panitia.');
                }
            })
            .catch(err => {
                payBtn.innerHTML = "Bayar Sekarang";
                payBtn.disabled = false;
                alert('Terjadi kesalahan koneksi.');
            });
        }

        // --- SIMULATE SUCCESS CLINIC ---
        function simulatePaymentSuccess() {
            const invoiceId = document.getElementById('simulator-invoice-id').innerHTML;
            const simBtn = event.currentTarget;
            
            simBtn.innerHTML = "Mencatat Vote...";
            simBtn.disabled = true;

            fetch('{{ route('vote.simulate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    invoice_id: invoiceId,
                    payment_method: checkoutPaymentMethod
                })
            })
            .then(res => res.json())
            .then(data => {
                simBtn.innerHTML = "Simulasikan Pembayaran Sukses";
                simBtn.disabled = false;

                if (data.success) {
                    // Populate success Step 4
                    document.getElementById('success-invoice-id').innerHTML = data.data.invoice_id;
                    document.getElementById('success-voter-name').innerHTML = data.data.voter_name;
                    document.getElementById('success-vote-amount').innerHTML = `${data.data.vote_amount} Votes`;
                    
                    // Update certificate download link & WhatsApp Share link
                    document.getElementById('success-certificate-btn').href = `/vote/receipt/${data.data.invoice_id}`;
                    
                    const shareText = encodeURIComponent(`Halo! Saya baru saja memberikan dukungan suara sebanyak ${data.data.vote_amount} vote untuk Duta Kampus favorit saya ${data.data.candidate_name} di e-voting Duta Kampus UIN Madura 2026! Mari ikut dukung finalis favoritmu sekarang! ✨🏆`);
                    document.getElementById('success-whatsapp-btn').href = `https://wa.me/?text=${shareText}`;

                    // Update tracker dots
                    document.getElementById('step-dot-4').classList.replace('bg-gray-800', 'bg-amber-500');
                    document.getElementById('step-line-3').classList.replace('bg-gray-800', 'bg-amber-500/50');

                    // Switch panels
                    document.getElementById('checkout-step-3').classList.add('hidden');
                    document.getElementById('checkout-step-4').classList.remove('hidden');

                    // Spark CSS Confetti particles!
                    triggerConfetti();
                } else {
                    alert('Gagal mencatat transaksi.');
                }
            })
            .catch(err => {
                simBtn.innerHTML = "Simulasikan Pembayaran Sukses";
                simBtn.disabled = false;
                alert('Koneksi bermasalah.');
            });
        }

        // Copy VA Number helper
        function copyVaText() {
            const text = document.getElementById('simulator-va-number').innerHTML;
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor Virtual Account disalin!');
            });
        }

        // --- INVOICE LOOKUP TRACKER ---
        function handleInvoiceLookup(e) {
            e.preventDefault();
            const id = document.getElementById('lookup-invoice-id').value.toUpperCase().trim();
            const container = document.getElementById('lookup-results');
            
            container.innerHTML = "<span class='text-gray-400 text-xs block text-center'>Mencari data transaksi...</span>";
            container.classList.remove('hidden');

            fetch(`/vote/status/${id}`)
                .then(res => {
                    if (!res.ok) throw new Error('Not Found');
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        const info = data.data;
                        const statusColor = info.payment_status === 'success' 
                            ? 'text-violet-400 border-violet-500/20 bg-violet-500/5' 
                            : 'text-amber-400 border-amber-500/20 bg-amber-500/5';

                        container.innerHTML = `
                            <div class="flex justify-between items-start flex-col sm:flex-row gap-4">
                                <div>
                                    <span class="text-xs uppercase tracking-widest text-gray-500 block mb-1">Status Transaksi</span>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border ${statusColor} uppercase">
                                        ${info.payment_status}
                                    </span>
                                    <h4 class="text-lg font-bold font-serif text-white mt-4">${info.voter_name}</h4>
                                    <span class="text-xs text-gray-400 block">${info.voter_email} | ${info.voter_whatsapp}</span>
                                </div>
                                <div class="text-left sm:text-right shrink-0">
                                    <span class="text-xs text-gray-500 uppercase block">Jumlah Vote</span>
                                    <span class="text-2xl font-extrabold text-violet-400 font-serif block">${info.vote_amount} Votes</span>
                                    <span class="text-xs text-gray-400 block mt-1">Diberikan Kepada:</span>
                                    <span class="text-sm font-bold text-white block">Duta ${info.candidate.name} (${info.candidate.candidate_number})</span>
                                </div>
                            </div>
                            <hr class="border-gray-800 my-4">
                            <div class="flex justify-between items-center flex-wrap gap-4 text-xs text-gray-500">
                                <span>Metode: ${info.payment_method} | Tanggal: ${info.completed_at || 'Belum Terbayar'}</span>
                                ${info.payment_status === 'success' ? `
                                    <a href="/vote/receipt/${info.id}" target="_blank" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-amber-950 font-bold uppercase tracking-wider rounded-lg transition-all">
                                        Cetak Sertifikat Bukti Vote
                                    </a>
                                ` : ''}
                            </div>
                        `;
                    }
                })
                .catch(err => {
                    container.innerHTML = "<span class='text-rose-400 text-xs block text-center font-semibold'>Invoice tidak ditemukan. Silakan cek kembali kode Anda.</span>";
                });
        }

        // --- CSS/JS CONFETTI SPARK CELEBRATION ---
        function triggerConfetti() {
            for (let i = 0; i < 70; i++) {
                const particle = document.createElement('div');
                particle.className = 'fixed pointer-events-none z-50 rounded-sm';
                particle.style.width = Math.random() * 8 + 5 + 'px';
                particle.style.height = Math.random() * 6 + 4 + 'px';
                
                const colors = ['#facc15', '#d97706', '#a78bfa', '#7c3aed', '#ffffff'];
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.top = '100vh';
                
                document.body.appendChild(particle);

                // Animate upwards and then falls
                const destX = (Math.random() - 0.5) * 40;
                const destY = -(Math.random() * 80 + 20);
                
                const duration = Math.random() * 2 + 1.5;
                
                particle.animate([
                    { transform: 'translate(0, 0) rotate(0deg)', opacity: 1 },
                    { transform: `translate(${destX}vw, ${destY}vh) rotate(${Math.random() * 360}deg)`, opacity: 0.8 },
                    { transform: `translate(${destX * 1.5}vw, ${destY + 30}vh) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                ], {
                    duration: duration * 1000,
                    easing: 'cubic-bezier(0.25, 1, 0.50, 1)',
                    fill: 'forwards'
                });

                // Cleanup
                setTimeout(() => particle.remove(), duration * 1000 + 100);
            }
        }

        // Check if invoice URL query parameter is set (redirected from real Midtrans Snap)
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const invoice = urlParams.get('invoice');
            if (invoice) {
                document.getElementById('lookup-invoice-id').value = invoice;
                document.getElementById('lookup').scrollIntoView();
                // Click query trigger
                document.querySelector('#lookup form').dispatchEvent(new Event('submit'));
            }
        };

        // --- 🚀 HIGH-END SCROLL-REVEAL OBSERVER ---
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px -10px -40px -10px', // trigger slightly before entering to feel snappy
                threshold: 0.08
            };

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Observe all reveal classes
            const revealableElements = document.querySelectorAll('.reveal-element, .reveal-left, .reveal-right, .reveal-scale');
            revealableElements.forEach(el => {
                revealObserver.observe(el);
            });
        });
    </script>
</body>
</html>
