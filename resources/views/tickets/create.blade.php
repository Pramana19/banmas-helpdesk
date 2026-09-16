<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tiket Bantuan IT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Menampilkan Error Validasi jika ada yang kosong -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf

                    <!-- Judul Kendala -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Kendala / Masalah</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                    </div>

                    <!-- Kategori Masalah -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Prioritas -->
                    <div class="mb-4">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Prioritas</label>
                        <select name="priority" id="priority" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                            <option value="Low">Low (Rendah)</option>
                            <option value="Medium" selected>Medium (Sedang)</option>
                            <option value="High">High (Tinggi)</option>
                            <option value="Critical">Critical (Darurat)</option>
                        </select>
                    </div>

                    <!-- Lokasi / Ruangan -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700">Lokasi / Ruangan Perangkat</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Ruang Server Lt. 2 / Ruang Admin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2">
                    </div>

                    <!-- Deskripsi Detail -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Detail Masalah</label>
                        <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm border p-2" placeholder="Jelaskan kendala yang dialami secara rinci...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('tickets.index') }}" class="text-gray-600 mr-4 text-sm">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-blue-700">
                            Kirim Tiket
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>