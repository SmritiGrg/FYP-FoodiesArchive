{{-- <x-guest-layout> --}}
<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 mb-5">
        <div class="w-11/12 flex flex-col lg:flex-row sm:max-w-5xl bg-white mt-10 shadow-lg overflow-hidden sm:rounded-lg border border-gray-200 mx-4 sm:mx-auto">
            <div class="hidden lg:flex w-full lg:w-1/3 flex-col items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('assets/img/Dinner.jpg') }}');">
                <h1 class="text-4xl font-bold text-center tracking-wider text-white font-poppins">Welcome</h1>
                <div>
                    <p class="text-1xl font-bold text-center tracking-wider text-white mb-4 font-poppins">New Here?</p>
                </div>
                <div>
                    <a href="register"><button type="button" class="text-white bg-customYellow hover:bg-hovercustomYellow font-semibold rounded-lg text-sm px-5 py-2.5 me-2 mb-2 font-poppins">REGISTER</button></a>
                </div>
            </div>
            <div class="w-full lg:w-2/3 py-4 px-9 border-l shadow-lg bg-white">
                {{-- <div class="flex justify-center mb-4">
                    <a href="/"> <img src="{{ asset('assets/img/secondary_FA-Logo-removebg-preview.png') }}" alt="Logo"
                            style="width: 70px; height: 50px;"></a>
                </div> --}}
                <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Welcome Back</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full " type="text" name="email" :value="old('email')"
                            :error="$errors->has('email')" autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 " />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative">
                            <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password"
                                :error="$errors->has('password')" />
                            <button id="eyeicon" type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2 " />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded bg-white border-gray-300 text-black shadow-sm outline-none focus:ring-0"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 font-poppins">Remember me</span>
                        </label>
                    </div>

                    <div class="mt-4 text-center">
                            <a class="underline text-sm text-gray-400 hover:text-gray-500 rounded-md font-poppins"
                                href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                    </div>

                    <div class="flex flex-col items-center justify-center mt-5">
                        <x-primary-button>
                            Log in
                        </x-primary-button>
                        <p class="text-sm text-gray-500 mt-4 font-poppins">Don't have an account?<a
                                class="underline font-semibold text-base text-zinc-600 hover:text-zinc-800 font-poppins"
                                href="register">
                                Register
                            </a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let eyeicon = document.getElementById("eyeicon");
        let confirmEyeicon = document.getElementById("eyeicon_confirm");
        let password = document.getElementById("password");
        let confirmPassword = document.getElementById("password_confirmation");

        eyeicon.onclick = function() {
            let iconSvg = eyeicon.querySelector("svg");
            if (password.type == "password") {
                password.type = "text";
                iconSvg.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"> <path stroke - linecap = "round" stroke - linejoin = "round" d = "M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke - linecap = "round" stroke - linejoin = "round" d = "M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
            } else {
                password.type = "password";
                iconSvg.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>';
            }
        }
        confirmEyeicon.onclick = function() {
            let iconSvg = eyeicon_confirm.querySelector("svg");
            if (confirmPassword.type == "password") {
                confirmPassword.type = "text";
                iconSvg.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"> <path stroke - linecap = "round" stroke - linejoin = "round" d = "M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke - linecap = "round" stroke - linejoin = "round" d = "M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>';
            } else {
                confirmPassword.type = "password";
                iconSvg.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>';
            }
        }
    </script>
</x-app-layout>
{{-- </x-guest-layout> --}}
