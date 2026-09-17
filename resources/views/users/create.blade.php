<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#12544F] leading-tight">
            {{ __('Tambah Pengguna Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm overflow-hidden shadow-sm sm:rounded-2xl border border-[#8BBB92]/40">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-[#12544F]">Nama Lengkap</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="mt-1 block w-full border-gray-300 rounded-md focus:border-[#12544F] focus:ring-[#8BBB92]">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-[#12544F]">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full border-gray-300 rounded-md focus:border-[#12544F] focus:ring-[#8BBB92]">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block font-medium text-sm text-[#12544F]">Role (Hak Akses)</label>
                            <select id="role" name="role" required class="mt-1 block w-full border-gray-300 rounded-md focus:border-[#12544F] focus:ring-[#8BBB92]">
                                <option value="user">Karyawan</option>
                                <option value="teknisi">Teknisi</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-[#12544F]">Password Default</label>
                            <input id="password" type="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md focus:border-[#12544F] focus:ring-[#8BBB92]">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-3">
                            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 font-bold">Batal</a>
                            <button type="submit" class="bg-[#12544F] text-[#EDEDCE] hover:bg-[#8BBB92] hover:text-[#12544F] font-bold py-2 px-4 rounded-md transition-all shadow-sm">
                                Simpan Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>