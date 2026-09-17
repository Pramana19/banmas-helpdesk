<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    
                    <form action="{{ route('categories.store') }}" method="POST" class="max-w-md">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92]" placeholder="Misal: Hardware, Jaringan..." required autofocus>
                            
                            <!-- Pesan Error Validasi -->
                            @error('name')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="bg-[#12544F] hover:bg-[#8BBB92] text-[#EDEDCE] hover:text-[#12544F] font-bold py-2 px-6 rounded-md transition-all">
                                Simpan Kategori
                            </button>
                            <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>