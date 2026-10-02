<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#12544F] dark:text-[#8BBB92] leading-tight transition-colors duration-200">
            {{ __('Tambah Pengguna Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Menambahkan border yang lebih tegas pada dark mode: dark:border-slate-500 -->
            <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/40 dark:border-slate-400 transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-slate-200">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block font-semibold text-sm text-[#12544F] dark:text-[#EDEDCE]">Nama Lengkap</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="mt-1 block w-full border-gray-300 dark:border-slate-500 dark:bg-slate-900 dark:text-slate-200 rounded-md focus:border-[#12544F] dark:focus:border-[#8BBB92] focus:ring-[#8BBB92] dark:focus:ring-[#8BBB92] transition-colors duration-200 shadow-sm">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-semibold text-sm text-[#12544F] dark:text-[#EDEDCE]">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 rounded-md focus:border-[#12544F] dark:focus:border-[#8BBB92] focus:ring-[#8BBB92] dark:focus:ring-[#8BBB92] transition-colors duration-200 shadow-sm">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block font-semibold text-sm text-[#12544F] dark:text-[#EDEDCE]">Role (Hak Akses)</label>
                            <select id="role" name="role" required class="mt-1 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 rounded-md focus:border-[#12544F] dark:focus:border-[#8BBB92] focus:ring-[#8BBB92] dark:focus:ring-[#8BBB92] transition-colors duration-200 shadow-sm">
                                <option value="user">Karyawan</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block font-semibold text-sm text-[#12544F] dark:text-[#EDEDCE]">Password Default</label>
                            <input id="password" type="password" name="password" required class="mt-1 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-900 dark:text-slate-200 rounded-md focus:border-[#12544F] dark:focus:border-[#8BBB92] focus:ring-[#8BBB92] dark:focus:ring-[#8BBB92] transition-colors duration-200 shadow-sm">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <a href="{{ route('users.index') }}" class="bg-red-600 text-white hover:bg-red-700 text-sm font-bold py-2 px-4 rounded-md transition-all shadow-sm border border-transparent dark:border-red-400/40">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-blue-700 shadow-sm transition-colors duration-200 border border-transparent dark:border-blue-400/40">
                                Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>