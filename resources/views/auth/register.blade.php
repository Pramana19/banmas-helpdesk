<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="w-full max-w-[480px] mx-auto">
        @csrf

        <div class="mb-6 text-center">
            <h2 class="text-3xl font-extrabold text-[#12544F] tracking-tight">Buat Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-2">Isi data di bawah untuk mendaftar</p>
        </div>

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="block font-semibold text-sm text-gray-700">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="Masukkan nama lengkap Anda">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="block font-semibold text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="contoh@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="block font-semibold text-sm text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block font-semibold text-sm text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-[#b5926b] hover:bg-[#9d7d59] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#b5926b] transition-all">
                Buat Akun
            </button>
        </div>
    </form>
</x-guest-layout>