<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BanMas Helpdesk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#12544F] text-gray-900 font-sans relative overflow-hidden">
    
    <!-- Ornamen Vektor Latar Belakang (Identik dengan Guest Layout) -->
    <div class="absolute inset-0 opacity-20 pointer-events-none flex items-center justify-center">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full object-cover">
            <path d="M0,100 L100,0 L100,100 Z" fill="#8BBB92" />
            <circle cx="80" cy="20" r="15" fill="#EDEDCE" opacity="0.5"/>
        </svg>
    </div>

    <!-- Konten Utama -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-6">
        
        <!-- Kotak Putih Tengah -->
        <div class="text-center bg-white p-10 md:p-14 rounded-2xl shadow-2xl max-w-2xl w-full border-t-4 border-[#b5926b]">
            
            <div class="mb-6 flex justify-center">
                <!-- Ikon -->
                <img src="{{ asset('images/logo-sawit.png') }}" alt="Logo Sawit" class="w-36 h-36 object-contain">
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight text-[#12544F]">BanMas Helpdesk</h1>
            <p class="text-lg text-gray-500 mb-10 font-medium">Sistem terpadu untuk pelaporan dan penanganan kendala IT perusahaan secara real-time.</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 rounded-md bg-[#b5926b] text-white font-bold hover:bg-[#9d7d59] transition-all shadow-md">
                            Masuk ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 rounded-md bg-[#b5926b] text-white font-bold hover:bg-[#9d7d59] transition-all shadow-md">
                            Login Portal
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 rounded-md border-2 border-gray-200 text-gray-500 font-bold hover:border-[#12544F] hover:text-[#12544F] transition-all">
                                Daftar Akun
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        
        <div class="mt-12 text-sm text-[#EDEDCE]/70 font-medium tracking-wide">
            &copy; 2026 BanMas Helpdesk
        </div>
    </div>
</body>
</html>