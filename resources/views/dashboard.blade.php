<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#12544F] leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/50 relative min-h-[300px] flex items-center">
                
                <!-- Ornamen Vector Daun (Pojok Kiri Bawah) -->
                <div class="absolute bottom-[-20px] left-[-20px] w-64 h-64 text-[#8BBB92] opacity-30 pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22l1-2.3A13.62,13.62 0 0,0 20,8.5Z"/>
                        <path d="M14.77,9.31c-3.15,1.75-4.48,5-6.27,9.12l1.83.74,1-2.27A11.75,11.75 0 0,0 18.66,9.18Z"/>
                    </svg>
                </div>

                <!-- Ornamen Vector IT/Kabel (Kanan) -->
                <div class="absolute bottom-4 right-10 w-48 text-[#12544F] opacity-20 pointer-events-none">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12h-2v2h2v-2zm-6 0h-2v2h2v-2zm-6 0H5v2h2v-2zm13-8H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h6v2H8v2h8v-2h-2v-2h6c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 12H4V6h16v10z"/>
                    </svg>
                </div>

                <!-- Teks Sambutan -->
                <div class="p-10 text-[#12544F] relative z-10 w-full md:w-2/3">
                    <h3 class="text-3xl font-extrabold mb-3">Selamat datang di BanMas Helpdesk!</h3>
                    <p class="text-lg mb-6">Kamu sedang masuk menggunakan hak akses <span class="bg-[#12544F] text-[#EDEDCE] px-3 py-1 rounded-full text-sm font-bold uppercase tracking-widest">{{ auth()->user()->role }}</span>.</p>
                    
                    <div class="bg-[#8BBB92]/20 p-4 rounded-lg border border-[#8BBB92]/40 text-sm font-medium leading-relaxed text-[#12544F]/80">
                        Sistem ini siap membantu mencatat, mendistribusikan, dan menindaklanjuti seluruh kendala operasional IT. Pastikan untuk selalu mengecek menu <b>Tiket Bantuan</b> untuk melihat antrean pekerjaan hari ini.
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>