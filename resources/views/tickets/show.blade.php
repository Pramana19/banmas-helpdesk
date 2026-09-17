<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Tiket: {{ $ticket->ticket_number }}
            </h2>
            <a href="{{ route('tickets.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Sukses jika status berhasil diupdate -->
            @if(session('success'))
                <div class="mb-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="border-b pb-4 mb-4">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $ticket->title }}</h3>
                    <div class="mt-2 flex gap-2">
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Status: {{ $ticket->status }}
                        </span>
                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Prioritas: {{ $ticket->priority }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Kategori</p>
                        <p class="text-gray-900">{{ $ticket->category->name ?? 'Tanpa Kategori' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Lokasi / Ruangan</p>
                        <p class="text-gray-900">{{ $ticket->location ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Tanggal Dibuat</p>
                        <p class="text-gray-900">{{ $ticket->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- SISIPAN BARU: Informasi Pelapor & Teknisi -->
                <!-- ========================================== -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 pt-4 border-t border-gray-200">
                    <div>
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Dilaporkan Oleh (Pelapor)</span>
                        <span class="text-sm font-semibold text-[#12544F]">
                            {{ $ticket->reporter->name ?? 'Tidak diketahui' }} 
                            <span class="text-xs text-gray-500 font-normal">({{ $ticket->reporter->email ?? '-' }})</span>
                        </span>
                    </div>
                    <div>
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Teknisi Bertugas</span>
                        <span class="text-sm font-semibold text-[#12544F]">
                            @if($ticket->technician)
                                <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-xs font-bold">{{ $ticket->technician->name }}</span>
                            @else
                                <span class="text-gray-400 italic">-- Belum Ditugaskan --</span>
                            @endif
                        </span>
                    </div>
                </div>
                <!-- ========================================== -->

                <div class="bg-gray-50 p-4 rounded-md border mb-6">
                    <p class="text-sm text-gray-500 font-medium mb-2">Deskripsi Masalah</p>
                    <p class="text-gray-900 whitespace-pre-line">{{ $ticket->description }}</p>
                </div>

                <!-- ========================================== -->
                <!-- Form Tindak Lanjut Admin/Teknisi           -->
                <!-- ========================================== -->
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'teknisi')
                <div class="mt-8 border-t pt-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Tindak Lanjut (Admin/Teknisi)</h4>
                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="bg-gray-50 p-4 rounded-md border">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Dropdown Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ubah Status</label>
                                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @foreach(['Open', 'Assigned', 'In Progress', 'Pending', 'Resolved', 'Closed', 'Rejected'] as $status)
                                        <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Teknisi (Hanya Admin) -->
                            @if(auth()->user()->role === 'admin')
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tugaskan Teknisi</label>
                                <select name="technician_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">-- Belum Ditugaskan --</option>
                                    @foreach($technicians as $tek)
                                        <option value="{{ $tek->id }}" {{ $ticket->technician_id == $tek->id ? 'selected' : '' }}>
                                            {{ $tek->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>