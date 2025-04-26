<x-app-layout>
    <div class="sm:min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 mb-4 sm:mb-5">
        <div class="w-11/12 flex flex-col lg:flex-row sm:max-w-5xl bg-white mt-20 sm:mt-10 shadow-lg overflow-hidden sm:rounded-lg border border-gray-200 mx-4 sm:mx-auto">
            <div class="hidden w-full lg:w-1/3 lg:flex flex-col items-center justify-center relative">
                <!-- Back Button -->
                <a href="{{ route('login') }}" class="font-poppins absolute top-2 sm:top-4 left-4 text-gray-800 hover:text-gray-600">
                    <i class="fa-solid fa-arrow-left mr-1"></i>Back to Login
                </a>

                <div class="w-full p-1">
                    <img src="{{ asset('assets/img/undraw_forgot-password.png') }}" alt=""
                        class="object-cover w-full h-full">
                </div>
            </div>

            <div class="w-full lg:w-2/3 py-3 px-2 sm:px-9 sm:py-9 bg-bgPurple border-l sm:rounded-lg shadow-lg">
                <a href="{{ route('login') }}"
                    class="font-poppins text-gray-800 hover:text-gray-600 mb-4 block lg:hidden text-sm">
                    <i class="fa-solid fa-arrow-left mr-1"></i>Back to Login
                </a>
                <!-- Heading -->
                {{-- <div class="hidden sm:flex justify-center mb-6">
                    <a href=""> <img src="{{ asset('assets/img/secondary_FA-Logo-removebg-preview.png') }}"
                            alt="Logo" style="width: 70px; height: 50px;"></a>
                </div> --}}
                <h1 class="text-xl md:text-3xl font-bold text-center text-gray-700 mb-6 tracking-wider font-poppins">Forgot Password?</h1>
                <p class="text-sm text-gray-600 text-center mb-6 font-poppins">
                    Just let us know your email address and we will email you a password reset link that will allow
                    you to choose a new one.
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" class="block mt-1 w-full " type="text" name="email" :value="old('email')"
                            :error="$errors->has('email')" autofocus/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 " />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <x-primary-button>
                            Submit
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
