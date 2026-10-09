<section x-data="{ editing: false }">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-slate-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="dark:text-slate-200" />
            <!-- Menambahkan dark:text-slate-100 dark:disabled:text-slate-200 agar teks jelas terbaca -->
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full disabled:cursor-not-allowed disabled:bg-slate-100 dark:disabled:bg-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:disabled:text-slate-200 dark:border-slate-700" :value="old('name', $user->name)" required autofocus autocomplete="name" x-bind:disabled="!editing" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="dark:text-slate-200" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full disabled:cursor-not-allowed disabled:bg-slate-100 dark:disabled:bg-slate-800 dark:bg-slate-900 dark:text-slate-100 dark:disabled:text-slate-200 dark:border-slate-700" :value="old('email', $user->email)" required autocomplete="username" x-bind:disabled="!editing" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <button type="button" 
                    @click="if(!editing) { editing = true; } else { $el.closest('form').submit(); }"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-slate-800 border border-transparent rounded-md font-semibold text-xs text-white dark:text-slate-200 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-slate-600 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <span x-text="editing ? 'Save' : 'Edit'"></span>
            </button>

            <!-- Tombol Batal diperbaiki agar memiliki latar belakang abu-abu/slate solid saat mode gelap -->
            <button type="button" 
                    x-show="editing"
                    @click="editing = false"
                    class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-slate-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-slate-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-slate-600 focus:outline-none transition ease-in-out duration-150"
                    style="display: none;">
                Batal
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-slate-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>