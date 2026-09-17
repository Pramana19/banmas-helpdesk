<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BanMas Helpdesk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#EDEDCE] text-[#12544F] font-sans relative overflow-hidden">
    
    <!-- Ornamen Vektor Latar Belakang (Nuansa Pelepah & Batu Bara) -->
    <div class="absolute inset-0 z-0 opacity-40 pointer-events-none">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
            <!-- Vektor Hijau Lembut (Pelepah) -->
            <path d="M100,100 C70,50 100,0 100,0 L100,100 Z" fill="#8BBB92" />
            <path d="M0,0 C30,50 0,100 0,100 L0,0 Z" fill="#8BBB92" />
            <!-- Vektor Geometris Gelap (Bongkahan) -->
            <path d="M80,100 L100,80 L100,100 Z" fill="#12544F" opacity="0.8" />
            <path d="M0,0 L20,0 L0,20 Z" fill="#12544F" opacity="0.8" />
        </svg>
    </div>

    <!-- Konten Utama -->
    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center p-6">
        <div class="text-center bg-white/70 backdrop-blur-md p-10 rounded-2xl shadow-xl border border-[#8BBB92]/50 max-w-2xl w-full">
            
            <div class="mb-6 flex justify-center">
                <!-- Ikon IT Support -->
                <svg class="w-24 h-24 text-[#12544F]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3 tracking-tight text-[#12544F]">BanMas Helpdesk</h1>
            <p class="text-lg text-[#12544F]/80 mb-10 font-semibold">Sistem Manajemen Layanan dan Bantuan IT</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 rounded-md bg-[#12544F] text-[#EDEDCE] font-bold hover:bg-[#8BBB92] hover:text-[#12544F] transition-all shadow-md">Masuk ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 rounded-md bg-[#12544F] text-[#EDEDCE] font-bold hover:bg-[#8BBB92] hover:text-[#12544F] transition-all shadow-md">Login Portal</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 rounded-md border-2 border-[#12544F] text-[#12544F] font-bold hover:bg-[#12544F] hover:text-[#EDEDCE] transition-all">Daftar Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        
        <div class="mt-12 text-sm text-[#12544F]/80 font-bold">
            &copy; {{ date('Y') }} BanMas Helpdesk
        </div>
    </div>
</body>
</html>