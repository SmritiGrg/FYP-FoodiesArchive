<section>
    <header>
        <h2 class="text-lg font-medium text-black">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>
    @if (session('status') === 'profile-updated')
        <p id="success-message" class="text-base text-green-500 border border-green-200 bg-green-200 px-4 py-2 rounded-lg shadow-md w-fit mt-2">
            Changes Saved.
        </p>
    @endif
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="flex flex-col items-center justify-center text-center relative">
            <div class="relative">
                <img id="profilePreview" src="{{ asset('uploads/profile-images/' . auth()->user()->image) }}" alt="Profile" class="rounded-full ring-4 ring-gray-300 object-cover" style="width: 150px; height: 150px;">
                
                <!-- Hidden file input -->
                <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
        
                <label for="image" class="absolute top-0 right-0 bg-gray-800 text-white p-1 rounded-full cursor-pointer hover:bg-gray-700 transition" style="width: 35px; height: 35px;">
                    <i class="fa-solid fa-pen"></i>
                </label>
            </div>
        
            <h5 class="mt-2 font-semibold">{{ Auth::user()->full_name }}</h5>
            <h5 class="text-gray-500">{{ Auth::user()->username }}</h5>
            
        </div>
        <div>
            <x-input-label for="full_name" value="Full Name" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" autofocus  />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save Changes</x-primary-button>
        </div>
    </form>
</section>

<form action="{{ route('profile.remove-image') }}" method="POST">
    @csrf
    <button type="submit" class="px-5 py-2.5 text-base font-medium text-indigo-900 focus:outline-none bg-white rounded-lg border border-indigo-200 hover:bg-indigo-100 hover:text-[#202142] focus:z-10 focus:ring-4 focus:ring-indigo-200">
        Remove Picture
    </button>
</form>
