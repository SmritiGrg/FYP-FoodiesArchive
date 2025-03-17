<x-app-layout>
    <section class="pt-16">
        <div class="max-w-7xl mx-auto mt-10 bg-white">
            <!-- Profile Header -->
            <div class="bg-purple-100 p-6 relative">
                <div class="flex flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <img src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" class="w-32 h-32 lg:w-48 lg:h-48 object-cover rounded-full" alt="Profile Img" onclick="openModal()" id="profilePreview">
                    
                    <div class="pt-2 pl-5">
                        <h2 class="text-lg sm:text-xl font-bold">{{ Auth::user()->full_name }}</h2>
                        <p class="text-gray-600 text-sm">{{ Auth::user()->username }}</p>
                        <div class="flex space-x-2 items-center">
                            <p class="rounded-full w-1 h-1 bg-gray-600"> </p>
                            <p class="text-gray-600 text-sm">Joined {{ Auth::user()->created_at->format('F Y') }}</p>
                        </div>

                        <div class="hidden sm:flex items-center mt-4">
                            <i class="fa-solid fa-fire-flame-curved text-red-400 text-2xl pr-3"></i>
                            <div class="pt-1">
                                <span class="block text-sm text-gray-900 font-medium">{{ Auth::user()->streak_count }}</span>
                                <span class="block text-sm text-gray-500">
                                    Total streaks
                                </span>
                            </div>
                        </div>

                        <div class="hidden sm:flex space-x-6 mt-5 text-gray-600">
                            <div>
                                @php
                                    $totalPosts = Auth::user()->foodPosts->count();
                                    $totalReviews = Auth::user()->reviews->count();
                                    $totalContributions = $totalPosts + $totalReviews;

                                    $totalLikes = Auth::user()->foodPosts->sum(function($post) {
                                        return $post->likes->count();
                                    });
                                @endphp
                                <p class="text-darkPurple font-medium">{{ $totalContributions }}</p>
                                <p class="text-gray-500 ">Contributions</p>
                            </div>
                            <div>
                                <p class="text-darkPurple font-medium">{{ Auth::user()->followers->count() }}</p>
                                <p class="text-gray-500 font-normal">Followers</p>
                            </div>
                            <div>
                                <p class="text-darkPurple font-medium">{{ Auth::user()->followings->count() }}</p>
                                <p class="text-gray-500 font-normal">Following</p>
                            </div>
                            <div>
                                <p class="text-darkPurple font-medium">{{ $totalLikes }}</p>
                                <p class="text-gray-500 font-normal">Likes</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Modal for profile image -->
                <div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center invisible opacity-0 transition-all duration-300 z-50" onclick="closeModal(event)" style="margin: 0; padding: 0;">
                    <div class="relative">
                        <img id="modalImage" src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" alt="Profile" class="rounded-full object-cover" style="width: 400px; height: 400px;">
                    </div>
                </div>
                <div class="flex flex-col sm:hidden sm:space-x-6 mt-1 text-gray-600">
                    <div class="flex items-center justify-center sm:justify-start mt-4">
                        <i class="fa-solid fa-fire-flame-curved text-red-400 text-2xl pr-3"></i>
                        <div class="pt-1">
                            <span class="block text-sm text-gray-900 font-medium text-center sm:text-left">{{ Auth::user()->streak_count }}</span>
                            <span class="block text-sm text-gray-500 text-center sm:text-left">Total streaks</span>
                        </div>
                    </div>
                    <div class="flex justify-around sm:space-x-6 w-full sm:w-auto mt-4">
                        <div>
                            @php
                                $totalPosts = Auth::user()->foodPosts->count();
                                $totalReviews = Auth::user()->reviews->count();
                                $totalContributions = $totalPosts + $totalReviews;

                                $totalLikes = Auth::user()->foodPosts->sum(function($post) {
                                    return $post->likes->count();
                                });
                            @endphp
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $totalContributions }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Contributions</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ Auth::user()->followers->count() }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Followers</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ Auth::user()->followings->count() }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Following</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $totalLikes }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Likes</p>
                        </div>
                    </div>
                </div>

                <div class="lg:hidden mt-5">
                    <div class="flex items-center space-x-3">
                        <a href="profile" class="flex-grow px-4 py-2 bg-bgPurple border border-darkPurple rounded text-center hover:bg-darkPurple hover:text-white transition">
                            Edit Profile
                        </a>
                        <a href="" class="w-10 flex justify-center">
                            <i class="fa-solid fa-gear text-darkPurple text-xl"></i>
                        </a>
                        <a href="{{route('user.calendar')}}" class="w-10 flex justify-center">
                            <i class="fa-solid fa-calendar-days text-darkPurple text-xl"></i>
                        </a>
                    </div>
                </div>

                <div class="absolute top-6 right-10 lg:block hidden">
                    <a href="profile" class="px-4 py-1 bg-bgPurple border border-darkPurple rounded hover:bg-darkPurple hover:text-white transition">Edit Profile</a>
                    <a href=""><i class="fa-solid fa-gear pl-3 text-darkPurple text-xl"></i></a>
                    <a href="{{route('user.calendar')}}"><i class="fa-solid fa-calendar-days pl-3 text-darkPurple text-xl"></i></a>
                </div>
            </div>
            
            <!-- Achievements & Tabs Section -->
            <div class="block lg:flex">
                <!-- Achievements -->
                <div class="w-full lg:w-1/4 p-4">
                    <h3 class="font-semibold text-lg mb-2">Achievements</h3>
                    <div class="flex lg:block justify-around border p-5 md:p-3 lg:space-y-3">
                        <div class="flex items-center space-x-3">
                            <span class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-red-400"></span>
                            <p class="text-sm">Badge Name <br><span class="text-gray-500">20 streaks</span></p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-blue-400"></span>
                            <p class="text-sm">Badge Name <br><span class="text-gray-500">50 streaks</span></p>
                        </div>
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="w-full lg:w-3/4 p-4">
                    <!-- Tabs -->
                    <div class="flex space-x-12 pb-2 text-gray-500 justify-center">
                        <a href="{{ route('personalProfile', ['tab' => 'posts']) }}" class="font-normal border-b-2 {{ request('tab') == 'posts' || !request('tab') ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                            <i class="fa-solid fa-grip text-lg pr-1"></i> POSTS
                        </a>
                        <a href="{{ route('personalProfile', ['tab' => 'reviews']) }}" class="font-normal border-b-2 {{ request('tab') == 'reviews' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                            <i class="fa-regular fa-comment text-lg pr-1"></i> REVIEWS
                        </a>
                        <a href="{{ route('personalProfile', ['tab' => 'liked']) }}" class="font-normal border-b-2 {{ request('tab') == 'liked' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                            <i class="fa-regular fa-heart text-lg pr-1"></i> LIKED
                        </a>
                    </div>

                    <!-- Review Sections -->
                    @if(request('tab') == 'reviews')
                        @if(Auth::user()->reviews->count() > 0)
                            <div class="space-y-6">
                                @foreach(Auth::user()->reviews as $review)
                                    <div class="border-b pb-6">
                                        <div class="flex items-start space-x-4">
                                            <!-- Food Image -->
                                            <img src="{{ asset($review->food_post->image) }}" 
                                                alt="Food Image" 
                                                class="w-32 h-32 object-cover">

                                            <div>
                                                <h3 class="text-base sm:text-lg font-semibold">{{ $review->food_post->name }}</h3>
                                                <p class="text-xs sm:text-sm text-gray-500"><strong>Restaurant:</strong> {{ $review->food_post->restaurant->name }}</p>
                                                <p class="text-xs sm:text-sm text-gray-500 mt-1"> {{ $review->food_post->foodType->name }}, {{ $review->food_post->cuisineType->name }}</p>
                                            </div>
                                        </div>

                                        <div class="sm:flex justify-between items-center">
                                            <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                                            @php
                                                $userRatingValue = round($review->rating);
                                                $formattedRating = number_format($userRatingValue, 1);
                                            @endphp
                                            
                                            <div class="flex items-center space-x-1 mt-2">
                                                <p class="pr-2 text-sm font-medium">{{ $formattedRating }}</p>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                        class="p-1 rounded-md {{ $i <= $userRatingValue ? 'bg-customYellow' : 'bg-gray-300' }}" 
                                                        style="height: 25px; width: 25px;" 
                                                        alt="{{ $i <= $userRatingValue ? 'Full' : 'Empty' }}">
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-sm sm:text-base text-gray-700 mt-2">{{ $review->review }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-lg mt-4">No reviews yet.</p>
                        @endif
                    
                    @elseif(request('tab') == 'liked')
                        <!-- Liked Posts Section -->
                        @if(Auth::user()->likes->count() > 0)
                            <div class="grid grid-cols-3 gap-2">
                                @foreach(Auth::user()->likes as $likedpost)
                                    <a href="#modal-{{ $likedpost->foodPost->id }}" class="relative group overflow-hidden border"> 
                                        <img src="{{ asset($likedpost->foodPost->image) }}" alt="Food" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-90 transition duration-300 ease-in-out">
                                            <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>{{ $likedpost->foodPost->likes->count() }}</p>
                                        </div>
                                    </a>
                                    @include('FoodiesArchive.likedPostModal', ['post' => $likedpost])
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-lg mt-4">No liked posts yet.</p>
                        @endif

                    @else
                        <!-- Posts Section (Default) -->
                        @if(Auth::user()->foodPosts->count() > 0)
                            <div class="grid grid-cols-3 gap-2">
                                @foreach(Auth::user()->foodPosts()->orderBy('created_at', 'desc')->get() as $post)
                                    <a href="#modal-{{ $post->id }}" class="relative group overflow-hidden border">                                        
                                        <img src="{{ asset($post->image) }}" alt="Food" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-90 transition duration-300 ease-in-out">
                                            <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>{{ $post->likes->count() }}</p>
                                        </div>
                                    </a>
                                    @include('FoodiesArchive.foodPostModal', ['post' => $post])
                                @endforeach
                            </div>
                        @else
                            <div class="flex-row items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mt-4">No posts yet. Share your first food post!</p>
                                        <a href="{{ route('foodpost.create') }}" class="text-blue-600 underline font-medium hover:text-blue-500">Upload Now</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Food Post Modal -->
    {{-- <div id="foodPostModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">
        <div class="w-full flex items-center justify-center relative p-4">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-3xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- Modal for md, lg, xl -->
            <div class="hidden md:flex bg-white w-full max-w-5xl rounded-r-md h-[90vh] flex-col md:h-[80vh] lg:h-[80vh] xl:h-[90vh]">
                <div class="flex flex-col md:flex-row flex-grow overflow-auto">
                    <!-- Food Image -->
                    <div class="w-full md:w-1/2 lg:h-[80vh] xl:h-[90vh]">
                        <img src="{{asset('assets/img/keemaNoodle.jpg')}}" alt="Food" class="w-full h-full object-cover">
                    </div>
                    <!-- Food Details -->
                    <div class="w-full md:w-1/2 p-6 flex flex-col">
                        <div class="flex justify-between items-center mb-3 pb-4 border-b-2">
                            <div class="flex items-center">
                                <a href="">
                                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smriti Gurung" class="w-10 h-10 rounded-full object-cover" />
                                </a>
                                <div class="ml-3">
                                    <a href="" class="font-semibold text-base hover:text-gray-500">Smriti Gurung</a>
                                    <p class="text-gray-500 text-xs">20 days ago</p>
                                </div>
                            </div>
                            <button class="bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                        </div>

                        <h2 class="text-2xl font-bold mb-1">Buff Keema Noodles</h2>
                        <p class="text-gray-700 mb-2">Restaurant: Kafe Joy</p>
                        <span class="text-gray-700 mb-3">Traditional, Lunch</span>
                        <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-3 mb-4 rounded w-fit">Must Try</span>

                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="far fa-star mr-1 text-lg"></i>
                            </div>
                            <span class="text-gray-700">4.00</span>
                        </div>
                        <p class="font-bold text-lg mb-4">Rs. 300</p>
                        <p class="text-gray-700 mb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        </p>
                        <div class="mt-auto border-t flex items-center justify-between">
                            <span class="text-black text-base py-3">
                                <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> 5.5K
                            </span>
                            <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                            <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for sm and smaller screens -->
            <div class="md:hidden bg-opacity-90 w-full max-w-sm p-4 flex flex-col">
                <!-- Profile Section -->
                <div class="flex items-center w-full justify-between my-3">
                    <div class="flex items-center">
                        <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smriti Gurung" class="w-8 h-8 rounded-full object-cover">
                        <div class="ml-2">
                            <a href="" class="text-white text-sm font-medium font-poppins hover:text-gray-200">Smriti Gurung</a>
                            <p class="text-gray-200 text-xs font-poppins">20 days ago</p>
                        </div>
                    </div>
                    <button class="bg-customYellow text-black text-xs px-3 py-1 rounded-full font-medium hover:bg-hovercustomYellow font-poppins">Follow</button>
                </div>

                <!-- Food Image -->
                <div class="w-full overflow-hidden h-[60vh] sm:h-[70vh]">
                    <img src="{{asset('assets/img/keemaNoodle.jpg')}}" alt="Food" class="w-full h-[60vh] sm:h-[70vh] object-cover">
                </div>

                <!-- Rating & Engagement -->
                <div class="bg-white rounded-b-lg px-2">
                    <div class="flex items-center justify-between w-full mt-1">
                        <div class="flex items-center space-x-4">
                            <span class="text-black text-base font-poppins">
                                <i class="fa-regular fa-heart text-lg hover:text-gray-400 cursor-pointer"></i> 200
                            </span>
                            <span class="text-black text-base font-poppins">
                                <i class="fa-regular fa-comment text-lg hover:text-gray-400 cursor-pointer"></i> 55
                            </span>
                            
                        </div>
                        <div>
                            <i class="fa-regular fa-bookmark text-lg text-black hover:text-gray-400 cursor-pointer"></i>
                        </div>
                    </div>
                    <div class="flex text-yellow-400 text-center mb-2 mt-1">
                            <i class="fas fa-star mr-1 text-lg"></i>
                            <i class="fas fa-star mr-1 text-lg"></i>
                            <i class="fas fa-star mr-1 text-lg"></i>
                            <i class="fas fa-star mr-1 text-lg"></i>
                            <i class="far fa-star text-lg"></i>
                            <span class="text-black ml-1 mt-1">4.00</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div> --}}
</x-app-layout>
    <script>
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

        /////// FOOD POST MODAL
        // function openModal() {
        //     const modal = document.getElementById('foodPostModal');
        //     modal.classList.remove('hidden');
        //     modal.classList.add('flex');
        //     document.body.style.overflow = 'hidden';
        // }

        // function closeModal() {
        //     const modal = document.getElementById('foodPostModal');
        //     modal.classList.add('hidden');
        //     modal.classList.remove('flex');
        //     document.body.style.overflow = 'auto';
        // }
        //// END FOOD POST MODAL
    </script>