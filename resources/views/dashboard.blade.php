<x-app-layout>
    <!-- Memanggil Library Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#12544F] leading-tight flex items-center gap-2">
            <!-- Ikon Dashboard -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Sambutan Kecil -->
            <div class="bg-white/80 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-[#8BBB92]/40 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-extrabold text-[#12544F]">Halo, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600 mt-1">Kamu login sebagai <span class="bg-[#12544F] text-[#EDEDCE] px-2 py-0.5 rounded text-xs font-bold uppercase">{{ auth()->user()->role }}</span>. Berikut ringkasan tiket bantuanmu hari ini.</p>
                </div>
                <!-- Ornamen Vektor IT Kecil -->
                <div class="hidden md:block text-[#8BBB92] opacity-50">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M19 12h-2v2h2v-2zm-6 0h-2v2h2v-2zm-6 0H5v2h2v-2zm13-8H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h6v2H8v2h8v-2h-2v-2h6c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 12H4V6h16v10z"/></svg>
                </div>
            </div>
            
            <!-- Widget 4 Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Kartu Total -->
                <!-- Kartu Total -->
                <div class="bg-blue-700 text-white p-6 rounded-xl shadow-lg shadow-purple-500/40 dark:shadow-purple-900/60 flex items-center justify-between border-b-[6px] border-purple-600 dark:border-purple-400">
                    <div>
                        <p class="text-sm font-medium opacity-80 uppercase tracking-wider">Total Tiket</p>
                        <p class="text-4xl font-bold mt-1">{{ $totalTickets }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>

                <!-- Kartu Open -->
                <div class="bg-red-50 text-red-700 p-6 rounded-xl shadow-lg shadow-purple-500/40 dark:shadow-purple-900/60 flex items-center justify-between border-b-[6px] border-red-500">
                    <div>
                        <p class="text-sm font-medium opacity-80 uppercase tracking-wider">Menunggu (Open)</p>
                        <p class="text-4xl font-bold mt-1">{{ $openTickets }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>

                <!-- Kartu Diproses -->
                <div class="bg-yellow-50 text-yellow-700 p-6 rounded-xl shadow-lg shadow-purple-500/40 dark:shadow-purple-900/60 flex items-center justify-between border-b-[6px] border-yellow-500">
                    <div>
                        <p class="text-sm font-medium opacity-80 uppercase tracking-wider">Sedang Diproses</p>
                        <p class="text-4xl font-bold mt-1">{{ $processTickets }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>

                <!-- Kartu Selesai -->
                <div class="bg-[#78b481] text-[#12544F] p-6 rounded-xl shadow-lg shadow-purple-500/40 dark:shadow-purple-900/60 flex items-center justify-between border-b-[6px] border-[#12544F] dark:border-[#0f980f]">
                    <div>
                        <p class="text-sm font-medium opacity-90 uppercase tracking-wider">Selesai (Resolved)</p>
                        <p class="text-4xl font-bold mt-1">{{ $resolvedTickets }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <!-- Tabel & Grafik -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Tabel 5 Tiket Terbaru -->
                <div class="{{ auth()->user()->role !== 'user' ? 'lg:col-span-2' : 'lg:col-span-3' }} bg-white/90 backdrop-blur-sm rounded-xl shadow-sm border border-[#8BBB92]/40 p-6 overflow-x-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-[#12544F]">Tiket Terbaru</h3>
                        <a href="{{ route('tickets.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua &rarr;</a>
                    </div>
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Tiket</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-200">
                            @forelse($recentTickets as $ticket)
                            <tr class="hover:bg-[#8BBB92]/10 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-[#12544F]">
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="hover:underline">{{ $ticket->ticket_number }}</a>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $ticket->category->name ?? 'Lainnya' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $ticket->status === 'Open' ? 'bg-red-100 text-red-800' : 
                                          ($ticket->status === 'Resolved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $ticket->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">Belum ada tiket bantuan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Grafik Kategori: Disembunyikan dari Karyawan Biasa -->
                @if(auth()->user()->role !== 'user')
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-sm border border-[#8BBB92]/40 p-6">
                    <h3 class="text-lg font-bold text-[#12544F] mb-4">Sebaran Kategori Kendala</h3>
                    
                    @if($chartValues->sum() > 0)
                        <div class="relative h-64 w-full">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-400 text-sm">
                            Data belum cukup untuk membuat grafik.
                        </div>
                    @endif
                </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Script Eksekusi Chart.js (Hanya dieksekusi jika bukan Karyawan Biasa) -->
    @if(auth()->user()->role !== 'user')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const chartLabels = {!! $chartLabels->toJson() !!};
            const chartValues = {!! $chartValues->toJson() !!};
            
            if(chartValues.length > 0) {
                const ctx = document.getElementById('categoryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            data: chartValues,
                            backgroundColor: [
                                '#12544F', '#8BBB92', '#EDEDCE', '#3b82f6', '#ef4444', '#f59e0b', '#8b5cf6'
                            ],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { font: { family: "'Figtree', sans-serif" } }
                            }
                        },
                        cutout: '65%'
                    }
                });
            }
        });
    </script>
    @endif
</x-app-layout>