<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-[#12544F] leading-tight">
                {{ __('Kelola Kategori Tiket') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="bg-[#12544F] text-[#EDEDCE] hover:bg-[#8BBB92] hover:text-[#12544F] font-bold py-2 px-4 rounded-md transition-all shadow-sm text-sm">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ editingId: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="mb-4 bg-[#8BBB92]/30 border border-[#8BBB92] text-[#12544F] font-bold px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/40">
                <div class="p-6 text-gray-900">
                    @if($categories->isEmpty())
                        <p class="text-gray-500 text-center py-4">Belum ada kategori tiket.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-l-lg">Nama Kategori</th>
                                    <th class="px-6 py-3 bg-[#12544F]/5 text-left text-xs font-bold text-[#12544F] uppercase tracking-wider rounded-r-lg">Aksi (Edit / Hapus)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-200">
                                @foreach($categories as $category)
                                <tr>
                                    <!-- Form Edit Kategori dengan Kontrol Alpine.js -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" x-data="{ name: '{{ $category->name }}' }">
                                        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="flex items-center gap-2"
                                              @submit.prevent="if(confirm('Yakin ingin mengubah nama kategori ini?')) { $el.submit(); }">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- Kotak Teks: Disabled jika bukan ID yang sedang diedit -->
                                            <input type="text" name="name" x-model="name" 
                                                   :disabled="editingId !== {{ $category->id }}"
                                                   :class="editingId === {{ $category->id }} ? 'bg-white border-[#12544F] ring-1 ring-[#12544F]' : 'bg-gray-100 text-gray-500 cursor-not-allowed border-gray-200'"
                                                   class="text-sm rounded-md py-1 px-2 font-medium w-64 transition-all">

                                            <!-- Tombol Aksi Berdasarkan Kondisi Edit -->
                                            <template x-if="editingId !== {{ $category->id }}">
                                                <button type="button" @click="editingId = {{ $category->id }}" class="text-gray-400 hover:text-[#12544F] p-1 bg-gray-50 hover:bg-gray-200 rounded transition-colors" title="Edit Kategori">
                                                    <!-- Ikon Pensil -->
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                    </svg>
                                                </button>
                                            </template>

                                            <!-- Jika Sedang Mode Edit: Muncul Tombol Selesai dan Batal -->
                                            <template x-if="editingId === {{ $category->id }}">
                                                <div class="flex items-center gap-1">
                                                    <button type="submit" class="bg-[#12544F] text-[#EDEDCE] hover:bg-[#8BBB92] hover:text-[#12544F] px-2.5 py-1 rounded text-xs font-bold transition-all shadow-sm">
                                                        Selesai
                                                    </button>
                                                    <button type="button" @click="editingId = null; name = '{{ $category->name }}';" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-2.5 py-1 rounded text-xs font-bold transition-all">
                                                        Batal
                                                    </button>
                                                </div>
                                            </template>
                                        </form>
                                    </td>

                                    <!-- Kolom Hapus: Disabled/Kunci jika baris ini sedang dalam mode edit -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block" 
                                              onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    :disabled="editingId === {{ $category->id }}"
                                                    :class="editingId === {{ $category->id }} ? 'opacity-40 cursor-not-allowed bg-gray-100 text-gray-400' : 'bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-900'"
                                                    class="font-bold px-3 py-1.5 rounded-md transition-colors text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
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