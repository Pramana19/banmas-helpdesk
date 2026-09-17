<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#12544F] leading-tight">
                @if (auth()->user()->role === 'admin')
                    Semua Daftar Tiket
                @else
                    Daftar Tiket Saya
                @endif
            </h2>
            <a href="{{ route('tickets.create') }}" class="bg-[#12544F] text-[#EDEDCE] hover:bg-[#8BBB92] hover:text-[#12544F] font-bold py-2 px-4 rounded-md transition-all shadow-sm text-sm">
                + Buat Tiket Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-[#8BBB92]/30 border border-[#8BBB92] text-[#12544F] font-bold px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/40">
                <div class="p-6 text-gray-900">
                    @if($tickets->isEmpty())
                        <p class="text-gray-500 text-center py-4">Belum ada tiket bantuan yang dibuat.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-l-lg">No. Tiket</th>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider">Judul Kendala</th>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider">Prioritas</th>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-r-lg">Tanggal</th>
                                    <!-- Tambahan Kolom Aksi -->
                                    @if(auth()->user()->role === 'admin')
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-r-lg">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-200">
                                @foreach($tickets as $ticket)
                                @php
                                    $badgeType = '';
                                    $badgeText = '';
                                    if (auth()->user()->role === 'teknisi') {
                                        if ($ticket->reporter_id === auth()->id()) {
                                            $badgeType = 'bg-amber-100 text-amber-800 border border-amber-300';
                                            $badgeText = 'TS (Kirim Sendiri)';
                                        } elseif ($ticket->technician_id === auth()->id()) {
                                            $badgeType = 'bg-blue-100 text-blue-800 border border-blue-300';
                                            $badgeText = 'TA (Tugas Masuk)';
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-[#12544F] hover:underline font-bold">
                                                {{ $ticket->ticket_number }}
                                            </a>
                                            @if($badgeText)
                                                <span class="px-2 py-0.5 text-[10px] font-extrabold rounded-md {{ $badgeType }}">
                                                    {{ $badgeText }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $ticket->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($ticket->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $ticket->status == 'Resolved' ? 'bg-[#8BBB92]/40 text-[#12544F]' : 'bg-blue-100 text-blue-800' }}">
                                            {{ ucfirst($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                    <!-- Tombol Hapus Khusus Admin -->
                                    @if(auth()->user()->role === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Peringatan: Yakin ingin menghapus tiket {{ $ticket->ticket_number }} secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-900 font-bold px-3 py-1.5 rounded-md transition-colors text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>