<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors duration-200">
            {{ __('Buat Tiket Bantuan IT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Menambahkan border yang lebih tegas pada dark mode: dark:border-slate-400 -->
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 dark:border-slate-400 p-6 transition-colors duration-200">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg relative transition-colors duration-200">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Judul Kendala / Masalah</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Kategori</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Prioritas</label>
                        <select name="priority" id="priority" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                            <option value="Low">Low (Rendah)</option>
                            <option value="Medium" selected>Medium (Sedang)</option>
                            <option value="High">High (Tinggi)</option>
                            <option value="Critical">Critical (Darurat)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Lokasi / Ruangan Perangkat</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Ruang Server Lt. 2 / Ruang Admin" class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 dark:placeholder-slate-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Deskripsi Detail Masalah</label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 dark:placeholder-slate-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200" placeholder="Jelaskan kendala yang dialami secara rinci...">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-3">
                        <a href="{{ route('tickets.index') }}" class="bg-red-600 text-white hover:bg-red-700 text-sm font-bold py-2 px-4 rounded-md transition-all shadow-sm border border-transparent dark:border-red-400/40">
                            Batal
                        </a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-700 shadow-sm transition-colors duration-200 border border-transparent dark:border-blue-400/40">
                            Kirim Tiket
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>