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
                        <h3 class="text-sm font-bold text-gray-900">STEP 1</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Basic Info</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        2
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h3 class="text-sm font-bold text-gray-900">STEP 2</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Choose the cuisine type</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        3
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h3 class="text-sm font-bold text-gray-900">STEP 3</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Select the food type</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        4
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h3 class="text-sm font-bold text-gray-900">STEP 4</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Add relevant tag</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <span class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]" aria-hidden="true"></span>
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        5
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h3 class="text-sm font-bold text-gray-900">STEP 5</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Upload Photo</h4>
                    </div>
                </li>
                <li class="flex-start relative flex lg:flex-col">
                    <div class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-stepGray text-sm font-bold text-white">
                        6
                    </div>
                    <div class="ml-6 lg:ml-0 lg:mt-2">
                        <h3 class="text-sm font-bold text-gray-900">STEP 6</h3>
                        <h4 class="mt-1 text-sm text-gray-700">Review and Submit</h4>
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

    <section class="pt-44 pb-32">
        <div class="flex flex-col items-center justify-center">
            <div class="w-full max-w-lg">
                <!-- Multistep Form -->
                <form id="multiStepForm" class="mt-6 space-y-6" enctype="multipart/form-data" method="post" action="{{ route('foodpost.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <!-- Step 1: Basic Info -->
                    <div id="step1" class="step hidden">
                        <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Basic Info</h2>
                        <p class="text-gray-600 mt-2 font-poppins">Enter the basic information about the food item.</p>

                        <div class="mt-3">
                            <label class="font-medium text-gray-700 font-poppins" for="name">Food Name <span class="text-red-500">*</span></label>
                            <input type="text" placeholder="Eg: Chicken Burger" id="name"
                                class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none" name="name">
                        </div>

                        <div class="mt-3">
                            <label for="restaurant" class="font-medium text-gray-700 font-poppins">Restaurant Name <span class="text-red-500">*</span></label>
                            <select id="restaurant" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none text-gray-700" name="restaurant_id">
                                <option value="" disabled selected>Select a restaurant</option>
                                @foreach ($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3">
                            <label class="font-medium text-gray-700 font-poppins" for="price">Price <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" placeholder="Eg: 350" id="price"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none" name="price">
                                <span class="absolute right-3 top-3 text-gray-500 text-sm font-poppins">In NRS.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Choose Cuisine Type -->
                    <div id="step2" class="step hidden">
                        <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Choose the cuisine type</h2>
                        <p class="text-gray-600 mt-2 font-poppins">Select the cuisine type that best describes this food.</p>

                        <div class="mt-4 grid grid-cols-3 gap-3" role="radiogroup">
                            @foreach ($cuisinetypes as $cuisinetype)
                                <button type="button" role="radio" aria-checked="false"
                                    class="border border-gray-300 px-4 py-4 rounded-md font-semibold text-center hover:outline hover:outline-2 hover:outline-black 
                                            focus:outline focus:outline-2 focus:outline-black focus:bg-gray-100">
                                    {{ $cuisinetype -> name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Hidden Input for Cuisine Selection -->
                        <input type="hidden" id="selectedCuisine" name="cuisine_type_id">
                    </div>

                    <!-- Step 3: Choose Food Type -->
                    <div id="step3" class="step hidden">
                        <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Choose the food type</h2>
                        <p class="text-gray-600 mt-2 font-poppins">Choose the appropriate food type.</p>

                        <div class="mt-4 grid grid-cols-3 gap-3" role="radiogroup">
                            @foreach ($foodtypes as $foodtype)
                                <button type="button" role="radio" aria-checked="false"
                                    class="border border-gray-300 px-4 py-4 rounded-md font-semibold text-center hover:outline hover:outline-2 hover:outline-black 
                                            focus:outline focus:outline-2 focus:outline-black focus:bg-gray-100">
                                    {{ $foodtype -> name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Hidden Input for Cuisine Selection -->
                        <input type="hidden" id="selectedCuisine" name="cuisine_type_id">
                    </div>

                    <!-- Step 4: Choose Tag -->
                    <div id="step3" class="step">
                        <h2 class="text-3xl font-extrabold text-darkPurple font-poppins">Add relevant tags</h2>
                        <p class="text-gray-600 mt-2 font-poppins">Tag this food  to highlight the best features of this food</p>

                        <div class="mt-4 grid grid-cols-3 gap-3" role="radiogroup">
                            @foreach ($tags as $tag)
                                <button type="button" role="radio" aria-checked="false"
                                    class="border border-gray-300 px-4 py-4 rounded-md font-semibold text-center hover:outline hover:outline-2 hover:outline-black 
                                            focus:outline focus:outline-2 focus:outline-black focus:bg-gray-100">
                                    {{ $tag -> name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Hidden Input for Cuisine Selection -->
                        <input type="hidden" id="selectedCuisine" name="cuisine_type_id">
                    </div>

                    <div class="fixed bottom-0 left-0 right-0 flex justify-between px-24 bg-gray-100 py-3 border-t-8 border-gray-200">
                        <button class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500 hvr-icon-back" type="button">
                            <i class="fa-solid fa-arrow-left-long hvr-icon"></i>
                            <span>Back</span>
                        </button>
                        <button type="button" class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                            Next Step
                        </button>
                        <button type="submit" class="font-poppins bg-customYellow text-black text-sm px-4 py-2 rounded-md font-medium hover:bg-hovercustomYellow transition">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection