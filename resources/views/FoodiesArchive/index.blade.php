<x-app-layout>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-green-500 border border-green-200 bg-white px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif

    @if (session('streak_message'))
        <div id="streak_message" class="fixed top-14 left-1/2 transform -translate-x-1/2 w-fit z-50">
            <p class="text-base text-white border border-yellow-600 bg-yellow-400 px-6 py-4 rounded-lg shadow-md animate-bounce">
                {{ session('streak_message') }}
            </p>
        </div>
    @endif

    {{-- assigning badge_popup in a variable and removing from the session --}}
    @if($badge = session()->pull('badge_popup'))
        <div id="badge-popup" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white text-center p-6 rounded-2xl shadow-2xl relative animate-bounce">
                <div class="flex items-center justify-center mb-4">
                    <i class="ri-award-fill text-customYellow text-2xl pr-3"></i>
                    <h2 class="text-2xl font-bold text-yellow-500">New Badge Earned!</h2>
                </div>
                <img src="{{ asset('uploads/badge-images/' . $badge['image']) }}" alt="img" class="w-28 h-28 mx-auto mb-2">
                <p class="font-semibold">{{ $badge['name'] }}</p>
                <p class="text-sm text-gray-500">{{ $badge['description'] }}</p>
                <button onclick="document.getElementById('badge-popup').remove()" class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-lg">&times;</button>
            </div>
        </div>
    @endif

    @if(session('showProfileImageModal'))
        <!-- Modal Structure for Profile Image Upload -->
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
                <div class="flex justify-between items-center border-b p-4">
                    <h5 class="text-lg font-semibold">Complete Your Profile</h5>
                    <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">
                        &times;
                    </button>
                </div>
                <div class="p-4">
                    <p class="text-gray-700 mb-4">Please upload a profile image to complete your registration.</p>
                    <!-- Profile Image Upload Form -->
                    <form action="{{ route('profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" accept="image/*" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @error('image')
                            <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="mt-4 w-full bg-customYellow hover:bg-hovercustomYellow text-black py-2 px-4 rounded-lg">
                            Upload Image
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{----- FIRST SECTION OF LANDING PAGE -----}}
    <section>
        <div class="text-center pb-12 pt-28 bg-white">
            <p class="text-darkPurple font-poppins text-3xl sm:text-4xl md:text-5xl font-extrabold">
                Start Exploring New Foods
            </p>
            <p class="mt-3 text-sm sm:text-sm md:text-base text-gray-600 font-poppins">
                Explore hidden gems, share your favorite meals, and connect with fellow food lovers!
            </p>

            <div class="mt-10 flex justify-center px-4 sm:px-0" id="search-container">
                <div class="relative w-full max-w-2xl">
                    <form action="{{ route('search.food') }}" method="GET">
                        <input 
                            id="search-bar"
                            type="search" 
                            name="query"
                            placeholder="Discover foods..." 
                            class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 rounded-full border border-gray-300 focus:outline-none"
                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                            onfocus="showModal()"
                            autocomplete="off"
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
                    <div id="search-modal" class="livepost absolute left-0 mt-2 w-full z-50 bg-white rounded-2xl shadow-md hidden">
                        <div class="p-3 flex items-center">
                            <i class="fa-solid fa-location-arrow text-base"></i>
                            <span class="pl-3">Nearby</span>
                        </div>
                        <div id="pre-search">
                            <div class="p-3 border-t border-gray-200 text-start">
                                <h3 class="text-base font-medium text-gray-700 mb-2">Most Liked</h3>
                                <ul class="space-y-2">
                                    @foreach ($mostLikedFoods as $mostLikedFood)
                                        <a href="{{ route('food.details', $mostLikedFood->id) }}" class="block">
                                            <div class="flex items-center space-x-4 hover:bg-gray-100 p-3 cursor-pointer" onclick="event.stopPropagation();">
                                                <img src="{{ asset($mostLikedFood->image) }}" alt="profile" class="w-16 h-16 object-cover object-center rounded-md">
                                                <div class="text-start">
                                                    <p class="font-light text-sm hover:text-gray-500">{{ $mostLikedFood->name }}</p>
                                                    <p class="font-light text-sm text-gray-500">{{ $mostLikedFood->restaurant->name }}</p>
                                                </div>
                                            </div>  
                                        </a>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="p-3 text-start">
                                <h3 class="text-base font-medium text-gray-700 mb-2">Latest Uploads</h3>
                                <ul class="space-y-2">
                                    @foreach ($latestUploads as $latestUpload)
                                        <a href="{{ route('food.details', $latestUpload->id) }}" class="block">
                                            <div class="flex items-center space-x-4 hover:bg-gray-100 p-3 cursor-pointer" onclick="event.stopPropagation();">
                                                <img src="{{ asset($latestUpload->image) }}" alt="profile" class="w-16 h-16 object-cover object-center rounded-md">
                                                <div class="text-start">
                                                    <p class="font-light text-sm hover:text-gray-500">{{ $latestUpload->name }}</p>
                                                    <p class="font-light text-sm text-gray-500">{{ $latestUpload->restaurant->name }}</p>
                                                </div>
                                            </div>  
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div id="search-results" class="border-t border-gray-200">
                            {{-- this is the part where the live search will come --}}
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-2 sm:mt-5 text-base sm:text-lg md:text-xl text-darkRed font-semibold font-poppins">
                Begin Your Culinary Journey Today.
            </p>
            <a 
                href="{{ route('foodpost.create') }}" 
                class="text-sm sm:text-sm md:text-base text-darkRed font-medium underline font-poppins hover:text-lightRed hvr-icon-forward"
            >
                Post Your Food <i class="fa-solid fa-arrow-right ml-2 hvr-icon"></i>
            </a>
        </div>
    </section>

    {{----- SECOND SECTION OF LANDING PAGE CATEGORY SLIDER-----}}
    <section class="px-5 md:px-24 pb-5 sm:pb-16">
        <div class="relative main-category rounded-b-[50px] bg-bgPurple py-7 px-6 sm:rounded-b-[100px] text-center h-[30vh] sm:h-[40vh] ">
            <h2 class="text-xl sm:text-4xl font-bold text-darkPurple font-poppins pt-5">Craving something specific?</h2>
            <p class="text-sm sm:text-xl text-gray-700 mt-3 font-normal sm:font-medium">
                Search by different Categories and Start Exploring
            </p>

            <div class="absolute left-1/2 transform -translate-x-1/2 top-40 sm:top-52 w-[80%] sm:w-[85%] h-60 overflow-hidden categories">
                <div class="flex gap-8 categories-slide w-max">
                    <div class="relative w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Breakfast2.png')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Breakfast</div>
                    </div>
                    <div class="relative w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Dinner.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Dinner</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Japanese.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Japanese</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Chatpat.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Street Food</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Dessert.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Dessert</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Drink.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Drink</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Breakfast2.png')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Breakfast</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Dinner.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Dinner</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Japanese.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Japanese</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Chatpat.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Street Food</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Dessert.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Dessert</div>
                    </div>
                    <div class="w-44 h-44 sm:w-52 sm:h-52 rounded-xl overflow-hidden group1">
                        <img src="{{asset('assets/img/Drink.jpg')}}" class="w-full h-full object-cover" />
                        <div class="overlay">Drink</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{----- SECOND SECTION OF LANDING PAGE CAROUSEL -----}}
    <section>
        <div class="pb-7 pt-32">
            <!-- Title Section -->
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow text-center">
                    What Makes Foodie's Archive Special?
                </h1>
                <p class="text-xl text-darkPurple mt-2 font-bold">
                    Explore the Features
                </p>
            </div>

            <div class="lg:px-24 md:px-5">
                <div class="relative">
                    <ul id="slider">
                        <li>
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-bgPurple rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-darkPurple" data-aos="fade-down">
                                        Upload <span class="text-customYellow">Food</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 mb-4" data-aos="fade-up">
                                        Create, and step into a world <br>
                                        of Food, Friends, and Fun on <br>Foodie's Archive.
                                    </p>
                                    <a href="postFood" class="bg-darkPurple text-white py-2 px-4 md:px-6 mt-6 rounded-3xl hover:bg-lightPurple text-sm md:text-base inline-block" data-aos="fade-up">
                                        Start posting Food
                                    </a>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full pt-5 pb-8 sm:py-10 md:w-1/2 md:py-12 flex justify-center" data-aos="fade-up">
                                    <img src="{{asset('assets/img/Dinner.jpg')}}" alt="Delicious Food" class="w-80 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-bgPurple rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-darkPurple">
                                        Social <span class="text-customYellow">Interactions</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4">
                                        Write review, like, follow and share food post.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full pt-5 pb-8 sm:py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/SocialInteraction.png')}}" alt="Delicious Food" class="w-80 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-bgPurple rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-darkPurple">
                                        Ask and <span class="text-customYellow">answer</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4">
                                        Ask questions related to food, restaurants <br>
                                        and other topics.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full pt-5 pb-8 sm:py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Breakfast2.png')}}" alt="Delicious Food" class="w-80 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-bgPurple rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-darkPurple">
                                        Discover through <span class="text-customYellow">Map</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4">
                                        Discover restaurants and foods nearby. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full pt-5 pb-8 sm:py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Map_Carousel.png')}}" alt="Delicious Food" class="w-80 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-bgPurple rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-darkPurple">
                                        Build your <span class="text-customYellow">Streaks</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4">
                                        Post and review consistently to increase
                                        your streak and earn exclusive badges 
                                        that showcase your foodie skills. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full pt-5 pb-8 sm:py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/streak.png')}}" alt="Delicious Food" class="w-80 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2 py-2 sm:py-4">
                        <button onclick="goToSlide(1)" class="carousel-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="goToSlide(2)" class="carousel-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="goToSlide(3)" class="carousel-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="goToSlide(4)" class="carousel-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="goToSlide(5)" class="carousel-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{----- THIRD SECTION OF LANDING PAGE -----}}
    <section> 
        <div class="py-7">
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow" data-aos="fade-up">Getting Started is Easy</h1>
                <p class="text-xl text-darkPurple mt-2 font-bold" data-aos="fade-up">How it Works</p>
            </div>
            <div class="px-3 sm:px-6 lg:px-24 md:px-11 mt-10" data-aos="fade-up">
                <div class="bg-bgPurple py-10 px-5 rounded-lg shadow-md">
                    <ul class="mx-auto grid max-w-md grid-cols-1 gap-10 lg:max-w-5xl lg:grid-cols-4">
                        <li class="flex-start group relative flex lg:flex-col">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-customYellow transition-all duration-200 group-hover:bg-customYellow">
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Sign Up
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Create your account to explore and share delicious food experiences.</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-customYellow transition-all duration-200 group-hover:bg-customYellow">
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Explore
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Discover authentic Nepali cuisines, hidden gems, and trending food spots.</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-customYellow transition-all duration-200 group-hover:bg-customYellow">
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Discover
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Find nearby restaurants and food stalls using our interactive map feature.</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col">
                            <div
                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-customYellow transition-all duration-200 group-hover:bg-customYellow">
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Engage
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Share your experiences, post food reviews, and connect with fellow foodies.</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> 

    {{----- FOURTH SECTION OF LANDING PAGE -----}}
    <section>
        <div class="py-7">
            <!-- Title Section -->
            <div class="flex flex-col justify-center items-center px-5">
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center" data-aos="fade-up">
                    Explore the Most Popular Dishes Among Our Foodies
                </h1>
                <p class="text-xl text-darkPurple mt-2 font-bold" data-aos="fade-up">
                    Popular Foods By Users
                </p>
            </div>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-1 mt-3 px-2 sm:px-8 lg:px-20" data-aos="fade-up">
                @foreach($topFoods as $food)
                    <!-- Card 1 -->
                    <div class="bg-white overflow-hidden">
                        <div class="flex justify-between items-center p-4">
                            <div class="flex items-center">
                                <a href="">
                                    <img src="{{asset('uploads/profile-images/'. $food->user->image)}}" alt="img" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-80 transition-opacity duration-300" />
                                </a>
                                <div class="ml-4 relative group">
                                    <div>
                                        <div class="flex space-x-2 items-center">
                                            <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{$food->user->full_name}}</a>
                                            <div>
                                                @php
                                                    $authUser = auth()->user();
                                                    $isFollowing = $authUser && isset($food->user) ? $authUser->isFollowing($food->user->id) : false;
                                                @endphp

                                                @if (!$authUser)
                                                    {{-- If the user is not logged in, show the Follow button --}}
                                                    <form method="POST" action="{{route('users.follow', $food->user->id)}}" class="flex space-x-1 items-center">
                                                        @csrf
                                                        <p class="rounded-full w-1 h-1 bg-gray-600 "> </p>
                                                        <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                            Follow
                                                        </button>
                                                    </form>
                                                @else
                                                    {{-- If logged in, check if they are following --}}
                                                    @if ($isFollowing)
                                                        <form method="POST" action="{{route('users.unfollow', $food->user->id)}}" class="flex space-x-1 items-center">
                                                            @csrf
                                                            <p class="rounded-full w-1 h-1 bg-gray-600"> </p>
                                                            <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                                Unfollow
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{route('users.follow', $food->user->id)}}" class="flex space-x-1 items-center">
                                                            @csrf
                                                            <p class="rounded-full w-1 h-1 bg-gray-600"> </p>
                                                            <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                                Follow
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="absolute hidden group-hover:block w-60 p-4 bg-white shadow-lg rounded-lg z-10 border border-gray-200">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="profile" class="w-12 h-12 rounded-full object-cover">
                                            <div>
                                                <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="font-medium text-sm font-poppins">{{$food->user->full_name}}</a>
                                                <p class="text-gray-500 text-xs font-poppins">{{$food->user->username}}</p>
                                                <p class="border border-gray-300 rounded-full text-sm w-16 pl-2 mt-2"><i class="fa-solid fa-fire-flame-curved text-red-400"></i> {{$food->user->total_streak_points}}</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between text-center mt-4">
                                            <!-- Posts -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $food->user->foodposts->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Posts</p>
                                            </div>
                                            <!-- Followers -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $food->user->followers->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Followers</p>
                                            </div> 
                                            <!-- Following -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $food->user->followings->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Following</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="font-light text-sm text-gray-500">{{$food->user->username}}</p>
                                    <p class="text-gray-500 text-xs">{{ $food->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            {{-- <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button> --}}
                        </div>

                        <div class="px-4">
                            <a href="{{route('food.details', $food->id)}}"><img src="{{ asset($food->image) }}" alt="Food Img" class="w-full h-96 sm:h-72 object-cover object-center rounded-xl hover:opacity-85"/></a>
                            <div class="mt-2">
                                <div class="flex justify-between items-center mt-2 mb-2">
                                    <div class="flex items-center space-x-4">
                                        @include('components.like-button', ['food' => $food])
                                        <a href="" class="text-black text-base">
                                            <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer" title="Write Review"></i> {{$food->reviews->count()}}
                                        </a>
                                    </div>
                                    @include('components.bookmark-button', ['food' => $food])
                                </div>
                                <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$food->tag->name}}</span>
                                <div class="flex justify-between items-center mt-2">
                                    <a href="{{route('food.details', $food->id)}}" class="text-base font-semibold hover:text-gray-600">{{$food->name}}</a>
                                    <div class="flex">
                                        <img src="{{asset('assets/img/cutlery (1).png')}}" class="bg-customYellow p-1 rounded-md"
                                            style="height: 25px; width: 25px" alt="">
                                        <span class="text-customYellow font-normal pl-2">
                                            {{ number_format($food->rating, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <p class="text-black text-sm">Rs. {{$food->price}}</p>
                                <p class="text-gray-500 mt-1 text-sm">{{$food->review}}</p>
                                <a href="{{route('food.details', $food->id)}}" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{----- FIFTH SECTION OF LANDING PAGE TOP CONTRIBUTORS -----}}
    <section>
        <div class="py-7">
            <!-- Title Section -->
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center" data-aos="fade-up">
                    Meet the contributors shaping the Foodie’s Archive!
                </h1>
                <p class="text-xl text-darkPurple mt-2 font-bold" data-aos="fade-up">
                    Top Contributors
                </p>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-5 px-14 sm:px-14 lg:px-24 lg:gap-14 md:gap-3" data-aos="fade-up">
                @foreach($topContributors as $topContributor)
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg p-5 flex md:flex-col md:items-center md:text-center lg:flex-row lg:items-start lg:text-left hvr-grow" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <img src="{{asset('uploads/profile-images/'. $topContributor->image)}}" alt="profile" class="w-16 h-16 rounded-full object-cover mr-6">
                        <div>
                            <h2 class="text-lg font-semibold">{{ $topContributor->username }}</h2>
                            <p class="text-gray-600">Total streak: {{ $topContributor->streak_count }}</p>
                            <p class="text-gray-600">Total posts: {{ $topContributor->foodPosts->count() }}</p>
                            <p class="text-gray-600">Total reviews: {{ $topContributor->reviews->count() }}</p>
                            <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{----- SIXTH SECTION OF LANDING PAGE -----}}
    <section id="reviewCarousel">
        <div class="py-7">
            <div class="flex justify-center items-center">
                <p class="text-2xl text-darkPurple mt-2 font-semibold" data-aos="fade-up">
                    What others say
                </p>
            </div>
            <div class="px-5 lg:px-24 md:px-5">
                <div class="relative">
                    <ul id="reviewSlider">
                        <li>
                            <div class="flex flex-col justify-center mt-6 bg-bgPurple py-10 lg:py-20 px-10 sm:px-32 rounded-xl w-full shadow-lg text-center h-[400px] sm:h-[400px]">
                                <div class="flex justify-center mb-3">
                                    <i class="fa-solid fa-star text-customYellow text-2xl"></i>
                                    <i class="fa-solid fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-solid fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-solid fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-regular fa-star text-customYellow text-2xl pl-2"></i>
                                </div>

                                <p class="font-medium text-sm lg:text-base font-poppins flex-grow" style="color: #252525">
                                    <i class="fa-solid fa-quote-left text-darkPurple" style="padding-right: 9px; font-size: 30px"></i>
                                    This platform has transformed the way I discover and share my
                                    foods. It’s amazing to discover authentic Nepali cuisines and hidden
                                    gems from different corners of the country. The map feature is a
                                    bonus for finding nearby places.  
                                    <i class="fa-solid fa-quote-right text-darkPurple" style="padding-left: 9px; font-size: 30px;"></i>
                                </p>

                                <div class="flex items-center justify-center mt-2">
                                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" class="w-10 h-10 rounded-full object-cover" />
                                    <div class="ml-3 text-left">
                                        <a href="" class="text-gray-900 font-medium font-poppin text-sm lg:text-base">Aries Gurung</a>
                                        <p class="text-gray-500 text-sm font-poppins">Aries_g</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="hidden">
                            <div class="flex flex-col justify-center mt-6 bg-bgPurple py-10 lg:py-20 px-10 sm:px-32 rounded-xl w-full shadow-lg text-center h-[400px] sm:h-[400px]">
                                <div class="flex justify-center mb-3">
                                    <i class="fa-solid fa-star text-customYellow text-2xl"></i>
                                    <i class="fa-solid fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-solid fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-regular fa-star text-customYellow text-2xl pl-2"></i>
                                    <i class="fa-regular fa-star text-customYellow text-2xl pl-2"></i>
                                </div>

                                <p class="font-medium text-sm lg:text-base font-poppins" style="color: #252525">
                                    <i class="fa-solid fa-quote-left text-darkPurple" style="padding-right: 9px; font-size: 30px"></i>
                                    This platform has transformed the way I discover and share my
                                    foods. It’s amazing to discover authentic Nepali cuisines and hidden.
                                    <i class="fa-solid fa-quote-right text-darkPurple" style="padding-left: 9px; font-size: 30px;"></i>
                                </p>

                                <div class="flex items-center justify-center mt-2">
                                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" class="w-10 h-10 rounded-full object-cover" />
                                    <div class="ml-3 text-left">
                                        <a href="" class="text-gray-900 font-medium font-poppins text-sm lg:text-base">Smriti Gurung</a>
                                        <p class="text-gray-500 text-sm font-poppins">smrii_28</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2 py-4">
                        <button onclick="reviewGoToSlide(1)" class="review-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="reviewGoToSlide(2)" class="review-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="reviewGoToSlide(3)" class="review-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                        <button onclick="reviewGoToSlide(4)" class="review-button w-3 h-3 rounded-full bg-gray-400 hover:bg-yellow-400"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        setTimeout(() => {
            document.getElementById('badge-popup')?.remove();
        }, 6000);

        document.addEventListener("DOMContentLoaded", function () {
            if (document.getElementById("badge-popup")) {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }
        });
    </script>
    
</x-app-layout>