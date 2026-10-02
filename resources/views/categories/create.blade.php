<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors duration-200">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Menambahkan border yang lebih tegas pada dark mode: dark:border-slate-400 -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-slate-400 p-6 transition-colors duration-200">
                
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] p-2 transition-colors duration-200" placeholder="Misal: Hardware, Jaringan..." required autofocus>
                        
                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6">
                        <a href="{{ route('categories.index') }}" class="bg-red-600 text-white hover:bg-red-700 text-sm font-bold py-2 px-4 rounded-md transition-all shadow-sm border border-transparent dark:border-red-400/40">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-700 shadow-sm transition-colors duration-200 border border-transparent dark:border-blue-400/40">
                            Simpan Kategori
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>