<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Prince & Princess Admin Portal</title>
    <link rel="icon" type="image/png" href="/images/favicon.png?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #060b08;
            color: #f3f4f6;
            overflow-x: hidden;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .bg-mesh {
            background-image: 
            radial-gradient(at 0% 0%, rgba(4, 120, 87, 0.15) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(217, 119, 6, 0.1) 0px, transparent 50%),
            radial-gradient(at 50% 100%, rgba(6, 95, 70, 0.08) 0px, transparent 50%);
        }

        .glass-panel {
            background: rgba(11, 22, 16, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.03);
        }

        .gold-border {
            border: 1px solid rgba(217, 119, 6, 0.15);
        }

        .gold-text-gradient {
            background: linear-gradient(135deg, #facc15 0%, #d97706 50%, #fef08a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-link-active {
            background: rgba(217, 119, 6, 0.08);
            border-left: 3px solid #d97706;
            color: #facc15;
            font-weight: 600;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #060b08;
        }
        ::-webkit-scrollbar-thumb {
            background: #059669;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #d97706;
        }
    </style>
</head>
<body class="bg-mesh min-h-screen">

    <!-- 🧭 Admin Dashboard Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-64 glass-panel border-r border-amber-500/10 z-40 hidden lg:flex flex-col justify-between p-6">
        <div>
            <!-- Branding Header (Text-Only) -->
            <a href="/" target="_blank" class="flex flex-col mb-10 pb-4 border-b border-gray-800/50">
                <span class="block text-sm font-extrabold tracking-[0.12em] text-amber-400 font-serif leading-none">PRINCE & PRINCESS</span>
                <span class="text-[10px] tracking-[0.15em] uppercase text-gray-500 block mt-1.5 font-bold">English Department</span>
            </a>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <span class="block text-[9px] uppercase tracking-widest text-gray-500 font-bold px-3 mb-2">MENU UTAMA</span>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.dashboard')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.candidates') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.candidates')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen Finalis
                </a>

                <a href="{{ route('admin.transactions') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.transactions')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Log Transaksi Vote
                </a>

                <span class="block text-[9px] uppercase tracking-widest text-gray-500 font-bold px-3 pt-6 mb-2">PENGATURAN</span>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 text-xs uppercase tracking-wider transition-all @if(Request::routeIs('admin.users')) sidebar-link-active @endif">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Pengguna Admin
                </a>
            </nav>
        </div>

        <!-- Logout Form -->
        <div class="pt-4 border-t border-gray-800/50">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-emerald-950 border border-emerald-400/20 flex items-center justify-center text-xs font-bold text-emerald-400 uppercase">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div>
                    <span class="block text-xs font-bold text-white truncate max-w-[120px]">{{ Auth::user()->name }}</span>
                    <span class="text-[9px] text-gray-500 block">Administrator</span>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 rounded-lg border border-rose-500/20 text-rose-500 hover:bg-rose-500/5 transition-all text-[10px] uppercase font-bold tracking-wider">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- 🖥️ Top Header & Main Content Area -->
    <div class="lg:pl-64 min-h-screen flex flex-col">
        <!-- Glassmorphism Navbar Header -->
        <header class="h-16 border-b border-amber-500/10 glass-panel flex items-center justify-between px-6 md:px-10 z-30 sticky top-0">
            <!-- Mobile Menu Toggle Button (hidden on large screen) -->
            <div class="flex items-center gap-3">
                <button class="lg:hidden text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-sm md:text-lg font-serif font-bold text-white tracking-wide">
                    @yield('title')
                </h1>
            </div>

            <div class="flex items-center gap-4 text-xs font-medium">
                <a href="/" target="_blank" class="px-4 py-2 border border-emerald-500/20 hover:border-emerald-400 text-emerald-400 rounded-lg transition-all flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Buka Portal Pengguna
                </a>
            </div>
        </header>

        <!-- 📦 Main Page Container -->
        <main class="flex-1 p-6 md:p-10 max-w-7xl w-full mx-auto">
            @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs">
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
