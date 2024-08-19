<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-red-500 shadow-sm focus:ring-red-400" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex flex-col-reverse mt-4">
            <p class="text-sm text-center font-medium text-black">
                Lupa password ?
                @if (Route::has('password.request'))
                    <a class=" text-center text-red-600 hover:text-red-500 hover:underline"
                        href="{{ route('password.request') }}">
                        {{ __('Klik disini') }}
                    </a>
                @endif
            </p>
            <p class="text-sm text-center font-medium text-black mt-4">
                Belum ada akun ?
                <a class=" text-center text-red-600 hover:text-red-500 hover:underline " href="{{ route('register') }}">
                    {{ __('Daftar disini') }}
                </a>
            </p>


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
