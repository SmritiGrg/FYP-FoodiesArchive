<x-app-layout>
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-green-500 border border-green-200 bg-white px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif

    <section class="pt-16">
        <div class="max-w-7xl mx-auto mt-10 bg-white">
            <!-- Profile Header -->
            <div class="p-6 relative">
                <div class="flex flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <img src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" class="w-32 h-32 lg:w-48 lg:h-48 object-cover rounded-full cursor-pointer" alt="Profile Img" onclick="openModal()" id="profilePreview">
                    
                    <div class="pt-2 pl-5">
                        <h2 class="text-lg sm:text-xl font-medium text-textBlack">{{ Auth::user()->full_name }}</h2>
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
                                <div class="relative group">
                                    <p class="text-darkPurple font-medium cursor-pointer">{{ $totalContributions }}</p>                                    
                                    <div class="absolute w-40 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                        <div class="hover:bg-gray-100 border-b-2 border-gray-200">
                                            <p class="block text-sm font-normal text-textBlack px-2 py-2"><i class="fa-solid fa-image pr-2"></i>{{$totalPosts}} Posts</p>
                                        </div>
                                        <div class="hover:bg-gray-100">
                                            <p class="block text-sm font-normal text-textBlack px-2 py-2"><i class="fa-regular fa-comment pr-2"></i>{{$totalReviews}} Reviews</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-500 ">Contributions</p>
                            </div>
                            <div>
                                <div class="relative group">
                                    <p class="text-darkPurple font-medium cursor-pointer">{{ Auth::user()->followers->count() }}</p>                                 
                                    <div class="absolute w-60 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        @if(Auth::user()->followers->count() > 0)
                                            @foreach(Auth::user()->followers as $follower)
                                                <a href="{{ route('otherProfile', ['id' => $follower->id]) }}" class="hover:bg-gray-100 border-b border-gray-200 last:border-b-0 flex items-center py-2">
                                                    <img src="{{ asset('uploads/profile-images/' . $follower->image) }}" alt="" class="w-8 h-8 rounded-full object-cover">
                                                    <div>
                                                        <p class="block text-sm font-medium text-textBlack pl-3">{{ $follower->full_name }}</p>
                                                        <p class="block text-xs font-normal text-lightgray pl-3">{{ $follower->username }}</p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-500 px-2 py-2">No followers yet.</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-500 font-normal">Followers</p>
                            </div>
                            <div>
                                <div class="relative group">
                                    <p class="text-darkPurple font-medium cursor-pointer">{{ Auth::user()->followings->count() }}</p>                               
                                    <div class="absolute w-60 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        @if(Auth::user()->followings->count() > 0)
                                            @foreach(Auth::user()->followings as $following)
                                                <a href="{{ route('otherProfile', ['id' => $following->id]) }}" class="hover:bg-gray-100 border-b border-gray-200 last:border-b-0 flex items-center py-2">
                                                    <img src="{{ asset('uploads/profile-images/' . $following->image) }}" alt="" class="w-8 h-8 rounded-full object-cover">
                                                    <div>
                                                        <p class="block text-sm font-medium text-textBlack pl-3">{{ $following->full_name }}</p>
                                                        <p class="block text-xs font-normal text-lightgray pl-3">{{ $following->username }}</p>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-500 px-2 py-2">No followers yet.</p>
                                        @endif
                                    </div>
                                </div>
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
                        <a href="profile" class="flex-grow px-4 py-2 border border-darkPurple rounded text-center hover:bg-darkPurple hover:text-white transition">
                            Edit Profile
                        </a>
                        <a href="" class="w-10 flex justify-center">
                            <i class="fa-solid fa-gear text-darkPurple text-xl hover:text-lightPurple"></i>
                        </a>
                        <a href="{{route('user.calendar')}}" class="w-10 flex justify-center">
                            <i class="fa-solid fa-calendar-days text-darkPurple text-xl hover:text-lightPurple"></i>
                        </a>
                    </div>
                </div>

                <div class="absolute top-6 right-10 lg:block hidden">
                    <a href="profile" class="px-4 py-1 border border-darkPurple rounded hover:bg-darkPurple hover:text-white transition">Edit Profile</a>
                    <a href=""><i class="fa-solid fa-gear pl-3 text-darkPurple text-xl hover:text-lightPurple"></i></a>
                    <a href="{{route('user.calendar')}}"><i class="fa-solid fa-calendar-days pl-3 text-darkPurple text-xl hover:text-lightPurple"></i></a>
                </div>
            </div>
            
            <!-- Achievements & Tabs Section -->
            <div class="block lg:flex border-t border-gray-200">
                <!-- Achievements -->
                <div class="w-full lg:w-1/4 p-4">
                    <h3 class="font-semibold text-lg mb-2 text-textBlack">Achievements</h3>
                    <div class="flex lg:block justify-around border p-5 md:p-3 lg:space-y-3">
                        <div class="flex items-center space-x-3">
                            <span class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-red-400"></span>
                            <p class="text-sm text-textBlack"">Badge Name <br><span class="text-gray-500">20 streaks</span></p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-14 h-14 sm:w-20 sm:h-20 rounded-full bg-blue-400"></span>
                            <p class="text-sm text-textBlack">Badge Name <br><span class="text-gray-500">50 streaks</span></p>
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
                                @foreach(Auth::user()->reviews->sortByDesc('created_at') as $review)
                                    <div class="border-b pb-6">
                                        <div class="flex items-start space-x-4">
                                            <!-- Food Image -->
                                            <img src="{{ asset($review->food_post->image) }}" 
                                                alt="Food Image" 
                                                class="w-32 h-32 object-cover">

                                            <div class="w-full">
                                                <div class="flex justify-between items-center ">
                                                    <a href="{{route('food.details', $review->food_post->id)}}" class="text-base sm:text-lg font-medium">{{ $review->food_post->name }}</a>
                                                    <div class="relative group">
                                                        <span class="text-textBlack text-lg font-medium hover:text-gray-500 cursor-pointer"><i class="fa-solid fa-ellipsis"></i></span>
                                                        <div class="absolute w-36 top-full right-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                                            <div class="hover:bg-gray-100 border-b-2 border-gray-200 flex justify-center">
                                                                <a href="" class="block text-sm font-normal text-textBlack px-2 py-2">Edit</a>
                                                            </div>
                                                            <div class="hover:bg-gray-100 flex justify-center">
                                                                <a href="" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                @foreach(Auth::user()->likes->sortByDesc('created_at') as $likedpost)
                                    <a href="#modal-{{ $likedpost->foodPost->id }}" class="relative group overflow-hidden border rounded-sm"> 
                                        <img src="{{ asset($likedpost->foodPost->image) }}" alt="Food" class="w-full h-48 sm:h-72 md:h-96 object-cover rounded-sm">
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
                                    <a href="#modal-{{ $post->id }}" class="relative group overflow-hidden">                                        
                                        <img src="{{ asset($post->image) }}" alt="Food" class="w-full h-48 sm:h-72 md:h-96 object-cover rounded-sm">
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
                                    <p class="text-gray-500 text-base sm:text-lg mt-4">No posts yet. Share your first food post!</p>
                                        <a href="{{ route('foodpost.create') }}" class="text-sm sm:text-base text-blue-600 underline font-medium hover:text-blue-500">Upload Now</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
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
</script>