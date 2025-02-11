
<x-app-layout>
    <h1>HELLO WELCOME TO FOODIE'S Archive normal user</h1>
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    @if(session('showProfileImageModal'))
    <!-- Modal Structure for Profile Image Upload -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="flex justify-between items-center border-b p-4">
                <h5 class="text-lg font-semibold">Complete Your Profile</h5>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                    &times;
                </button>
            </div>
            <div class="p-4">
                <p class="text-gray-700 mb-4">Please upload a profile image to complete your registration.</p>
                <!-- Profile Image Upload Form -->
                <form action="{{ route('profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                    <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-black py-2 px-4 rounded-lg">
                        Upload Image
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif


<!-- Modal JavaScript to trigger -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('showProfileImageModal'))
            document.querySelector('.fixed').classList.remove('hidden');
        @endif
    });

    function closeModal() {
        document.querySelector('.fixed').classList.add('hidden');
    }
</script>

</x-app-layout>