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
    <body class="font-sans antialiased text-[#12544F]">
        <!-- Background Baru -->
        <div class="min-h-screen bg-[#EDEDCE] relative">
            
            <!-- Ornamen Vektor Abstrak -->
            <div class="absolute inset-0 z-0 opacity-20 pointer-events-none overflow-hidden fixed">
                <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full">
                    <path d="M100,100 C70,50 100,0 100,0 L100,100 Z" fill="#8BBB92" />
                    <path d="M0,0 L20,0 L0,20 Z" fill="#12544F" opacity="0.8" />
                </svg>
            </div>

            <!-- Konten Utama di Atas Vektor -->
            <div class="relative z-10">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/80 backdrop-blur-sm shadow border-b border-[#8BBB92]/50">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>