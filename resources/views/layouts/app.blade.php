<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" :class="{ 'dark': darkMode }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BanMas Helpdesk') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#E2E8F0] dark:bg-[#022140] text-[#022140] dark:text-slate-100 transition-colors duration-300">
        <!-- Main Container -->
        <div class="min-h-screen relative flex flex-col">
            
            <!-- Ornamen Vektor -->
            <div class="absolute inset-0 z-0 opacity-15 dark:opacity-5 pointer-events-none overflow-hidden fixed">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                    <path d="M100,100 C70,50 100,0 100,0 L100,100 Z" fill="#265077" />
                    <path d="M0,0 L20,0 L0,20 Z" fill="#022140" />
                </svg>
            </div>

            <!-- Konten Utama di Atas Vektor -->
            <div class="relative z-10 flex-1 flex flex-col">
                <!-- Navigasi Atas -->
                @include('layouts.navigation')

                <!-- Layout Utama -->
                <div class="flex-1 flex flex-col lg:flex-row-reverse w-full">
                    
                    <!-- Sisi Kanan: Panel Vertikal (Judul, Tombol, & Watermark) -->
                    @isset($header)
                        <div class="w-full lg:w-72 shrink-0 bg-[#cbd5e1]/80 dark:bg-[#0b335c]/95 backdrop-blur-md shadow-sm border-b lg:border-b-0 lg:border-l border-[#94a3b8]/50 dark:border-slate-700 transition-all">
                            <!-- 
                                Penambahan h-[calc(100vh-64px)] memastikan tinggi panel pas menyentuh ujung bawah layar.
                                flex-col dan justify-between akan memisahkan otomatis bagian Atas (Judul) dan Bawah (Watermark).
                            -->
                            <div class="sticky top-0 p-6 flex flex-col justify-between h-[calc(100vh-64px)] overflow-y-auto">
                                
                                <!-- Bagian Atas: Judul Halaman & Tombol Aksi -->
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="[&>div]:!flex-col [&>div]:!items-center [&>div]:!justify-center [&>div]:!gap-5 [&>div]:!w-full [&_h2]:text-[#0FA4AF] dark:[&_h2]:text-white dark:[&_h2]:drop-shadow-[0_0_10px_rgba(255,255,255,0.3)] [&_h2]:font-bold [&_h2]:text-lg [&_h2]:text-center transition-all w-full">
                                        {{ $header }}
                                    </div>
                                </div>

                                <!-- Bagian Bawah: Watermark Dipindah ke Sini -->
                                <div class="mt-8 text-center text-xs font-bold text-slate-500 dark:text-slate-400">
                                    &copy; 2026 BanMas Helpdesk
                                </div>

                            </div>
                        </div>
                    @endisset

                    <!-- Sisi Kiri: Konten Utama Halaman -->
                    <main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-8 flex flex-col">
                        <div class="flex-1">
                            {{ $slot }}
                        </div>
                    </main>

                </div>
            </div>
        </div>
    </body>
</html>