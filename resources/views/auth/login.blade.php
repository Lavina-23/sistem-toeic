@php
    use Illuminate\Support\Facades\Route;
@endphp

<x-guest-layout>
    <div class="max-w-md mx-auto p-6 bg-white rounded-2xl">
        <img src="/images/logo-toeicin.png" alt="logo-toeicin" class="mx-auto mb-6 h-16 w-auto">
        <h2 class="text-3xl font-extrabold text-center text-gray-900">
            {{ __('Selamat datang!') }}
        </h2>
        <p class="text-sm font-normal text-center text-gray-500 mb-6">
            {{ __('Masukkan email dan password kamu untuk masuk ke dalam sistem dengan aman.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm text-gray-900"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm text-gray-900"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center text-sm text-gray-900">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-primary text-primary shadow-sm bg-bone" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Log In') }}
                </x-primary-button>
            </div>

            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-700">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register') }}" class="text-primary hover:underline font-medium">
                        {{ __('Register here') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
