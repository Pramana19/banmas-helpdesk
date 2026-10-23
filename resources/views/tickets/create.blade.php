<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors duration-200">
            {{ __('Buat Tiket Bantuan IT') }}
        </h2>
    </x-slot>

    <!-- 1. PERBAIKAN POSISI CARD: Mengubah py-12 menjadi py-6 (Jarak atas-bawah dipangkas agar card naik) -->
    <!-- Dan mengubah max-w-3xl menjadi max-w-4xl agar card sedikit lebih lebar & proporsional -->
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
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

                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Judul Kendala / Masalah</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                    </div>

                    <div class="mb-4 flex flex-col sm:flex-row gap-4">
                        <div class="w-full">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Kategori</label>
                            <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Prioritas</label>
                            <select name="priority" id="priority" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                                <option value="Low">Low (Rendah)</option>
                                <option value="Medium" selected>Medium (Sedang)</option>
                                <option value="High">High (Tinggi)</option>
                                <option value="Critical">Critical (Darurat)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="location" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Lokasi / Ruangan Perangkat</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Ruang Server Lt. 2 / Ruang Admin" class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 dark:placeholder-slate-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200">
                    </div>

                    <!-- 2. PERBAIKAN BUG LABEL: Atribut for="attachments" telah dihapus dari <label> -->
                    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between p-3 rounded-lg border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
                        <div class="mb-3 sm:mb-0">
                            <!-- Label tanpa atribut 'for' agar tidak memicu jendela upload saat teks diklik -->
                            <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Lampiran Bukti (Opsional)</label>
                            <p class="text-[11px] text-gray-500 dark:text-slate-400 mt-0.5">Maks 5 file (Foto/PDF/Video). Ukuran maks 20MB/file.</p>
                        </div>
                        <!-- FITUR CUSTOM UI: Memisahkan tombol dan teks agar teks tidak bisa diklik -->
                        <div class="shrink-0 flex items-center gap-3" x-data="{ fileName: 'Tidak ada file yang dipilih' }">                          
                            <!-- 1. Input Asli (Disembunyikan total dengan class 'hidden') -->
                            <input type="file" name="attachments[]" id="attachments" multiple accept=".jpg,.jpeg,.png,.pdf,.mp4,.webm" class="hidden" 
                                x-on:change="fileName = $event.target.files.length > 0 ? $event.target.files.length + ' file dipilih' : 'Tidak ada file yang dipilih'">
                            
                            <!-- 2. Tombol Buatan (Hanya ini yang bisa diklik dan memicu input asli via atribut 'for') -->
                            <label for="attachments" class="py-2 px-4 rounded-md text-xs font-semibold bg-indigo-200 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-200 hover:bg-indigo-300 dark:hover:bg-indigo-800 transition-colors duration-200 cursor-pointer shadow-sm text-center m-0">
                                Pilih File
                            </label>                            
                            <!-- 3. Teks Keterangan (Murni teks biasa dengan cursor-default, kebal dari klik) -->
                            <span class="text-sm text-gray-500 dark:text-slate-400 cursor-default" x-text="fileName"></span>
                            
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-slate-300">Deskripsi Detail Masalah</label>
                        <!-- Mengurangi ukuran row textarea dari 4 ke 3 agar form lebih compact ke atas -->
                        <textarea name="description" id="description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 dark:placeholder-slate-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 transition-colors duration-200" placeholder="Jelaskan kendala yang dialami secara rinci...">{{ old('description') }}</textarea>
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