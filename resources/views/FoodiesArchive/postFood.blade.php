@extends('layouts.postMain')
@section('container')

    <section class="pt-10 pb-5 fixed bg-white right-10">
        <div class="px-3 sm:px-6 lg:px-24 md:px-11 mt-10">
            <ul class="mx-auto grid max-w-md grid-cols-1 gap-10 lg:max-w-full lg:grid-cols-6">
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full border-4 border-yellowStroke bg-customYellow text-sm font-bold text-white">
                        1
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Basic Info</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        2
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Choose the cuisine type</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        3
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Select the food type</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        4
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Add relevant tag</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        5
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Upload Photo</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        6
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h4 class="text-sm text-gray-700">Review and Submit</h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>


    {{-- <section class="pt-32 pb-40">
        <form enctype="multipart/form-data" method="post" action="{{ route('foodpost.store') }}">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <label for="name">Food Name</label>
            <input type="text" id="name" name="name" placeholder="Food Name"><br>

            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Price"><br>

            <label for="review">Review</label>
            <textarea name="review" id="review"></textarea><br>

            <label for="restaurant">Restaurant</label>
            <select name="restaurant_id" id="restaurant">
                <option value="" disabled selected>Select a restaurant</option>
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>

            <label for="foodtype" class="form-label">Food Type</label>
            <select class="form-select" id="foodtype" name="food_type_id">
                <option value="" disabled selected>Select a food type</option>
                @foreach ($foodtypes as $foodtype)
                    <option value="{{ $foodtype->id }}">{{ $foodtype->name }}</option>
                @endforeach
            </select> <br>

            <label for="cuisinetype" class="form-label">Cuisine Type</label>
            <select class="form-select" id="cuisinetype" name="cuisine_type_id">
                <option value="" disabled selected>Select a cuisine type</option>
                @foreach ($cuisinetypes as $cuisinetype)
                    <option value="{{ $cuisinetype->id }}">{{ $cuisinetype->name }}</option>
                @endforeach
            </select> <br>

            <label for="tag" class="form-label">Tag</label>
            <select class="form-select" id="tag" name="tag_id">
                <option value="" disabled selected>Select a tag</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select><br>

            <label class="form-label" for="basic-icon-default-company">Image</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-company2" class="input-group-text"><i
                                    class="bx bx-buildings"></i></span>
                            <input type="file" id="basic-icon-default-company" class="form-control" name="image" />
                        </div>

            <button type="submit" class="font-poppins bg-customYellow text-black text-sm px-4 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition">
                Upload
            </button>
        </form>
    </section> --}}

    {{-- <section class="pt-5">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-lg">
                <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Basic Info</h2>
                <p class="text-gray-600 mt-3 font-poppins">Enter the basic information about the food item.</p>

                <!-- Form Fields -->
                <form class="mt-6 space-y-4" enctype="multipart/form-data" method="post" action="{{ route('foodpost.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div>
                        <label class="block font-medium text-gray-700 font-poppins" for="name">Food Name <span class="text-red-500">*</span></label>
                        <input type="text" placeholder="Eg: Chicken Burger" id="name"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none" name="name">
                    </div>

                    <div>
                        <label for="restaurant" class="block font-medium text-gray-700 font-poppins">Restaurant Name <span class="text-red-500">*</span></label>
                        <select id="restaurant" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none" name="restaurant_id">
                            <option value="" disabled selected>Select a restaurant</option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 font-poppins" for="price">Price <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="text" placeholder="Eg: 350" id="price"
                                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none" name="price">
                            <span class="absolute right-3 top-3 text-gray-500 text-sm font-poppins">In NRS.</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="fixed bottom-4 left-0 right-0 flex justify-between px-24">
                <button class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Back</span>
                </button>
                <button type="submit" class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                    Next Step
                </button>
            </div>
        </div>
    </section> --}}

    <section class="pt-40 pb-32">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-lg">
                <!-- Multistep Form -->
                <form id="multiStepForm" class="mt-6 space-y-6" enctype="multipart/form-data" method="post" action="{{ $currentStep == 6 ? route('foodpost.store') : route('foodpost.next') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    
                    <!-- Step 1: Basic Info -->
                    @if ($currentStep == 1)
                        <div id="step1" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Basic Info</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Enter the basic information about the food item.</p>
                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="name">Food Name <span class="text-red-500">*</span></label>
                                <input type="text" placeholder="Eg: Chicken Burger" id="name" value="{{ old('name') }}"
                                    class="w-full mt-1 p-2 border rounded-md focus:outline-none {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}" name="name">
                                    @error('name')
                                        <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                                    @enderror
                            </div>

                            <div class="mt-3">
                                <label for="restaurant" class="font-medium text-gray-700 font-poppins">
                                    Restaurant Name <span class="text-red-500">*</span>
                                </label>
                                <select id="restaurant" name="restaurant_id" 
                                    class="w-full mt-1 p-2 border rounded-md focus:outline-none text-gray-700 
                                    {{ $errors->has('restaurant_id') ? 'border-red-500' : 'border-gray-300' }}">
                                    <option value="" disabled selected>Select a restaurant</option>
                                    @foreach ($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                            {{ $restaurant->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('restaurant_id')
                                    <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="price">Price <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" placeholder="Eg: 350" id="price"
                                        class="w-full mt-1 p-2 border rounded-md focus:outline-none 
                                        {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }}" 
                                        name="price">
                                    <span class="absolute right-3 top-3 text-gray-500 text-sm font-poppins">In NRS.</span>
                                    @error('price')
                                        <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Step 2: Choose Cuisine Type -->
                    @if ($currentStep == 2)
                        <div id="step2" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Choose the cuisine type</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Select the cuisine type that best describes this food.</p>

                            <div class="mt-4 grid grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($cuisinetypes as $cuisinetype)
                                    <label class="cuisine-type-label border border-gray-300 px-4 py-4 rounded-md font-semibold text-center 
                                        hover:outline hover:outline-2 hover:outline-black cursor-pointer">
                                        <input type="radio" name="cuisine_type_id" value="{{ $cuisinetype->id }}" class="hidden">
                                        {{ $cuisinetype->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('cuisine_type_id')
                                <p class="text-sm text-red-600 mt-2 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Step 3: Choose Food Type -->
                    @if ($currentStep == 3)
                        <div id="step3" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Choose the food type</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Choose the appropriate food type.</p>

                            <div class="mt-3 grid grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($foodtypes as $foodtype)
                                    <label class="food-type-label border border-gray-300 px-4 py-4 rounded-md font-semibold text-center 
                                        hover:outline hover:outline-2 hover:outline-black cursor-pointer">
                                        <input type="radio" name="food_type_id" value="{{ $foodtype->id }}" class="hidden">
                                        {{ $foodtype->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('food_type_id')
                                <p class="text-sm text-red-600 mt-2 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Step 4: Choose Tag -->
                    @if ($currentStep == 4)
                        <div id="step4" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Add relevant tags</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Tag this food  to highlight the best features of this food</p>

                            <div class="mt-3 grid grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($tags as $tag)
                                    <label class="tag-label border border-gray-300 px-4 py-4 rounded-md font-semibold text-center 
                                        hover:outline hover:outline-2 hover:outline-black cursor-pointer">
                                        <input type="radio" name="tag_id" value="{{ $tag->id }}" class="hidden">
                                        {{ $tag->name }}
                                    </label>
                                @endforeach
                            </div>
                            @error('tag_id')
                                <p class="text-sm text-red-600 mt-2 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Step 5: Upload Image -->
                    @if ($currentStep == 5)
                        <div id="step5" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Upload Photo</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Upload clear food image</p>

                            <div class="mt-3 w-[60vh] h-[65vh]">
                                <label for="drop_image" class="flex flex-col items-center justify-center w-[60vh] h-[65vh] 
                                            border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 hover:bg-gray-100">
                                    <div id="image-container" class="flex flex-col items-center justify-center pt-5 pb-6" >
                                        <i class="fa-solid fa-image text-gray-500 text-5xl mb-5 rotate-1"></i>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Click to upload</span>
                                        </p>
                                        <p class="text-xs text-gray-500">JPEG, PNG, JPG (MAX. 2MB)</p>
                                    </div>
                                    <input
                                        id="drop_image"
                                        type="file"
                                        name="image"
                                        class="hidden"
                                        accept="image/*"
                                    />
                                </label>
                                @error('image')
                                    <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <label for="image">
                                <input type="file" name="image" id="image">    
                            </label> --}}
                            {{-- @error('image')
                                        <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                    @enderror --}}
                        </div>
                    @endif

                    <!-- Step 6: Review and rating -->
                    @if ($currentStep == 6)
                        <div id="step6" class="step">
                            <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Review and Rating</h2>
                            <p class="text-gray-600 mt-2 font-poppins">Give your honest review and rating</p>

                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="review">Write your Review</label>
                                <textarea placeholder="This is a very tasty food..." id="review"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none"
                                    name="review" rows="4"></textarea>
                                    @error('review')
                                        <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                    @enderror
                            </div>

                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="review">Rate your food</label>
                                <div class="flex">
                                    <div class="rate flex pt-1">
                                        <input type="radio" id="star1" class="hidden" name="rating" value="1" />
                                        <label for="star1" data-title="Poor" class="pr-3">
                                            <img
                                                src="{{asset('assets/img/cutlery (1).png')}}"
                                                alt="Poor"
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
                                        <label for="star4" data-title="Average" class="pr-3">
                                            <img
                                                src="{{asset('assets/img/cutlery (1).png')}}"
                                                alt="Average"
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
                                </div>
                                @error('rating')
                                    <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="fixed bottom-0 left-0 right-0 flex justify-between px-24 bg-gray-100 py-3 border-t-8 border-gray-200">
                        <button type="submit" formaction="{{ route('foodpost.clearSession') }}"
                            class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500 hvr-icon-back">
                            <i class="fa-solid fa-arrow-left-long hvr-icon"></i>
                            <span>clear</span>
                        </button>

                        @if ($currentStep > 1)
                            <button type="submit" formaction="{{ route('foodpost.previous') }}"
                                class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500 hvr-icon-back">
                                <i class="fa-solid fa-arrow-left-long hvr-icon"></i>
                                <span>Back</span>
                            </button>
                        @endif

                        @if ($currentStep < 6)
                            <button type="submit" formaction="{{ route('foodpost.next') }}" 
                                class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                                Next Step
                            </button>
                        @endif

                        @if ($currentStep == 6)
                            <button type="submit" class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                                Submit
                            </button>
                        @endif
                    </div>
                </form>
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

        //////// NAV REALTED JS
        document.addEventListener("DOMContentLoaded", function () {
            const userMenuButton = document.getElementById("user-menu-button");
            const userMenu = document.querySelector('[role="menu"]'); 

            userMenuButton.addEventListener("click", function (event) {
                event.stopPropagation(); 
                userMenu.classList.toggle("hidden");
            });

            // Close menu when clicking outside
            document.addEventListener("click", function (event) {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenu.classList.add("hidden");
                }
            });
        });


        ////// JS FOR BACKGROUND COLOR AND BORDER WHEN SELECTING RADIO TYPES
        document.addEventListener("DOMContentLoaded", function () {
            // Select all labels with 'cuisine-label', 'foodtype-label', and 'tag-label' classes
            const cuisineLabels = document.querySelectorAll(".cuisine-type-label");
            const foodtypeLabels = document.querySelectorAll(".food-type-label");
            const tagLabels = document.querySelectorAll(".tag-label");

            // Function to handle label selection for any radio group
            function handleRadioSelection(labels) {
                labels.forEach(label => {
                    label.addEventListener("click", function () {
                        // Remove the selected styles from all labels in the group
                        labels.forEach(lbl => lbl.classList.remove("outline", "outline-2", "outline-black", "bg-gray-100"));
                        
                        // Add the selected styles to the clicked label
                        this.classList.add("outline", "outline-2", "outline-black", "bg-gray-100");

                        // Mark the corresponding radio button as checked
                        const radioButton = this.querySelector('input[type="radio"]');
                        radioButton.checked = true;
                    });
                });
            }

            // Apply the selection handler to each group of labels
            handleRadioSelection(cuisineLabels);
            handleRadioSelection(foodtypeLabels);
            handleRadioSelection(tagLabels);
        });
        /////END

        document.getElementById("drop_image").addEventListener("change", function (event) {
            const file = event.target.files[0];
            console.log("Selected file:", file);
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewContainer = document.getElementById("image-container");
                    previewContainer.innerHTML = '';
                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Selected Image" class="w-[60vh] h-[65vh] object-cover" />`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection