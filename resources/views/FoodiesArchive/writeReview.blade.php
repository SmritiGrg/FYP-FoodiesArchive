<x-app-layout>
    <section>
        <div class="text-center pb-12 pt-28 bg-white">
            <p class="text-darkPurple text-2xl sm:text-4xl md:text-4xl font-extrabold">
                A few words from you,
            </p>
            <p class="text-customYellow text-2xl sm:text-4xl md:text-4xl font-extrabold pt-0 sm:pt-3">
                a delicious journey for someone else!
            </p>
            <p class="mt-3 text-xs sm:text-sm md:text-base text-gray-600">
                Tried something unforgettable? From local eateries to fancy restaurants—review it here!
            </p>

            <div class="mt-10 flex justify-center px-4 sm:px-0" id="search-container">
                <div class="relative w-full max-w-2xl">
                    <form action="{{ route('search.food') }}" method="GET">
                        <input 
                            id="search-bar"
                            type="search" 
                            name="query"
                            placeholder="Type the name of a place or dish to review..." 
                            class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 rounded-full border border-gray-300 focus:outline-none text-xs sm:text-base"
                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                            onfocus="showModal()"
                        />
                        <div class="absolute left-4 top-7 sm:top-1/2 transform -translate-y-1/2 text-black cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <button type="submit"
                            class="hidden sm:block absolute right-2 top-2 bottom-2 bg-customYellow text-black text-base px-4 py-2 rounded-full font-medium hover:bg-hovercustomYellow transition"
                        >
                            Search
                        </button>
                        <div class="mt-4 sm:hidden px-4">
                            <button type="submit"
                                class="w-full bg-customYellow text-black text-base px-2 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition"
                            >
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Modal -->
                    <div id="search-modal" class="livepost absolute left-0 mt-2 w-full z-30 bg-white rounded-xl shadow-md hidden">
                        <div class="p-4 flex items-center">
                            <i class="fa-solid fa-location-arrow text-base"></i>
                            <span class="pl-3">Nearby</span>
                        </div>
                        <div id="search-results" class="border-t border-gray-200">
                            {{-- this is the part where the live search will come --}}
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('foodpost.create') }}" class="bg-darkPurple text-white py-2 px-4 md:px-6 mt-6 rounded-3xl hover:bg-lightPurple text-sm md:text-base hvr-icon-forward">
                Upload Post<i class="fa-solid fa-arrow-right ml-2 hvr-icon"></i>
            </a>
        </div>
    </section>

    <section class="bg-gray-100 py-10 px-2 xl:px-24 lg:px-5">
        <h2 class="text-2xl font-bold text-darkPurple mb-5 text-center md:text-center lg:text-left">
            Been Here, Ate This?
        </h2>

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 justify-center place-items-center">
            @foreach($foods as $food)
                <div class="block sm:flex overflow-hidden max-w-2xl w-full md:w-3/4 lg:w-full">
                    <!-- Fixed width for image container -->
                    <div class="w-96 sm:w-64 h-64">
                        <img src="{{ asset($food->image) }}" alt="img" class="w-full h-full object-cover rounded-md" />
                    </div>

                    <!-- Ensure text section has a flexible width -->
                    <div class="pt-1 sm:px-4 flex-1">
                        <a href="{{route('food.details', $food->id)}}" class="text-lg font-bold hover:text-gray-500">{{$food->name}}</a>
                        <p class="text-gray-800 text-sm">Restaurant: <span class="text-gray-600 text-sm">{{$food->restaurant->name}}</span></p>
                        
                        <!-- Star Ratings -->
                        @php
                            $userRatingValue = round($food->rating);
                        @endphp

                        <div class="flex items-center mr-2 my-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $userRatingValue)
                                    <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                        class="bg-customYellow p-1 rounded-md mr-1" 
                                        style="height: 25px; width: 25px;" 
                                        alt="Full">
                                @else
                                    <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                        class="bg-gray-300 p-1 rounded-md mr-1" 
                                        style="height: 25px; width: 25px;" 
                                        alt="Empty">
                                @endif
                            @endfor
                            <p class="ml-2 text-lightgray font-normal text-sm">{{ $food->reviews->count() }} Reviews</p>
                        </div>

                        <p class="text-sm text-gray-700">
                            {{$food->review}}
                        </p>
                        <a href="{{route('food.details', $food->id)}}" class="text-darkPurple hover:underline text-sm underline">See More</a>

                        <div class="flex items-center mt-2 sm:mt-12">
                            <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="profile" class="w-10 h-10 rounded-full mr-3">
                            <div class="pl-1">
                                <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="text-sm font-medium hover:text-gray-500">Uploaded by {{$food->user->username}}</a>
                                <p class="text-xs text-gray-500">{{ $food->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <section class="bg-gray-100 py-6 sm:py-10 px-2 xl:px-24 lg:px-5">
        <h2 class="text-2xl font-bold text-darkPurple mb-2 sm:mb-5 text-center md:text-center lg:text-left">
            Your Reviews
        </h2>
        @if(Auth::check())
            @if(Auth::user()->reviews->whereNull('parent_id')->count() > 0)
                <div class="space-y-6">
                    @foreach(Auth::user()->reviews->whereNull('parent_id')->sortByDesc('created_at') as $review)
                        <div class="border-b pb-6">
                            <div class="flex items-start space-x-4">
                                <!-- Food Image -->
                                <img src="{{ asset($review->food_post->image) }}" 
                                    alt="Food Image" 
                                    class="w-32 h-32 object-cover">

                                <div class="w-full">
                                    <div class="flex justify-between items-center ">
                                        <a href="{{route('food.details', $review->food_post->id)}}" class="text-base sm:text-lg font-medium">{{ $review->food_post->name }}</a>
                                        <div class="flex">
                                            @include('components.helpful-button', ['review' => $review])
                                            <div class="relative group">
                                                <span class="text-textBlack text-lg font-medium hover:text-gray-500 cursor-pointer"><i class="fa-solid fa-ellipsis"></i></span>
                                                <div class="absolute w-36 top-full right-0 rounded-lg mt-1 shadow-lg p-1 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                                    <div class="hover:bg-gray-100 border-b-2 border-gray-200 flex justify-center">
                                                        <a href="" class="block text-sm font-normal text-textBlack px-2 py-1">Edit</a>
                                                    </div>
                                                    <div class="hover:bg-gray-100 flex justify-center">
                                                        <form action="{{ route('review.delete', $review->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-1">Delete</button>
                                                        </form>
                                                    </div>
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
        @else
            <div class="flex flex-col items-center justify-center text-center sm:items-start sm:justify-start">
                <p class="text-gray-500 text-base mt-4">You must be logged in to see your reviews.</p>
                <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 hvr-icon-forward">Log in here <i class="fa-solid fa-arrow-right ml-2 hvr-icon"></i></a>
            </div>
        @endif
    </section>

    <script>
        function toggleReplies(reviewId) {
            const repliesSection = document.getElementById(`replies-${reviewId}`);
            const toggleButton = document.getElementById(`toggle-replies-btn-${reviewId}`);

            if (repliesSection.classList.contains("hidden")) {
                // Show replies
                repliesSection.classList.remove("hidden");
                toggleButton.innerText = `HIDE REPLIES`;
            } else {
                // Hide replies
                repliesSection.classList.add("hidden");
                toggleButton.innerText = `SHOW REPLIES (${repliesSection.children.length})`;
            }
        }

        function toggleReplyForm(reviewId) {
            const replyForm = document.getElementById(`reply-form-${reviewId}`);
            
            // Toggle visibility of the reply form
            if (replyForm.classList.contains("hidden")) {
                replyForm.classList.remove("hidden");
            } else {
                replyForm.classList.add("hidden");
            }
        }
    </script>
</x-app-layout>