<x-guest-layout>
    <div class="hidden lg:flex w-full lg:w-1/3 flex-col items-center justify-center">
        <h1 class="font-poppins text-4xl font-bold text-center tracking-wider text-gray-700">Welcome</h1>
        <div>
            <p class="font-poppins text-1xl font-bold text-center tracking-wider text-gray-500 mb-4">One of Us?</p>
        </div>
        <div>
            <a href="login"><button type="button"
                    class="text-black bg-customYellow hover:bg-hovercustomYellow font-poppins font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">LOGIN</button></a>
        </div>
    </div>
    <div class="w-full lg:w-2/3 py-9 px-9 border-l rounded-2xl shadow-lg bg-bgPurple">
        <div class="flex justify-center mb-6">
            <a href=""> <img src="{{ asset('assets/img/secondary_FA-Logo-removebg-preview.png') }}" alt="Logo"
                    style="width: 70px; height: 50px;"></a>
        </div>
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6 tracking-wider">Sign Up</h1>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" value="First Name " />
                    <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                        :error="$errors->has('first_name')" :value="old('first_name')" autofocus />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" value="Last Name" />
                    <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                        :error="$errors->has('last_name')" :value="old('last_name')" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>

                <!-- Username -->
                <div>
                    <x-input-label for="username" value="Username" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                        :error="$errors->has('username')" :value="old('username')" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <!-- Image -->
                <div>
                    {{-- <x-input-label for="image" value="Profile Image" /> --}}
                    <label for="image" class="block font-medium text-sm text-slate-600">Profile Image</label>
                    {{-- <x-text-input id="image" class="block mt-1 w-full p-2 " type="file" name="image"
                        :error="$errors->has('image')" accept="image/*" /> --}}
                    <input type="file"
                        class="block mt-1 w-full file:bg-amber-100 file:px-6 file:py-2.5 file:border-none file:mr-5 file:rounded-md file:text-slate-600 file:cursor-pointer file:hover:bg-amber-200 text-slate-600 cursor-pointer focus:outline-none focus:ring-1 focus:ring-orange-300" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" class="block mt-1 w-full placeholder-gray-300" type="text"
                    :error="$errors->has('email')" name="email" :value="old('email')" placeholder='example@gmail.com' />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Password -->
                <div class="mt-4 ">
                    <x-input-label for="password" value="Password" />
                    <div class="relative">
                        <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password"
                            :error="$errors->has('password')" />
                        <button id="eyeicon" type="button"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4 ">
                    <x-input-label for="password_confirmation" value="Confirm Password" />
                    <div class="relative">
                        <x-text-input id="password_confirmation" class="block mt-1 w-full " type="password"
                            :error="$errors->has('password_confirmation')" name="password_confirmation" />
                        <button id="eyeicon_confirm" type="button"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>



            <div class="flex flex-col items-center justify-center mt-5">
                <x-primary-button>
                    Register
                </x-primary-button>
                <p class="text-sm text-gray-500 mt-4 font-poppins">Already have an account?<a
                        class="underline font-semibold text-base text-zinc-600 hover:text-zinc-800 font-poppins"
                        href="{{ route('login') }}">
                        Login
                    </a></p>
            </div>
        </form>
    </div>
</x-guest-layout>
