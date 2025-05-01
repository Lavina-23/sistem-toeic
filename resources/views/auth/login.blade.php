<x-guest-layout>
    <div class="max-w-md mx-auto p-6 bg-teal-100 rounded-2xl">
        <h2 class="text-3xl font-bold text-center text-teal-900 mb-6">
            {{ __('Login to Your Account') }}
        </h2>

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
                <label for="remember_me" class="inline-flex items-center text-sm text-teal-700">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-teal-900 text-indigo-600 shadow-sm bg-teal-100" name="remember">
                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <div>
                <x-primary-button class="w-full justify-center py-2 text-base font-semibold">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
