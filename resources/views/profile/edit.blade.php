<x-app-layout>
    
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
        <a href="/">Back</a>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="/">Back</a>
                    @include('profile.partials.update-profile-information-form')

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl"> --}}
                    @include('profile.partials.update-password-form')
                {{-- </div>
            </div> --}}

            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl"> --}}
                    @include('profile.partials.delete-user-form')
                {{-- </div> --}}
            {{-- </div>
        </div> --}}
    </div>
</x-app-layout>
<script>
    //////////  FOR PROFILE MODAL
    // Open the modal when the profile image is clicked
    function openModal() {
        const modal = document.getElementById('profileModal');
        modal.classList.remove('invisible', 'opacity-0');
        modal.classList.add('visible', 'opacity-100');
    }

    // Close the modal when the user clicks anywhere outside the image
    function closeModal(event) {
        if (event.target === document.getElementById('profileModal')) {
            const modal = document.getElementById('profileModal');
            modal.classList.remove('visible', 'opacity-100');
            modal.classList.add('invisible', 'opacity-0');
        }
    }
</script>