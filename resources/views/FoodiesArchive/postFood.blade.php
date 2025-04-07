@extends('layouts.postMain')
@section('container')
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-green-500 border border-green-200 bg-white px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif
    <section class="pt-10 pb-3 fixed bg-white px-3">
        <div class="sm:px-6 lg:px-24 md:px-11 mt-10">
            <ul class="mx-auto grid gap-6 sm:gap-10 max-w-full grid-cols-6">
                @foreach ([1 => 'Basic Info', 2 => 'Choose the cuisine type', 3 => 'Select the food type', 4 => 'Add relevant tag', 5 => 'Upload Photo', 6 => 'Review and Submit'] as $key => $title)
                    <li class=" relative">
                        @if ($key < 6) 
                            <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px
                                {{ $key < $currentStep ? 'bg-customYellow' : 'bg-gray-300' }} 
                                lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)] hidden lg:block" 
                                aria-hidden="true">
                            </span>

                            <i class="fa-solid fa-angles-right
                            {{ $key < $currentStep ? 'text-customYellow' : 'text-gray-300' }}
                            lg:hidden absolute left-[37px] sm:left-[80px] top-2 text-xs sm:text-sm"
                            aria-hidden="true"></i>
                        @endif
                        <div class="inline-flex w-6 h-6 sm:h-9 sm:w-9 shrink-0 items-center justify-center rounded-full border-4
                            {{ $key <= $currentStep ? 'border-yellowStroke bg-customYellow text-white' : ($key < $currentStep ? 'bg-customYellow text-white' : 'bg-stepGray text-white') }}
                            text-xs sm:text-sm font-medium sm:font-bold">
                            {{ $key }}
                        </div>
                        <div class="ml-0 lg:ml-0 lg:mt-2">
                            <h4 class="text-xs sm:text-sm {{ $key <= $currentStep ? 'font-medium sm:font-bold text-black' : 'text-gray-700' }}">
                                {{ $title }}
                            </h4>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>


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

    <section class="pt-48 sm:pt-40 pb-32 px-2">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-lg">
                <!-- Multistep Form -->
                <form id="multiStepForm" class="mt-6 space-y-6" enctype="multipart/form-data" method="post" action="{{ $currentStep == 6 ? route('foodpost.store') : route('foodpost.next') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    
                    <!-- Step 1: Basic Info -->
                    @if ($currentStep == 1)
                        <div id="step1" class="step">
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Basic Info</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-1 sm:mt-2 font-poppins">Enter the basic information about the food item.</p>
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
                                            {{ $restaurant->name }}  ({{$restaurant->location}})
                                        </option>
                                    @endforeach
                                </select>
                                @error('restaurant_id')
                                    <p class="text-red-500 text-sm mt-2">{{$message}}</p>
                                @enderror
                                <button type="button" onclick="openModal()" 
                                    class="mt-2 text-sm text-blue-600 hover:underline font-poppins">
                                    + Add a new restaurant
                                </button>

                                <!-- Restaurant Add Form Modal -->
                                {{-- <div id="restaurantModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
                                    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Restaurant</h3>
                                        <p class="text-sm text-gray-600 mb-4">
                                            The restaurant details you submit will be reviewed before being listed.
                                        </p>
                                        <form method="POST" action="{{ route('restaurant.store') }}">
                                            @csrf
                                            <input type="hidden" name="added_by_user_id" value="{{ auth()->id() }}">

                                            <div class="mt-4">
                                                <x-input-label for="name" value="Restaurant Name" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                                    :error="$errors->has('name')" :value="old('name')" autofocus />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="location" value="Location" />
                                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" placeholder="Eg:Pokhara, Nepal"
                                                    :error="$errors->has('location')" :value="old('location')" autofocus/>
                                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                            </div>

                                            <div class="flex justify-end mt-4 space-x-2">
                                                <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                                            </div>
                                        </form>
                                        <!-- Close button (X) -->
                                        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="price">Price <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="text" placeholder="Eg: 350" id="price"
                                        class="w-full mt-1 p-2 border rounded-md focus:outline-none 
                                        {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }}" 
                                        name="price"
                                        value="{{ old('price') }}">
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
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Choose the cuisine type</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-2 font-poppins">Select the cuisine type that best describes this food.</p>

                            <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($cuisinetypes as $cuisinetype)
                                    <label class="cuisine-type-label border border-gray-300 px-4 py-4 rounded-md font-medium sm:font-semibold text-center 
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
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Choose the food type</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-2 font-poppins">Choose the appropriate food type.</p>

                            <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($foodtypes as $foodtype)
                                    <label class="food-type-label border border-gray-300 px-4 py-4 rounded-md font-medium sm:font-semibold text-center 
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
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Add relevant tags</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-2 font-poppins">Tag this food  to highlight the best features of this food</p>

                            <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 gap-3" role="radiogroup">
                                @foreach ($tags as $tag)
                                    <label class="tag-label border border-gray-300 px-4 py-4 rounded-md font-medium sm:font-semibold text-center 
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
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Upload Photo</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-2 font-poppins">Upload clear food image</p>

                            <div class="mt-3 w-[44vh] h-[50vh] sm:w-[60vh] sm:h-[65vh]">
                                <label for="drop_image" class="flex flex-col items-center justify-center w-[44vh] h-[50vh] sm:w-[60vh] sm:h-[65vh] 
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
                        </div>
                    @endif

                    <!-- Step 6: Review and rating -->
                    @if ($currentStep == 6)
                        <div id="step6" class="step">
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-darkPurple font-poppins">Review and Rating</h2>
                            <p class="text-sm sm:text-base text-gray-600 mt-2 font-poppins">Give your honest review and rating</p>

                            <div class="mt-3">
                                <label class="font-medium text-gray-700 font-poppins" for="review">Write your Review</label>
                                <textarea placeholder="This is a very tasty food..." id="review"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none"
                                    name="review" rows="4"
                                    value="{{ old('review') }}"></textarea>
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
                                </div>
                                @error('rating')
                                    <p class="text-sm text-red-600 space-y-1 font-poppins">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="fixed bottom-0 left-0 right-0 flex justify-between px-2 sm:px-8 md:px-12 lg:px-24 bg-gray-100 py-3 border-t-4 sm:border-t-8 border-gray-200">
                        @if ($currentStep > 1)
                            <button type="submit" formaction="{{ route('foodpost.previous') }}"
                                class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500 hvr-icon-back">
                                <i class="fa-solid fa-arrow-left-long hvr-icon"></i>
                                <span class="text-sm">Back</span>
                            </button>
                        @endif

                        <button type="submit" formaction="{{ route('foodpost.clearSession') }}"
                            class="text-gray-700 font-medium hover:text-gray-500 text-sm">
                            Clear
                        </button>

                        @if ($currentStep < 6)
                            <button type="submit" formaction="{{ route('foodpost.next') }}" 
                                class="font-poppins bg-customYellow text-black text-sm px-5 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                                Next
                            </button>
                        @endif

                        @if ($currentStep == 6)
                            <button type="submit" class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                                Submit
                            </button>
                        @endif
                    </div>
                </form>
                <!-- Restaurant Add Form Modal -->
                <div id="restaurantModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
                    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Restaurant</h3>
                        <p class="text-sm text-gray-600 mb-4">
                            The restaurant details you submit will be reviewed before being listed.
                        </p>
                        <form method="POST" action="{{ route('restaurant.store') }}">
                            @csrf
                            <input type="hidden" name="added_by_user_id" value="{{ auth()->id() }}">

                            <div class="mt-4">
                                <x-input-label for="rest_name" value="Restaurant Name" />
                                <x-text-input id="rest_name" class="block mt-1 w-full" type="text" name="name"
                                    :error="$errors->has('name')" :value="old('name')" autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="location" value="Location" />
                                <input id="location" class="block mt-1 w-full text-slate-400 bg-white border rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}"
                                    type="text" name="location" placeholder="Eg: Pokhara, Nepal"
                                    value="{{ old('location') }}" autofocus>

                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-4 space-x-2">
                                <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                            </div>
                        </form>
                        <!-- Close button (X) -->
                        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // FOR RESTAURANT ADD MODAL FORM
        function openModal() {
            document.getElementById('restaurantModal').classList.remove('hidden');
            document.getElementById('restaurantModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('restaurantModal').classList.remove('flex');
            document.getElementById('restaurantModal').classList.add('hidden');
        }

        // FOR MESSAGE
        setTimeout(function() {
            let message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000);

        // FOR RATING
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
        
        document.getElementById("menu-toggle").addEventListener("click", function () {
                document.getElementById("mobile-menu").classList.toggle("hidden");
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
                    previewContainer.innerHTML = `<img src="${e.target.result}" alt="Selected Image" class="w-[44vh] h-[50vh] sm:w-[60vh] sm:h-[65vh] object-cover" />`;
                };
                reader.readAsDataURL(file);
            }
        });

        function showNavModal() {
            document.getElementById('nav-search-modal').classList.remove('hidden');
        }

        function hideNavModal() {
            document.getElementById('nav-search-modal').classList.add('hidden');
        }

        // Adding click listener to document
        document.addEventListener('click', function(event) {
            if (!event.target.closest('#nav-search-container') && !event.target.closest('#nav-search-modal')) {
                hideNavModal();
            }
        });
    </script>
@endsection