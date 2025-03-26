<x-app-layout>
    <section class="pt-20 px-24">
        <div class="grid grid-cols-4 items-center">
            <div class="col-span-3 flex items-center relative">
                <button id="leftArrow" class="absolute left-0 top-1/2 -translate-y-1/2 bg-white border-2 border-gray-200 text-gray-600 p-2 rounded-full w-9 h-9 shadow-md hover:shadow-lg transition z-20 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>

                <div class="relative w-full mx-8">
                    <div class="absolute left-0 top-0 h-full w-12 bg-gradient-to-r from-white/90 to-transparent pointer-events-none"></div>

                    <div class="scroll-container flex flex-row items-center justify-between overflow-x-auto gap-5" style="scrollbar-width: none; -ms-overflow-style: none;">
                        @foreach ($foodTypes as $foodType)
                            <p class="font-medium text-sm text-gray-600 hover:text-gray-900 transition cursor-pointer border-b-2 border-transparent hover:border-gray-400 p-3">
                                {{$foodType->name}}
                            </p>
                        @endforeach
                        @foreach ($cuisineTypes as $cuisineType)
                            <p class="font-medium text-sm text-gray-600 hover:text-gray-900 transition cursor-pointer border-b-2 border-transparent hover:border-gray-400 p-3">
                                {{$cuisineType->name}}
                            </p>
                        @endforeach
                    </div>

                    <div class="absolute right-0 top-0 h-full w-12 bg-gradient-to-l from-white/70 to-transparent pointer-events-none"></div>
                </div>

                <button id="rightArrow" class="absolute -right-16 top-1/2 -translate-y-1/2 bg-white border-2 border-gray-200 text-gray-600 p-2 rounded-full w-9 h-9 shadow-md hover:shadow-lg transition z-20 flex items-center justify-center">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div class="col-span-1 flex justify-end">
                <button class="border-2 border-gray-200 rounded-xl py-2 px-4 text-base flex items-center gap-2 hover:bg-gray-100 hover:border-gray-500 transition cursor-pointer" onclick="openModal()">
                    <i class="ri-equalizer-line"></i> Filters
                </button>
            </div>
        </div>
    </section>

    {{-- FILTER MODAL --}}
    <div id="filterModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50">
        <div class="flex items-center justify-center h-full p-4">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-3xl">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="bg-white w-1/4 rounded-3xl h-[70vh] flex-col flex p-4">
                <h2 class="text-lg font-semibold mb-4 border-b-2 text-center pb-2">Filters</h2>
                <h3 class="text-md font-medium mb-2">Price Range</h3>
                <div class="grid grid-cols-2 items-center gap-4">
                    <div class="col-span-1 flex flex-col">
                        <label for="from" class="text-sm text-gray-400 font-medium pb-2">From:</label>
                        <input id="from" type="number" class="w-24 border border-gray-300 rounded-2xl px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:bg-gray-100" value="50" min="50" max="4000">
                    </div>
                    <div class="col-span-1 flex flex-col ml-auto">
                        <label for="to" class="text-sm text-gray-400 font-medium pb-2">To:</label>
                        <input id="to" type="number" class="w-24 border border-gray-300 font-light rounded-2xl px-3 py-3 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:bg-gray-100" value="4000" min="50" max="4000">
                    </div>
                </div>

                <div class="flex flex-col gap-4 mt-5">
                    <h3 class="text-md font-medium mb-2">Rating</h3>
                    <!-- Rating 5 -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500">
                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                            <img src="{{asset('assets/img/cutlery (1).png')}}" alt="" class="bg-customYellow p-1 rounded-md"
                                style="height: 25px; width: 25px">
                        </div>
                        <span>5.0</span>
                    </label>

                    <!-- Rating 4 -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500">
                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                            <img src="{{asset('assets/img/cutlery (1).png')}}" alt="" class="bg-customYellow p-1 rounded-md"
                                style="height: 25px; width: 25px">
                        </div>
                        <span>4.0</span>
                    </label>

                    <!-- Rating 3 -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500">
                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                            <img src="{{asset('assets/img/cutlery (1).png')}}" alt="" class="bg-customYellow p-1 rounded-md"
                            style="height: 25px; width: 25px">
                        </div>
                        <span>3.0</span>
                    </label>

                    <!-- Rating 2 -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500">
                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                            <img src="{{asset('assets/img/cutlery (1).png')}}" alt="" class="bg-customYellow p-1 rounded-md"
                                style="height: 25px; width: 25px">
                        </div>
                        <span>2.0</span>
                    </label>

                    <!-- Rating 1 -->
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500">
                        <div class="w-6 h-6 bg-yellow-500 rounded flex items-center justify-center">
                            <img src="{{asset('assets/img/cutlery (1).png')}}" alt="" class="bg-customYellow p-1 rounded-md"
                                                    style="height: 25px; width: 25px">
                        </div>
                        <span>1</span>
                    </label>
                </div>
            </div>
        </div>
    </div>


    <section class="px-8 pt-8 pb-7 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-darkPurple font-poppins">Dive Into Delicious Discoveries.</h1>
        <div class="flex gap-36">
            <!-- Main Content -->
            <div class="w-3/4">
                <!-- Food Cards -->
                <div class="space-y-6">
                    @foreach($foods as $food)
                        <div class="bg-white p-4 flex gap-4 border-b-2">
                            <div class="w-1/2">
                                <div class="flex justify-between items-center mb-3">
                                    <div class="flex items-center">
                                        <a href="">
                                            <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                                        </a>
                                        <div class="ml-3">
                                            <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="font-medium text-base hover:text-gray-500 font-poppins">{{$food->user->full_name}}</a>
                                            <p class="text-gray-500 text-xs font-poppins">{{ $food->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
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
                                <img src="{{ asset($food->image) }}" class="w-full h-96 rounded-lg object-cover">
                                <div class="flex justify-between items-center mt-2 mb-2">
                                    <div class="flex items-center space-x-4">
                                        @include('components.like-button', ['food' => $food])
                                        <span class="text-black text-base">
                                            <i class="fa-regular fa-comment text-xl hover:text-gray-500 cursor-pointer"></i> {{ $food->reviews->count() }}
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
                                        {{-- <a href="{{route('food.details', $food->id)}}" class="text-lg font-medium font-poppins mt-2">{{$food->name}}</a> --}}
                                        <a href="{{ route('food.details', ['id' => $food->id, 'scroll' => $loop->index]) }}" 
                                            class="text-lg font-medium font-poppins mt-2 post-link">
                                            {{ $food->name }}
                                        </a>

                                        <a href="" class="border-2 border-gray-400 rounded-3xl py-2 px-4 text-xs font-poppins hover:bg-black hover:text-white transition">
                                            <i class="fa-solid fa-location-dot text-customYellow mr-2"></i>See Location
                                        </a>
                                    </div>
                                    <p class="text-gray-600 text-base">Restaurant: {{$food->restaurant->name}}</p>
                                    <p class="text-gray-500 text-sm">{{$food->foodType->name}}, {{$food->cuisineType->name}}</p>
                                    {{-- Display the average rating as stars --}}
                                    @php
                                        $userRatingValue = round($food->rating);
                                        $formattedRating = number_format($userRatingValue, 1);
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
                                        <p class="pl-1">{{$formattedRating}}</p>
                                        <p class="ml-2 text-lightgray font-normal text-xs">({{ $food->reviews->count() }} Reviews)</p>
                                    </div>

                                    <p class="font-medium">Rs. {{$food->price}}</p>
                                    <p class="text-gray-600 text-sm mt-2">{{$food->review}}</p>
                                    <a href="{{route('food.details', $food->id)}}" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $foods->links() }}
                </div>
        </div>
            <!-- Suggested For You (Top Foodies Section) -->
            <div class="w-1/4">
                <div class="bg-white">
                    <h2 class="text-base font-medium text-darkPurple mb-4">Foodies You Might Like</h2>
                    <div class="space-y-4">
                        @foreach($topFoodies as $user)
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('uploads/profile-images/' . $user->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover">
                                <div class="w-full">
                                    {{-- <a href="{{ route('otherProfile', ['id' => $user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{ $user->full_name }}</a> --}}
                                    <div class="flex items-center justify-between relative">
                                        <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{$user->full_name}}</a>
                                        <div>
                                            @php
                                                $authUser = auth()->user();
                                                $isFollowing = $authUser && isset($user) ? $authUser->isFollowing($user->id) : false;
                                            @endphp

                                            @if (!$authUser)
                                                {{-- If the user is not logged in, show the Follow button --}}
                                                <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                    Follow
                                                </button>
                                            @else
                                                {{-- If logged in, check if they are following --}}
                                                @if ($isFollowing)
                                                    <button class="py-1 px-5 bg-gray-200 text-sm font-medium rounded-md hover:bg-gray-300">
                                                        Following
                                                    </button>
                                                @else
                                                    <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                        Follow
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-gray-500 text-xs">{{ $user->username }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @php
        $scrollPosition = request()->query('scroll', null);
    @endphp

    @if($scrollPosition !== null)
        <script>
            window.onload = function() {
                var postElements = document.querySelectorAll('.post-link');
                if (postElements.length > {{ $scrollPosition }}) {
                    postElements[{{ $scrollPosition }}].scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    console.error("Invalid scroll position:", {{ $scrollPosition }});
                }
            };
        </script>
    @endif

    <script>
        // Sliding the cuisine and food types
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector(".scroll-container");
            const leftArrow = document.getElementById("leftArrow");
            const rightArrow = document.getElementById("rightArrow");

            const scrollAmount = 200;

            if (leftArrow && rightArrow && container) {
                leftArrow.addEventListener("click", () => {
                    container.scrollBy({ left: -scrollAmount, behavior: "smooth" });
                });

                rightArrow.addEventListener("click", () => {
                    container.scrollBy({ left: scrollAmount, behavior: "smooth" });
                });
            }

            /////// FILTER MODAL
            function openModal() {
                const modal = document.getElementById("filterModal");
                if (modal) {
                    modal.classList.remove("hidden");
                    document.body.style.overflow = "hidden"; 
                }
            }

            function closeModal() {
                const modal = document.getElementById("filterModal");
                if (modal) {
                    modal.classList.add("hidden");
                    document.body.style.overflow = "auto"; 
                }
            }

            // Close modal when clicking outside of it
            const filterModal = document.getElementById("filterModal");
            if (filterModal) {
                filterModal.addEventListener("click", function (event) {
                    const modalContent = this.querySelector(".bg-white"); // Targeting the actual modal content
                    if (!modalContent.contains(event.target)) {
                        closeModal();
                    }
                });
            }

            window.openModal = openModal;
            window.closeModal = closeModal;
        });
    </script>

</x-app-layout>