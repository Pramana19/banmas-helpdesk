<x-app-layout>
    
    <!-- Semua yang ada di dalam x-slot "header" ini akan otomatis masuk ke Panel Kanan -->
    <x-slot name="header">
        <div class="flex flex-col items-center justify-center w-full">
            <h2 class="font-bold text-xl text-[#022140] dark:text-white mb-8">
                {{ __('Profile') }}
            </h2>

            <!-- Area Foto Profil Terpusat di Panel Kanan -->
            <div class="flex flex-col items-center w-full">
                <div class="relative mb-4">
                    
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md bg-white">
                    @else
                        <!-- Ikon Default Siluet Abu-abu (SVG) jika belum ada foto -->
                        <div class="w-32 h-32 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center border-4 border-white shadow-md text-slate-400">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Tombol Upload (Ikon Pensil) -->
                    <label for="avatar_upload" class="absolute bottom-0 right-0 bg-[#0FA4AF] p-2.5 rounded-full text-white cursor-pointer hover:bg-teal-600 transition-colors border-2 border-white shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </label>
                </div>

                <!-- Form Input Foto Rahasia (Upload otomatis saat file dipilih) -->
                <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col items-center">
                    @csrf
                    @method('PATCH')
                    <input type="file" id="avatar_upload" name="avatar" class="hidden" accept="image/*" onchange="this.form.submit()">
                    
                    @error('avatar')
                        <p class="text-xs text-red-500 mt-2 text-center">{{ $message }}</p>
                    @enderror
                </form>

                <!-- Tombol Hapus (Hanya muncul kalau ada fotonya) - Diubah menjadi desain button solid -->
                @if(auth()->user()->avatar)
                <form action="{{ route('profile.avatar.destroy') }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <!-- Perubahan dari teks biasa menjadi tombol kotak -->
                    <button type="submit" class="bg-red-600 hover:bg-red-500 text-white font-bold py-1.5 px-4 rounded-md shadow-sm transition-colors text-xs border border-transparent dark:border-red-400/40">
                        Hapus Foto
                    </button>
                </form>
                @endif
            </div>
        </div>
    </x-slot>

    <!-- Konten Utama di Panel Kiri (Form Nama, Email, Password) -->
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Ubah dark:bg-slate-900/90 menjadi dark:bg-slate-900 agar pekat/tidak transparan -->
            <div class="p-4 sm:p-8 bg-stone-400 dark:bg-slate-900 backdrop-blur-sm shadow sm:rounded-2xl border-2 border-stone-300 dark:border-slate-700 transition-colors duration-200 [&>div]:bg-transparent">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-stone-400 dark:bg-slate-900 backdrop-blur-sm shadow sm:rounded-2xl border-2 border-stone-300 dark:border-slate-700 transition-colors duration-200 [&>div]:bg-transparent">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div> 
            
        </div>
    </div>
</x-app-layout>