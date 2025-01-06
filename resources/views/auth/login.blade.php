<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full relative lg:w-1/3 flex flex-col items-center justify-center p-12 bg-no-repeat bg-cover bg-center"
        style="background-image: url('assets/img/side.jpeg')">
        <div class="absolute top-4 left-4">
            <a href="/">
                <img src="" alt="Logo" class="w-24 h-24 object-contain">
            </a>
        </div>
        <h1 class="text-4xl font-bold text-center tracking-wider text-slate-50">Welcome</h1>
        <div>
            <p class="text-1xl font-bold text-center tracking-wider text-slate-50">New Here?</p>
        </div>
        <div>
            <a href="register"><button type="button"
                    class="text-black bg-gradient-to-r from-amber-100 via-amber-200 to-amber-100 hover:bg-gradient-to-r hover:from-amber-100 hover:via-amber-300 hover:to-amber-100   font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">REGISTER</button></a>
        </div>
    </div>
    <div class="w-full lg:w-2/3 py-9 px-9">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6 tracking-wider">Welcome Back</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full " type="text" name="email" :value="old('email')"
                    :error="$errors->has('email')" autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 " />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" :error="$errors->has('password')"
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 " />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-white border-gray-300 text-black shadow-sm focus:ring-gray-500 focus:ring-2 focus:ring-offset-2 dark:bg-gray-900 dark:border-gray-600 dark:focus:ring-gray-400"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mt-4 text-center">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-gray-500 rounded-md"
                        href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
            </div>

            <!-- Log In Button -->
            <div class="mt-4">
                <x-primary-button>
                    Log in
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
