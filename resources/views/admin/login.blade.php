<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator - Duta Kampus UIN Madura</title>
    <link rel="icon" type="image/png" href="/images/favicon.png?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF5;
            color: #1A1A2E;
        }
        .bg-mesh {
            background-image: 
                radial-gradient(at 0% 0%, rgba(245, 197, 24, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(232, 165, 152, 0.1) 0px, transparent 50%);
        }
        .gold-text-gradient {
            background: linear-gradient(135deg, #d97706 0%, #b45309 50%, #78350f 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(245, 197, 24, 0.25);
        }
    </style>
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <!-- Ambient glowing orbs -->
    <div class="absolute w-96 h-96 rounded-full bg-amber-200/30 blur-[100px] -top-20 -left-20 pointer-events-none"></div>
    <div class="absolute w-96 h-96 rounded-full bg-rose-200/20 blur-[100px] -bottom-20 -right-20 pointer-events-none"></div>

    <div class="w-full max-w-md glass-panel rounded-3xl p-8 shadow-2xl relative">
        <!-- Brand logo -->
        <div class="flex flex-col items-center text-center mb-8">
            <!-- Logo -->
            <div class="w-20 h-20 flex items-center justify-center mb-4 overflow-hidden shrink-0">
                <img src="/images/logo_vogma.png" alt="Logo" class="h-full w-full object-contain">
            </div>
            <h2 class="text-xs uppercase tracking-[0.2em] text-amber-700 font-bold leading-none">ADMINISTRATOR</h2>
            <h1 class="text-xl md:text-2xl font-serif font-bold text-slate-800 mt-2">Prince & Princess English Department</h1>
        </div>

        @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-300 text-rose-700 text-xs leading-relaxed font-semibold">
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-700 text-xs font-semibold">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label for="email" class="block text-xs uppercase tracking-wider text-amber-700 font-bold mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address" 
                       class="w-full px-4 py-3.5 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
            </div>

            <div>
                <label for="password" class="block text-xs uppercase tracking-wider text-amber-700 font-bold mb-2">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                           class="w-full pl-4 pr-12 py-3.5 rounded-xl bg-white border border-amber-500/30 focus:outline-none focus:border-amber-500 text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
                    <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-700 focus:outline-none">
                        <!-- Eye Icon (Open by default) -->
                        <svg id="eye-icon-open" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Eye Icon (Closed) -->
                        <svg id="eye-icon-closed" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs py-1">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600 hover:text-slate-800 transition-colors font-medium">
                    <input type="checkbox" name="remember" class="rounded bg-white border-amber-300 text-amber-500 focus:ring-0">
                    Ingat Saya
                </label>
                <a href="/" class="text-amber-700 hover:text-amber-600 font-bold">Kembali ke Portal</a>
            </div>

            <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-900 font-bold tracking-wider hover:shadow-lg hover:shadow-amber-500/20 transition-all text-xs uppercase mt-8">
                Login
            </button>
        </form>
    </div>

    <script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-icon-open');
            const eyeClosed = document.getElementById('eye-icon-closed');

            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                pwdInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>

</body>
</html>

