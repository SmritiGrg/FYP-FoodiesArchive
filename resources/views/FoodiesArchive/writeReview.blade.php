<x-app-layout>
    <section>
        <div class="text-center pb-12 pt-28 bg-white">
            <p class="text-darkPurple text-2xl sm:text-4xl md:text-4xl font-extrabold">
                A few words from you,
            </p>
            <p class="text-customYellow text-2xl sm:text-4xl md:text-4xl font-extrabold pt-3">
                a delicious journey for someone else!
            </p>
            <p class="mt-3 text-xs sm:text-sm md:text-base text-gray-600">
                Tried something unforgettable? From local eateries to fancy restaurants—review it here!
            </p>

            <div class="mt-10 flex justify-center px-4 sm:px-0" id="search-container">
                <div class="relative w-full max-w-2xl">
                    <form action="" method="GET">
                        <input 
                            id="search-bar"
                            type="text" 
                            name="query"
                            placeholder="Type the name of a place or dish to review..." 
                            class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 rounded-full border border-gray-300 focus:outline-none"
                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                            onfocus="showModal()"
                            onblur="hideModal()"
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
                    <div id="search-modal" class="absolute left-0 mt-2 w-full z-50 bg-white rounded-xl shadow-md hidden">
                        <div class="p-4 flex items-center">
                            <i class="fa-solid fa-location-arrow text-base"></i>
                            <span class="pl-3">Nearby</span>
                        </div>
                        <ul class="p-4">
                            @foreach($results as $item)
                                <li class="border-b py-2">
                                    <a href="{{ route('foodpost.show', $item->id) }}" class="text-gray-800 hover:text-customYellow">
                                        {{ $item->name }} ({{ $item->restaurant->name }})
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @if($result->isEmpty())
                            <div class="p-4 text-center text-gray-500">No results found.</div>
                        @endif
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
                    <div class="w-96 sm:w-64 h-64 shrink-0">
                        <img src="{{ asset('uploads/' . $food->image) }}" alt="img" class="w-full h-full object-cover rounded-md" />
                    </div>

                    <!-- Ensure text section has a flexible width -->
                    <div class="pt-1 sm:px-4 flex-1">
                        <a href="" class="text-lg font-bold hover:text-gray-500">{{$food->name}}</a>
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
                        <a href="#" class="text-darkPurple hover:underline text-sm underline">See More</a>

                        <div class="flex items-center mt-2 sm:mt-12">
                            <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="profile" class="w-10 h-10 rounded-full mr-3">
                            <div class="pl-1">
                                <a href="" class="text-sm font-medium hover:text-gray-500">Uploaded by {{$food->user->username}}</a>
                                <p class="text-xs text-gray-500">{{ $food->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
</x-app-layout>