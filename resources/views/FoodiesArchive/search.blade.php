<x-app-layout>
    {{-- <div class="loader">
        <img src="{{asset('assets/img/Spinner@1x-1.4s-200px-200px.svg')}}" alt="">
    </div> --}}
    <div class="text-center pt-10 bg-white">
        <div class="mt-10 flex justify-center px-4 sm:px-0" id="search-container">
            <div class="relative w-full max-w-2xl">
                <form action="{{ route('search.food') }}" method="GET">
                    <input 
                        id="search-bar"
                        type="text" 
                        name="query"
                        placeholder="Discover foods..." 
                        class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 font-poppins rounded-full border border-gray-300 focus:outline-none"
                        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                        value="{{ old('query', $search) }}"
                        onfocus="showModal()"
                        onblur="hideModal()"
                    />
                    <div class="absolute left-4 top-7 sm:top-1/2 transform -translate-y-1/2 text-black cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <button type="submit"
                        class="hidden sm:block absolute right-2 top-2 bottom-2 font-poppins bg-customYellow text-black text-base px-4 py-2 rounded-full font-medium hover:bg-hovercustomYellow transition"
                    >
                        Search
                    </button>
                    <div class="mt-4 sm:hidden px-4">
                        <button type="submit"
                            class="w-full font-poppins bg-customYellow text-black text-base px-2 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition"
                        >
                            Search
                        </button>
                    </div>
                </form>

                <!-- Modal -->
                <div id="search-modal" class="absolute left-0 mt-2 w-full z-50 bg-white rounded-xl shadow-md hidden">
                    <div class="p-4 flex items-center">
                        <i class="fa-solid fa-location-arrow text-base"></i>
                        <span class="pl-3">Nearby</span>
                    </div>
                    <!-- Add more content to your modal as needed -->
                </div>
            </div>
        </div>
    </div>

    <section class="px-8 pt-10 pb-7 max-w-7xl mx-auto">
            <div class="flex gap-6">
                <!-- Sidebar Filters -->
                <div class="w-1/4 bg-white p-4 rounded-lg shadow-md h-[80vh] sticky top-28">
                    <h2 class="font-semibold mb-2">Filters</h2>
                    <div class="mb-4">
                        <h3 class="font-medium">Food type</h3>
                        <div class="space-y-2">
                            @foreach($foodTypes as $foodType)
                                <label class="block">
                                    <input type="checkbox" class="mr-2" name="food_types[]" value="{{ $foodType->id }}">
                                    {{ $foodType->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="font-medium">Cuisine type</h3>
                        <div class="space-y-2">
                            @foreach($cuisineTypes as $cuisineType)
                                <label class="block">
                                    <input type="checkbox" class="mr-2" name="cuisine_types[]" value="{{ $cuisineType->id }}">
                                    {{ $cuisineType->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Main Content -->
                <div class="w-3/4">
                    <!-- Food Cards -->
                    <div class="space-y-6">
                        @if($result->isNotEmpty())
                            <h2 class="text-darkPurple p-4 text-3xl font-semibold">Search results matching "{{ request('query') }}"</h2>
                            @foreach($result as $food)
                                <div class="bg-white p-4 flex gap-4 border-b-2">
                                    <div class="w-1/2">
                                        <div class="flex justify-between items-center mb-3">
                                            <div class="flex items-center">
                                                <a href="">
                                                    <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                                                </a>
                                                <div class="ml-3">
                                                    <a href="" class="font-medium text-base hover:text-gray-500 font-poppins">{{$food->user->full_name}}</a>
                                                    <p class="text-gray-500 text-xs font-poppins">{{ $food->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            {{-- <button class="bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button> --}}
                                            @php
                                                $authUser = auth()->user();
                                                $isFollowing = $authUser && isset($food->user) ? $authUser->isFollowing($food->user->id) : false;
                                            @endphp

                                            @if ($authUser && $authUser->id === $food->user->id)
                                                {{-- If the post is by the authenticated user, not showing any button --}}
                                            @else
                                                @if (!$authUser)
                                                    {{-- If the user is not logged in, showing the Follow button --}}
                                                    <button type="button" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                                        Follow
                                                    </button>
                                                @else
                                                    {{-- If logged in, check if they are following --}}
                                                    @if ($isFollowing)
                                                        <button class="py-1 px-5 bg-gray-200 text-sm font-medium rounded-md hover:bg-gray-300">
                                                            Following
                                                        </button>
                                                    @else
                                                        <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                                            Follow
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                        <img src="{{ asset('uploads/' . $food->image) }}" class="w-full h-96 rounded-lg object-cover">
                                        <div class="flex justify-between items-center mt-2 mb-2">
                                            <div class="flex items-center space-x-4">
                                                @include('components.like-button', ['food' => $food])
                                                <span class="text-black text-base">
                                                    <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> {{ $food->reviews->count() }}
                                                </span>
                                            </div>
                                            <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                            <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                                        </div>
                                    </div>
                                    <div class="w-1/2 flex flex-col justify-between mt-14">
                                        <div>
                                            <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$food->tag->name}}</span>
                                            <div class="flex justify-between">
                                                <a href="{{route('food.details', $food->id)}}" class="text-lg font-medium font-poppins mt-2">{{$food->name}}</a>
                                                <a href="" class="border-2 border-gray-400 rounded-3xl py-2 px-4 text-xs font-poppins hover:bg-black hover:text-white transition">
                                                    <i class="fa-solid fa-location-dot text-customYellow mr-2"></i>See Location
                                                </a>
                                            </div>
                                            <p class="text-gray-600 text-base">Restaurant: {{$food->restaurant->name}}</p>
                                            <p class="text-gray-500 text-sm">{{$food->foodType->name}}, {{$food->cuisineType->name}}</p>
                                            {{-- Display the rating as stars --}}
                                            @php
                                                $userRatingValue = round($food->rating);
                                                // $formattedRating = number_format($userRatingValue, 1);
                                            @endphp

                                            <div class="flex items-center mr-2 my-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $userRatingValue)
                                                        <!-- Full star if the rating is less than or equal to the user's rating -->
                                                        <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                            class="bg-customYellow p-1 rounded-md mr-1" 
                                                            style="height: 25px; width: 25px;" 
                                                            alt="Full">
                                                    @else
                                                        <!-- Empty star if the rating is less than the current iteration -->
                                                        <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                            class="bg-gray-300 p-1 rounded-md mr-1" 
                                                            style="height: 25px; width: 25px;" 
                                                            alt="Empty">
                                                    @endif
                                                @endfor
                                                <p class="ml-2 text-lightgray font-normal text-sm">{{ $food->reviews->count() }} Reviews</p>
                                            </div>
                                            <p class="font-medium">Rs.{{$food->price}}</p>
                                            <p class="text-gray-600 text-sm mt-2">{{$food->review}}</p>
                                            <a href="{{route('food.details', $food->id)}}" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-lg text-center mt-10">No results found for "{{ request('query') }}". Try searching for something else!</p>
                        @endif
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>