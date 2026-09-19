<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-full max-w-[480px] mx-auto">
        @csrf

        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-[#12544F] tracking-tight">Masuk ke Akun</h2>
            <p class="text-sm text-gray-500 mt-2">Silakan isi email dan password Anda</p>
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block font-semibold text-sm text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="contoh@gmail.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block font-semibold text-sm text-gray-700">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="mt-1 block w-full rounded-md border-gray-300 py-2.5 shadow-sm focus:border-[#12544F] focus:ring-[#8BBB92] transition-colors" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-8">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#12544F] shadow-sm focus:ring-[#12544F]" name="remember">
                <span class="ml-2 text-sm text-gray-500">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-gray-400 hover:text-[#12544F] transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-[#b5926b] hover:bg-[#9d7d59] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#b5926b] transition-all">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>