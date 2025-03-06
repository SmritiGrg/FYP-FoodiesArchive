<x-app-layout>
    {{-- <section class="pt-20">
        <div class="flex justify-between py-8 px-24 text-center">
            <div class="flex space-x-12 items-center">
                <p>See All</p>
                @foreach ($foodTypes as $foodType)
                    <p>{{$foodType->name}}</p>
                @endforeach
                @foreach ($cuisineTypes as $cuisineType)
                    <p>{{$cuisineType->name}}</p>
                @endforeach
            </div>
            <div class="flex items-center">
                <p>gffgf</p>
            </div>
            <div class="flex items-center">
                <p class="font-poppins">Sort By:</p>
                <select class="border p-2 rounded-lg">
                    <option class="font-poppins text-sm">Popularity</option>
                    <option class="font-poppins text-sm">Price: Low to High</option>
                    <option class="font-poppins text-sm">Price: High to Low</option>
                </select>
            </div>
        </div>
    </section> --}}

    <section class="pt-20">
        <div class="flex justify-between py-8 px-24 text-center">
            <div class="relative w-2/3 overflow-hidden text-center">
                <button id="left-btn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white border-2 text-black rounded-full z-10">&#10094;</button>
                <div id="sliderCategory" class="flex space-x-12 items-center overflow-x-auto scroll-smooth whitespace-nowrap px-12">
                    <p>See All</p>
                    @foreach ($foodTypes as $foodType)
                        <p>{{$foodType->name}}</p>
                    @endforeach
                    @foreach ($cuisineTypes as $cuisineType)
                        <p>{{$cuisineType->name}}</p>
                    @endforeach
                </div>
                <button id="right-btn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10">&#10095;</button>
            </div>
            <div class="flex items-center">
                <p>gffgf</p>
            </div>
            <div class="flex items-center">
                <p class="font-poppins">Sort By:</p>
                <select class="border p-2 rounded-lg">
                    <option class="font-poppins text-sm">Popularity</option>
                    <option class="font-poppins text-sm">Price: Low to High</option>
                    <option class="font-poppins text-sm">Price: High to Low</option>
                </select>
            </div>
        </div>
    </section>

    <section class="px-8 pt-28 pb-7 max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold mb-6 text-center text-darkPurple font-poppins">Dive Into Delicious Discoveries.</h1>
            
            <div class="flex gap-6">
                <!-- Sidebar Filters -->
                {{-- <div class="w-1/4 bg-white p-4 rounded-lg shadow-md h-[80vh] sticky top-28">
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
                </div> --}}
                
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
                                                <a href="" class="font-medium text-base hover:text-gray-500 font-poppins">{{$food->user->full_name}}</a>
                                                <p class="text-gray-500 text-xs font-poppins">{{ $food->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <button class="bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                                    </div>
                                    <img src="{{ asset('uploads/' . $food->image) }}" class="w-full h-96 rounded-lg object-cover">
                                    <div class="flex justify-between items-center mt-2 mb-2">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-black text-base">
                                                <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                                <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> {{ $food->likes->count() }}
                                            </span>

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
                                        <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-2 rounded">{{$food->tag->name}}</span>
                                        <div class="flex justify-between">
                                            <a href="" class="text-lg font-medium font-poppins mt-2">{{$food->name}}</a>
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
                                            <p class="ml-2 text-black">{{ $formattedRating }}</p>
                                        </div>

                                        <p class="font-medium">Rs.{{$food->price}}</p>
                                        <p class="text-gray-600 text-sm mt-2">{{$food->review}}</p>
                                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>