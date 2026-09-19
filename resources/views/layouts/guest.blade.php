<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BanMas Helpdesk') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-white">
    <div class="min-h-screen flex items-stretch">
        
        <!-- Kolom Kiri: Visual Branding -->
        <div class="hidden lg:flex flex-1 bg-[#12544F] relative items-center justify-center">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                    <path d="M0,100 L100,0 L100,100 Z" fill="#8BBB92" />
                    <circle cx="80" cy="20" r="15" fill="#EDEDCE" opacity="0.5"/>
                </svg>
            </div>
            
            <div class="relative z-10 p-12 max-w-2xl text-center">
                <div class="flex justify-center mb-6">
                    <svg class="w-24 h-24 text-[#EDEDCE]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-extrabold text-[#EDEDCE] mb-6 leading-tight">BanMas Helpdesk</h1>
                <p class="text-xl text-[#EDEDCE]/90">Sistem terpadu untuk pelaporan dan penanganan kendala IT perusahaan secara real-time.</p>
            </div>
        </div>

        <!-- Kolom Kanan: Form Area -->
        <!-- Padding vertikal dikurangi (py-6) agar muat di layar laptop standar -->
        <div class="w-full lg:max-w-[480px] bg-white flex flex-col py-6 px-8 lg:px-12 border-l border-gray-100 min-h-screen overflow-y-auto">
            
            <!-- Pembungkus Form (py-2 memadatkan jarak atas form) -->
            <div class="flex-grow flex flex-col justify-center w-full max-w-[380px] mx-auto py-2">
                
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <a href="/">
                        <img src="{{ asset('images/logo-sawit.png') }}" alt="Logo Sawit" class="w-16 h-16 object-contain">
                    </a>
                </div>

                <!-- Slot untuk Login/Register Blade -->
                {{ $slot }}

                <!-- Navigasi Dinamis -->
                <div class="mt-8 text-center text-sm font-medium">
                    @if(request()->routeIs('login'))
                        <span class="text-gray-500">Belum punya akun?</span> 
                        <a href="{{ route('register') }}" class="text-[#12544F] font-bold hover:underline">Daftar Gratis</a>
                    @else
                        <span class="text-gray-500">Sudah punya akun?</span> 
                        <a href="{{ route('login') }}" class="text-[#12544F] font-bold hover:underline">Masuk sekarang</a>
                    @endif
                </div>
            </div>

            <!-- Footer (Teks sudah diperbaiki menjadi BanMas Helpdesk) -->
            <div class="text-center text-xs text-gray-400 mt-auto pt-4">
                &copy; 2026 BanMas Helpdesk
            </div>
        </div>
        
    </div>
</body>
</html>