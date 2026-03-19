<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <h1 class="auth-title">Log in</h1>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="auth-label" />
            <x-text-input id="email" class="block mt-1 w-full auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="auth-label" />

            <x-text-input id="password" class="block mt-1 w-full auth-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        @if (!request()->routeIs('admin.login'))
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center auth-checkbox-label">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 auth-checkbox" name="remember">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>
        {{-- @if (!request()->routeIs('admin.login')) --}}
        <div class="flex items-center justify-end mt-4 auth-actions">
            @if (Route::has('password.request'))
                <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        {{-- @endif --}}
        @endif

            <x-primary-button class="ms-3 auth-button">
                {{ __('Log in') }}
            </x-primary-button>

            @if (!request()->routeIs('admin.login'))
                <a href="{{ route('register') }}" class="ms-3 auth-secondary-link">
                    Don't Have an Account? Create One
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
