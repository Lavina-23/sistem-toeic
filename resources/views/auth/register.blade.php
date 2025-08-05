<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-3xl font-extrabold text-center text-gray-900 mt-6">
            {{ __('Halo, daftarkan dirimu disini!') }}
        </h2>
        <p class="text-sm font-normal text-center text-gray-500 mb-6">
            {{ __('Silakan isi data diri, email, dan password untuk membuat akun baru dan mengakses sistem toeicIN.') }}
        </p>

        <!-- NIM/NIDN/NIP -->
        <div>
            <x-input-label for="no_induk" :value="__('NIM/NIDN/NIP')" />
            <x-text-input id="no_induk" class="block mt-1 w-full" type="number" name="no_induk" :value="old('no_induk')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('no_induk')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="nama" :value="__('Nama')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-indigo-600 hover:text-indigo-400 rounded-md focus:outline-none"
                href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
