<x-app-layout>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
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
                        <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-black py-2 px-4 rounded-lg">
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
            <p class="mt-3 text-xs sm:text-sm md:text-base text-gray-600 font-poppins">
                Discover Authentic Tastes, Share Your Foodie Adventures.
            </p>
            
            <div class="mt-10 flex justify-center px-4 sm:px-0">
                <div class="relative w-full max-w-2xl">

                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-black cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <input 
                        id="search-bar"
                        type="text" 
                        placeholder="Discover foods..." 
                        class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 font-poppins rounded-full border border-gray-300 "
                        style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                    />

                    <button 
                        class="hidden sm:block absolute right-2 top-2 bottom-2 font-poppins bg-customYellow text-black text-base px-4 py-2 rounded-full font-medium hover:bg-hovercustomYellow transition"
                    >
                        Search
                    </button>
                </div>
            </div>
            
            <div class="mt-4 sm:hidden px-4">
                <button 
                    class="w-full max-w-2xl font-poppins bg-customYellow text-black text-base px-2 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition"
                >
                    Search
                </button>
            </div>

            <p class="mt-5 text-base sm:text-lg md:text-xl text-darkRed font-semibold font-poppins">
                Begin Your Culinary Journey Today.
            </p>
            <a 
                href="#" 
                class="text-xs sm:text-sm md:text-base text-darkRed font-medium underline font-poppins hover:text-lightRed hvr-icon-forward"
            >
                Post Your First Food <i class="fa-solid fa-arrow-right ml-2 hvr-icon"></i>
            </a>
        </div>
    </section>

    {{----- SECOND SECTION OF LANDING PAGE CAROUSEL -----}}
    <section>
        <div class="py-7">
            <!-- Title Section -->
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center">
                    What Makes Foodie's Archive Special?
                </h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins">
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
                                    <h2 class="text-5xl md:text-4xl lg:text-5xl font-bold text-darkPurple font-poppins" data-aos="fade-down">
                                        Upload <span class="text-customYellow">Food</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 font-poppins" data-aos="fade-up">
                                        Create, and step into a world <br>
                                        of Food, Friends, and Fun on <br>Foodie's Archive.
                                    </p>
                                    <button class="bg-darkPurple text-white py-2 px-4 md:px-6 mt-6 rounded-3xl hover:bg-lightPurple font-poppins text-sm md:text-base" data-aos="zoom-in">
                                        Start posting Food
                                    </button>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full py-10 md:w-1/2 md:py-12 flex justify-center" data-aos="fade-up">
                                    <img src="{{asset('assets/img/laphing.jpg')}}" alt="Delicious Food" class="w-64 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-5xl md:text-4xl lg:text-5xl font-bold text-darkPurple font-poppins">
                                        Social <span class="text-customYellow">Interactions</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 font-poppins">
                                        Write review, like, follow and share food post.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/laphing.jpg')}}" alt="Delicious Food" class="w-64 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-5xl md:text-4xl lg:text-5xl font-bold text-darkPurple font-poppins">
                                        Ask and <span class="text-customYellow">answer</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 font-poppins">
                                        Ask questions related to food, restaurants <br>
                                        and other topics.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/sandwich.png')}}" alt="Delicious Food" class="w-64 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-5xl md:text-4xl lg:text-5xl font-bold text-darkPurple font-poppins">
                                        Discover through <span class="text-customYellow">Map</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 font-poppins">
                                        Discover restaurants and foods nearby. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Map_Carousel.png')}}" alt="Delicious Food" class="w-64 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col md:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="w-full md:w-1/2 p-6 md:pl-24">
                                    <h2 class="text-5xl md:text-4xl lg:text-5xl font-bold text-darkPurple font-poppins">
                                        Build your <span class="text-customYellow">Streaks</span>
                                    </h2>
                                    <p class="text-lg md:text-base lg:text-lg text-gray-600 mt-4 font-poppins">
                                        Post and review consistently to increase
                                        your streak and earn exclusive badges 
                                        that showcase your foodie skills. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="w-full py-10 md:w-1/2 md:py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Chicken-Kimbap-1.png')}}" alt="Delicious Food" class="w-64 md:w-80 lg:w-full max-w-sm h-72 md:h-80 lg:h-96 object-cover rounded-lg">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2 py-4">
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
                <h1 class="text-2xl font-semibold text-customYellow font-poppins" data-aos="fade-up">Getting Started is Easy</h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins" data-aos="fade-up">How it Works</p>
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
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center" data-aos="fade-up">
                    Explore the Most Popular Dishes Among Our Foodies
                </h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins" data-aos="fade-up">
                    Popular Foods By Users
                </p>
            </div>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mt-3 px-4 sm:px-8 lg:px-20" data-aos="fade-up">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden">
                    <div class="flex justify-between items-center p-4">
                        <div class="flex items-center">
                            <a href="">
                                <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smriti Gurung" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-80 transition-opacity duration-300" />
                            </a>
                            <div class="ml-3 relative group">
                                <a href="" class="font-semibold text-base hover:text-gray-500">Smriti Gurung</a>
                                <!-- Modal -->
                                <div class="absolute hidden group-hover:block w-60 p-4 bg-white shadow-lg rounded-lg z-10 border border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{asset('uploads/profile-images/aries28-profile-1739687782.png')}}" alt="User Avatar" class="w-12 h-12 rounded-full object-cover">
                                        <div>
                                            <a href="" class="font-semibold text-sm font-poppins">Smriti Gurung</a>
                                            <p class="text-gray-500 text-xs font-poppins">Smrii</p>
                                            <p class="border border-gray-300 rounded-full text-sm w-16 pl-2 mt-2"><i class="fa-solid fa-fire-flame-curved text-red-400"></i> 50</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-center mt-4">
                                        <!-- Posts -->
                                        <div>
                                            <p class="font-bold text-sm font-poppins">14</p>
                                            <p class="text-gray-500 text-xs font-poppins">Posts</p>
                                        </div>
                                        <!-- Followers -->
                                        <div>
                                            <p class="font-bold text-sm font-poppins">30</p>
                                            <p class="text-gray-500 text-xs font-poppins">Followers</p>
                                        </div>
                                        <!-- Following -->
                                        <div>
                                            <p class="font-bold text-sm font-poppins">15</p>
                                            <p class="text-gray-500 text-xs font-poppins">Following</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="font-medium text-sm">Smrii</p>
                                <p class="text-gray-500 text-xs">1 month ago</p>
                            </div>
                        </div>
                        <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                    </div>

                    <div class="px-4">
                        <img src="{{asset('assets/img/laphing.jpg')}}" alt="Chicken Thakali Set" class="w-full h-72 object-cover object-center rounded-xl"/>
                        <div class="mt-2">
                            <div class="flex justify-between items-center mt-2 mb-2">
                                <div class="flex items-center space-x-4">
                                    <span class="text-black text-base">
                                        <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                        <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> 5.5K
                                    </span>

                                    <span class="text-black text-base">
                                        <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> 500
                                    </span>
                                </div>
                                <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-2 rounded"> Highly Recommended</span>
                            <div class="flex justify-between items-center mt-2">
                                <a href="" class="text-lg font-bold hover:text-gray-600">Chicken Thakali Set</a>
                                <span class="text-customYellow font-normal"><i class="fa-solid fa-star pr-1" id="star"></i>5.0</span>
                            </div>
                            <p class="text-black text-sm">Rs. 700</p>
                            <p class="text-gray-500 mt-1 text-sm">Best Thakali restaurant for me. Enjoyed good food with family.</p>
                            <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white overflow-hidden">
                    <div class="flex justify-between items-center p-4">
                        <div class="flex items-center">
                            <img
                                src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}"
                                alt="Smriti Gurung"
                                class="w-10 h-10 rounded-full"
                            />
                            <div class="ml-3">
                                <p class="font-semibold text-base">Smriti Gurung</p>
                                <p class="font-medium text-sm">Smrii</p>
                                <p class="text-gray-500 text-xs">1 month ago</p>
                            </div>
                        </div>
                        <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                    </div>

                    <div class="px-4">
                        <img src="{{asset('assets/img/laphing.jpg')}}" alt="Chicken Thakali Set" class="w-full h-72 object-cover rounded-xl"/>
                        <div class="mt-2">
                            <div class="flex justify-between items-center mt-2 mb-2">
                                <div class="flex items-center space-x-4">
                                    <span class="text-black text-base">
                                        <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                        <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> 5.5K
                                    </span>

                                    <span class="text-black text-base">
                                        <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> 500
                                    </span>
                                </div>
                                <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-2 rounded"> Highly Recommended</span>
                            <div class="flex justify-between items-center mt-2">
                                <a href="" class="text-lg font-bold hover:text-gray-600">Mixed Laphing</a>
                                <span class="text-customYellow font-normal"><i class="fa-solid fa-star pr-1" id="star"></i>5.0</span>
                            </div>
                            <p class="text-black text-sm">Rs. 700</p>
                            <p class="text-gray-500 mt-1 text-sm">Best Thakali restaurant for me. Enjoyed good food with family.</p>
                            <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white overflow-hidden">
                    <div class="flex justify-between items-center p-4">
                        <div class="flex items-center">
                            <img
                                src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}"
                                alt="Smriti Gurung"
                                class="w-10 h-10 rounded-full"
                            />
                            <div class="ml-3">
                                <p class="font-semibold text-base">Smriti Gurung</p>
                                <p class="font-medium text-sm">Smrii</p>
                                <p class="text-gray-500 text-xs">1 month ago</p>
                            </div>
                        </div>
                        <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition">Follow</button>
                    </div>

                    <div class="px-4">
                        <img src="{{asset('assets/img/Chicken-Kimbap-1.png')}}" alt="Chicken Thakali Set" class="w-full h-72 object-cover rounded-xl"/>
                        <div class="mt-2">
                            <div class="flex justify-between items-center mt-2 mb-2">
                                <div class="flex items-center space-x-4">
                                    <span class="text-black text-base">
                                        <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                        <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> 5.5K
                                    </span>

                                    <span class="text-black text-base">
                                        <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> 500
                                    </span>
                                </div>
                                <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-2 rounded">Must Try</span>
                            <div class="flex justify-between items-center mt-2">
                                <a href="" class="text-lg font-bold hover:text-gray-600">Chicken Thakali Set</a>
                                <span class="text-customYellow font-normal"><i class="fa-solid fa-star pr-1" id="star"></i>5.0</span>
                            </div>
                            <p class="text-black text-sm">Rs. 700</p>
                            <p class="text-gray-500 mt-1 text-sm">Best Thakali restaurant for me. Enjoyed good food with family.</p>
                            <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white overflow-hidden">
                    <div class="flex justify-between items-center p-4">
                        <div class="flex items-center">
                            <img
                                src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}"
                                alt="Smriti Gurung"
                                class="w-10 h-10 rounded-full"
                            />
                            <div class="ml-3">
                                <p class="font-semibold text-base">Smriti Gurung</p>
                                <p class="font-medium text-sm">Smrii</p>
                                <p class="text-gray-500 text-xs">1 month ago</p>
                            </div>
                        </div>
                        <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow transition">Follow</button>
                    </div>

                    <div class="px-4">
                        <img src="{{asset('assets/img/sandwich.png')}}" alt="Chicken Thakali Set" class="w-full h-72 object-cover rounded-xl"/>
                        <div class="mt-2">
                            <div class="flex justify-between items-center mt-2 mb-2">
                                <div class="flex items-center space-x-4">
                                    <span class="text-black text-base">
                                        <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                        <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> 5.5K
                                    </span>

                                    <span class="text-black text-base">
                                        <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> 500
                                    </span>
                                </div>
                                <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                            </div>
                            <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-2 rounded"> Highly Recommended</span>
                            <div class="flex justify-between items-center mt-2">
                                <a href="" class="text-lg font-bold hover:text-gray-600">Chicken Thakali Set</a>
                                <span class="text-customYellow font-normal"><i class="fa-solid fa-star pr-1" id="star"></i>5.0</span>
                            </div>
                            <p class="text-black text-sm">Rs. 700</p>
                            <p class="text-gray-500 mt-1 text-sm">Had Tornado Chicken Sandwich and Cheesy Chicken 
                                Sandwich. Both were too good to be true. The brown bread was perfectly crunchy and the taste of 
                                mayonnaise was yummy.
                            </p>
                            <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                        </div>
                    </div>
                </div>
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
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins" data-aos="fade-up">
                    Top Contributors
                </p>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-5 px-14 sm:px-14 lg:px-24 lg:gap-14 md:gap-3" data-aos="fade-up">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-5 flex md:flex-col md:items-center md:text-center lg:flex-row lg:items-start lg:text-left hvr-grow" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Foodie_King" class="w-16 h-16 rounded-full object-cover mr-6">
                    <div>
                        <h2 class="text-lg font-semibold">Foodie_King</h2>
                        <p class="text-gray-600">Total streak: 500</p>
                        <p class="text-gray-600">Total posts: 200</p>
                        <p class="text-gray-600">Total reviews: 300</p>
                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-5 flex md:flex-col md:items-center md:text-center lg:flex-row lg:items-start lg:text-left hvr-grow" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smrii_g" class="w-16 h-16 rounded-full object-cover mr-6">
                    <div>
                        <h2 class="text-lg font-semibold">Smrii_g</h2>
                        <p class="text-gray-600">Total streak: 470</p>
                        <p class="text-gray-600">Total posts: 200</p>
                        <p class="text-gray-600">Total reviews: 200</p>
                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-5 flex md:flex-col md:items-center md:text-center lg:flex-row lg:items-start lg:text-left hvr-grow" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Ramm_44" class="w-16 h-16 rounded-full object-cover mr-6">
                    <div>
                        <h2 class="text-lg font-semibold">Ramm_44</h2>
                        <p class="text-gray-600">Total streak: 500</p>
                        <p class="text-gray-600">Total posts: 200</p>
                        <p class="text-gray-600">Total reviews: 300</p>
                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{----- SIXTH SECTION OF LANDING PAGE -----}}
    <section id="reviewCarousel">
        <div class="py-7">
            <div class="flex justify-center items-center">
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins" data-aos="fade-up">
                    What others say
                </p>
            </div>
            <div class="px-5 lg:px-24 md:px-5">
                <div class="relative">
                    <ul id="reviewSlider">
                        <li>
                            <div class="flex flex-col justify-center mt-6 bg-purple-100 py-10 lg:py-20 px-10 sm:px-32 rounded-xl w-full shadow-lg text-center h-[400px] sm:h-[400px]">
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
                            <div class="flex flex-col justify-center mt-6 bg-purple-100 py-10 lg:py-20 px-10 sm:px-32 rounded-xl w-full shadow-lg text-center h-[400px] sm:h-[400px]">
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
</x-app-layout>