<x-app-layout>
    <section class="pt-24 px-2 lg:px-3 xl:px-24">
        <div class="mx-auto p-4 bg-white">
            <div class="flex items-center mb-6">
                <a href="{{ route('food.details', ['id' => $foodPost->id]) }}" class="text-gray-700 font-medium hover:text-gray-500 hvr-icon-back"><i class="fa-solid fa-arrow-left-long hvr-icon"></i> Back</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="md:col-span-1 border-b-2 pb-4 md:border-r-2 md:border-b-0 md:pb-0">
                    <h1 class="text-2xl xl:text-3xl font-bold mb-6">Tell us, how was your <br> experience?</h1>
                    
                    <div class="mb-4">
                        <img src="{{ asset($foodPost->image) }}" alt="Food Img" class="w-80 h-80 object-cover rounded-lg">
                    </div>
                    
                    <h2 class="text-2xl font-bold mt-4">{{$foodPost->name}}</h2>
                    <p class="text-gray-600">Restaurant: {{$foodPost->restaurant->name}}</p>
                </div>
            
                <!-- Right Column -->
                <div class="md:col-span-1 lg:col-span-1 xl:col-span-2  pl-0 lg:pl-10">
                    <div class="mb-8">
                        <h3 class="text-lg sm:text-xl font-semibold mb-3">Overall Rating</h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                @php
                                    $averageRating = round($foodPost->reviews->avg('rating'));
                                    $formattedRating = number_format($averageRating, 1);
                                @endphp
                                <div class="mr-3">
                                    <img
                                        src="{{asset('assets/img/cutlery (1).png')}}"
                                        class=" bg-customYellow p-1 rounded-md"
                                        style="height: 30px; width: 30px"
                                    />
                                </div>
                                <p class="text-base sm:text-xl font-medium mr-6">{{$formattedRating}}</p>
                            </div>
                            <span class="text-base sm:text-lg font-medium">{{$foodPost->reviews->count()}} reviews</span>
                        </div>
                    </div>
                    <form action="{{route('review.store')}}" method="POST">
                        @csrf
                        <div class="mb-8">
                            <input type="hidden" name="food_post_id" value="{{ $foodPost->id }}">
                            <h3 class="text-lg sm:text-xl font-semibold mb-3">Rate your food</h3>
                            <div class="flex">
                                <div class="rate flex pt-1">
                                    <input type="radio" id="star1" class="hidden" name="rating" value="1" />
                                    <label for="star1" data-title="Poor" class="pr-3">
                                        <img
                                            src="{{asset('assets/img/cutlery (1).png')}}"
                                            alt="Average"
                                            class="rating-icon bg-gray-300 p-1 rounded-md cursor-pointer"
                                            style="height: 30px; width: 30px"
                                        />
                                    </label>

                                    <input type="radio" id="star2" class="hidden" name="rating" value="2" />
                                    <label for="star2" data-title="Average" class="pr-3">
                                        <img
                                            src="{{asset('assets/img/cutlery (1).png')}}"
                                            alt="Average"
                                            class="rating-icon bg-gray-300 p-1 rounded-md cursor-pointer"
                                            style="height: 30px; width: 30px"
                                        />
                                    </label>

                                    <input type="radio" id="star3" class="hidden" name="rating" value="3" />
                                    <label for="star3" data-title="Good" class="pr-3">
                                        <img
                                            src="{{asset('assets/img/cutlery (1).png')}}"
                                            alt="Good"
                                            class="rating-icon bg-gray-300 p-1 rounded-md cursor-pointer"
                                            style="height: 30px; width: 30px"
                                        />
                                    </label>

                                    <input type="radio" id="star4" class="hidden" name="rating" value="4" />
                                    <label for="star4" data-title="Very Good" class="pr-3">
                                        <img
                                            src="{{asset('assets/img/cutlery (1).png')}}"
                                            alt="Very Good"
                                            class="rating-icon bg-gray-300 p-1 rounded-md cursor-pointer"
                                            style="height: 30px; width: 30px"
                                        />
                                    </label>

                                    <input type="radio" id="star5" class="hidden" name="rating" value="5" />
                                    <label for="star5" data-title="Excellent" class="pr-3">
                                        <img
                                            src="{{asset('assets/img/cutlery (1).png')}}"
                                            alt="Excellent"
                                            class="rating-icon bg-gray-300 p-1 rounded-md cursor-pointer"
                                            style="height: 30px; width: 30px"
                                        />
                                    </label>
                                </div>
                                <div id="rating-title" class="rating-title text-gray-700 pt-1 font-normal"></div>
                                @error('rating')
                                    <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold mb-3">Write your Review</h3>
                            <textarea 
                                class="w-full border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-1 focus:ring-blue-200" 
                                name="review"
                                rows="5" 
                                placeholder="This is a very tasty food..."
                                value="{{ old('review') }}"></textarea>
                            <div class="text-right text-gray-500 text-sm mt-1">0-100 characters</div>
                            @error('review')
                                <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full font-poppins bg-customYellow text-black text-base px-4 py-3 rounded-full font-medium hover:text-gray-600 hover:bg-hovercustomYellow transition mt-4">
                            Submit Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        const stars = document.querySelectorAll(".rating-icon");
        const ratingTitle = document.getElementById("rating-title");
        let selectedRating = 0; // To store the selected rating

        function highlightStars(index) {
            stars.forEach((star, i) => {
            if (i <= index) {
                star.classList.add("highlight");
            } else {
                star.classList.remove("highlight");
            }
            });
        }

        function resetStars() {
            stars.forEach((star, i) => {
            if (i < selectedRating) {
                star.classList.add("highlight");
            } else {
                star.classList.remove("highlight");
            }
            });
        }

        stars.forEach((star, index) => {
            star.addEventListener("mouseenter", () => {
            highlightStars(index);
            ratingTitle.textContent =
                star.parentElement.getAttribute("data-title");
            });

            star.addEventListener("mouseleave", () => {
            resetStars();
            if (selectedRating === 0) {
                ratingTitle.textContent = "";
            }
            });

            star.addEventListener("click", () => {
            selectedRating = index + 1;
            ratingTitle.textContent =
                star.parentElement.getAttribute("data-title");
            });
        });
    </script>
</x-app-layout>