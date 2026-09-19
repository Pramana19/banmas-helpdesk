<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <body class="font-sans text-gray-900 antialiased bg-white overflow-hidden">
        <div class="min-h-screen flex">
            
            <!-- Kolom Kiri: Dinamis (Otomatis diisi form Login atau Register) -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 lg:p-12">
                
                <!-- Kotak Form -->
                <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    
                    <!-- Logo (Opsional) -->
                    <div class="flex justify-center mb-6">
                        <a href="/">
                            <x-application-logo class="w-20 h-20 fill-current text-[#12544F]" />
                        </a>
                    </div>

                    <!-- $slot ini akan otomatis berubah jadi form login atau form register! -->
                    {{ $slot }}
                </div>
            </div>

            <!-- Kolom Kanan: Visual Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-[#12544F] relative items-center justify-center">
                <div class="absolute inset-0 opacity-20 pointer-events-none">
                    <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                        <path d="M0,100 L100,0 L100,100 Z" fill="#8BBB92" />
                        <circle cx="80" cy="20" r="15" fill="#EDEDCE" opacity="0.5"/>
                    </svg>
                </div>
                
                <div class="relative z-10 p-12 max-w-lg text-center">
                    <div class="flex justify-center mb-6">
                        <svg class="w-20 h-20 text-[#EDEDCE]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-4xl font-extrabold text-[#EDEDCE] mb-6 leading-tight">BanMas Helpdesk</h1>
                    <p class="text-lg text-[#EDEDCE]/90">Sistem terpadu untuk pelaporan dan penanganan kendala IT perusahaan secara real-time.</p>
                </div>
            </div>
            
        </div>
    </body>
</html>