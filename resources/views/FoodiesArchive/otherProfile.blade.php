<x-app-layout>
    <section class="pt-16">
        <div class="max-w-7xl mx-auto mt-10 bg-white">
            <!-- Profile Header -->
            <div class="p-6 relative">
                <div class="flex flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <img src="{{ asset('uploads/profile-images/' . $user->image )}}" class="w-32 h-32 lg:w-48 lg:h-48 object-cover rounded-full cursor-pointer" alt="Profile Img" onclick="openModal()" id="profilePreview">
                    
                    <div class="pt-2 pl-9">
                        <div class="flex space-x-9">
                            <h2 class="text-lg sm:text-xl font-medium text-textBlack">{{ $user->full_name }}</h2>
                            @php
                                $authUser = auth()->user();
                                $isFollowing = $authUser && isset($user) ? $authUser->isFollowing($user->id) : false;
                            @endphp

                            @if (!$authUser)
                                {{-- If the user is not logged in, show the Follow button --}}
                                <form method="POST" action="{{route('users.follow', $user->id)}}">
                                    @csrf
                                    <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                        Follow
                                    </button>
                                </form>
                            @else
                                {{-- If logged in, check if they are following --}}
                                @if ($isFollowing)
                                    <div class="relative group">
                                        <button class="py-1 px-5 bg-gray-200 text-sm font-medium rounded-md hover:bg-gray-300">
                                            Following
                                        </button>                               
                                        <div class="absolute w-32 top-full left-0 rounded-lg p-1 mt-1 shadow-lg text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                            <form method="POST" action="{{route('users.unfollow', $user->id)}}">
                                                @csrf
                                                <button type="submit" class="w-full text-red-500 hover:bg-gray-100 border-b border-gray-200 last:border-b-0 flex items-center py-1 px-3">
                                                    Unfollow
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <form method="POST" action="{{route('users.follow', $user->id)}}">
                                        @csrf
                                        <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm">{{ $user->username }}</p>
                        <div class="flex space-x-2 items-center">
                            <p class="rounded-full w-1 h-1 bg-gray-600"> </p>
                            <p class="text-gray-600 text-sm">Joined {{ $user->created_at->format('F Y') }}</p>
                        </div>

                        <div class="hidden sm:flex items-center mt-4">
                            <i class="fa-solid fa-fire-flame-curved text-red-400 text-2xl pr-3"></i>
                            <div class="pt-1">
                                <span class="block text-sm text-gray-900 font-medium">{{ $user->total_streak_points }}</span>
                                <span class="block text-sm text-gray-500">
                                    Total streaks
                                </span>
                            </div>
                        </div>

                        <div class="hidden sm:flex space-x-6 mt-5 text-gray-600">
                            <div>
                                @php
                                    $totalPosts = $user->foodPosts->count();
                                    $totalReviews = $user->reviews->count();
                                    $totalContributions = $totalPosts + $totalReviews;

                                    $totalLikes = $user->foodPosts->sum(function($post) {
                                        return $post->likes->count();
                                    });
                                @endphp
                                <p class="text-darkPurple font-medium">{{ $totalContributions }}</p>
                                <p class="text-gray-500 ">Contributions</p>
                            </div>
                            <div>
                                <div class="relative group">
                                    <p class="text-darkPurple font-medium cursor-pointer">{{ $user->followers->count() }}</p>                                 
                                    <div class="absolute w-60 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        @if($user->followers->count() > 0)
                                            @foreach($user->followers as $follower)
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
                                    <p class="text-darkPurple font-medium cursor-pointer">{{ $user->followings->count() }}</p>                               
                                    <div class="absolute w-60 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        @if($user->followings->count() > 0)
                                            @foreach($user->followings as $following)
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
                        <img id="modalImage" src="{{ asset('uploads/profile-images/' . $user->image) }}" alt="Profile" class="rounded-full object-cover" style="width: 400px; height: 400px;">
                    </div>
                </div>
                <div class="flex flex-col sm:hidden sm:space-x-6 mt-1 text-gray-600">
                    <div class="flex items-center justify-center sm:justify-start mt-4">
                        <i class="fa-solid fa-fire-flame-curved text-red-400 text-2xl pr-3"></i>
                        <div class="pt-1">
                            <span class="block text-sm text-gray-900 font-medium text-center sm:text-left">{{ $user->streak_count }}</span>
                            <span class="block text-sm text-gray-500 text-center sm:text-left">Total streaks</span>
                        </div>
                    </div>
                    <div class="flex justify-around sm:space-x-6 w-full sm:w-auto mt-4">
                        <div>
                            @php
                                $totalPosts = $user->foodPosts->count();
                                $totalReviews = $user->reviews->count();
                                $totalContributions = $totalPosts + $totalReviews;

                                $totalLikes = $user->foodPosts->sum(function($post) {
                                    return $post->likes->count();
                                });
                            @endphp
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $totalContributions }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Contributions</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $user->followers->count() }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Followers</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $user->followings->count() }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Following</p>
                        </div>
                        <div>
                            <p class="text-darkPurple font-medium text-center sm:text-left">{{ $totalLikes }}</p>
                            <p class="text-gray-500 text-center sm:text-left">Likes</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Achievements & Tabs Section -->
            <div class="block lg:flex border-t border-gray-200">
                <!-- Achievements -->
                <div class="w-full lg:w-1/4 p-4">
                    <h3 class="font-semibold text-lg mb-2 text-textBlack">Achievements</h3>
                    <div class="flex lg:block justify-around border p-5 md:p-3 lg:space-y-3">
                        @if ($user->badges->count() > 0)
                            @foreach ($user->badges as $badge)
                                <div class="flex items-center space-x-3">
                                    <img src="{{asset('uploads/badge-images/'. $badge->image)}}" alt="{{ $badge->name }}" class="w-14 h-14 sm:w-20 sm:h-20 rounded-full object-cover">
                                    <p class="text-sm text-textBlack">
                                        {{ $badge->name }} <br>
                                        <span class="text-gray-500">{{ $badge->streak_criteria }} streaks</span>
                                    </p>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-lg mt-4">No Badge received yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Tabs Section -->
                <div class="w-full lg:w-3/4 p-4">
                    <!-- Tabs -->
                    <div class="flex space-x-12 pb-2 text-gray-500 justify-center">
                        <a href="{{ route('otherProfile', ['id' => $user->id, 'tab' => 'posts']) }}" 
                        class="font-normal border-b-2 {{ request('tab') == 'posts' || !request('tab') ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                            <i class="fa-solid fa-grip text-lg pr-1"></i> POSTS
                        </a>
                        <a href="{{ route('otherProfile', ['id' => $user->id, 'tab' => 'reviews']) }}" 
                        class="font-normal border-b-2 {{ request('tab') == 'reviews' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                            <i class="fa-regular fa-comment text-lg pr-1"></i> REVIEWS
                        </a>
                    </div>

                    <!-- Review Sections -->
                    @if(request('tab') == 'reviews')
                        @if($user->reviews->count() > 0)
                            <div class="space-y-6">
                                @foreach($user->reviews as $review)
                                    <div class="border-b pb-6">
                                        <div class="flex items-start space-x-4">
                                            <!-- Food Image -->
                                            <img src="{{ asset($review->food_post->image) }}" 
                                                alt="Food Image" 
                                                class="w-32 h-32 object-cover">

                                            <div>
                                                <h3 class="text-base sm:text-lg font-medium">{{ $review->food_post->name }}</h3>
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

                    @else
                        <!-- Posts Section (Default) -->
                        @if($user->foodPosts->count() > 0)
                            <div class="grid grid-cols-3 gap-2">
                                @foreach($user->foodPosts()->orderBy('created_at', 'desc')->get() as $post)
                                    <a href="#modal-{{ $post->id }}" class="relative group overflow-hidden border">                                        
                                        <img src="{{ asset($post->image) }}" alt="Food" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-90 transition duration-300 ease-in-out">
                                            <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>{{ $post->likes->count() }}</p>
                                        </div>
                                    </a>
                                    @include('FoodiesArchive.otherProfileFoodModal', ['post' => $post])
                                @endforeach
                            </div>
                        @else
                            <div class="flex-row items-center justify-center">
                                <div class="text-center">
                                    <p class="text-gray-500 text-lg mt-4">No posts yet.</p>
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