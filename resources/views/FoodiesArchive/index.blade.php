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
                    class="w-full max-w-2xl font-poppins bg-customYellow text-black text-base px-4 py-3 rounded-full font-medium hover:bg-hovercustomYellow transition"
                >
                    Search
                </button>
            </div>

            <p class="mt-5 text-base sm:text-lg md:text-xl text-darkRed font-semibold font-poppins">
                Begin Your Culinary Journey Today.
            </p>
            <a 
                href="#" 
                class="text-xs sm:text-sm md:text-base text-darkRed font-medium underline font-poppins hover:text-lightRed"
            >
                Post Your First Food
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

            <div class="lg:px-24">
                <div class="relative">
                    <ul id="slider">
                        <li>
                            <div class="flex flex-col lg:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="lg:w-1/2 pl-24">
                                    <h2 class="text-6xl font-bold text-darkPurple font-poppins">
                                        Upload <span class="text-customYellow">Food</span>
                                    </h2>
                                    <p class="text-gray-600 mt-4 font-poppins">
                                        Create, and step into a world <br>
                                        of Food, Friends, and Fun on 
                                        <br>Foodie's Archive.
                                    </p>
                                    <button class="bg-darkPurple text-white py-2 px-6 mt-6 rounded-3xl hover:bg-lightPurple font-poppins">
                                        Start posting Food
                                    </button>
                                </div>
                                <!-- Image Section -->
                                <div class="lg:w-1/2 lg:mt-0 py-12 flex justify-center">
                                    <img src="{{asset('assets/img/laphing.jpg')}}" alt="Delicious Food" class="w-full max-w-sm h-96 object-cover">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col lg:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="lg:w-1/2 pl-24">
                                    <h2 class="text-5xl font-bold text-darkPurple font-poppins">
                                        Social <span class="text-customYellow">Interactions</span>
                                    </h2>
                                    <p class="text-gray-600 mt-4 font-poppins">
                                        Write review, like, follow and share food post.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="lg:w-1/2 lg:mt-0 py-12 flex justify-center">
                                    <img src="{{asset('assets/img/laphing.jpg')}}" alt="Delicious Food" class="w-full max-w-sm h-96 object-cover">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col lg:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="lg:w-1/2 pl-24">
                                    <h2 class="text-5xl font-bold text-darkPurple font-poppins">
                                        Ask and <span class="text-customYellow">answer</span>
                                    </h2>
                                    <p class="text-gray-600 mt-4 font-poppins">
                                        Ask questions related to food, restaurants <br>
                                        and other topics.
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="lg:w-1/2 lg:mt-0 py-12 flex justify-center">
                                    <img src="{{asset('assets/img/sandwich.png')}}" alt="Delicious Food" class="w-full max-w-sm h-96 object-cover">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col lg:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="lg:w-1/2 pl-24">
                                    <h2 class="text-5xl font-bold text-darkPurple font-poppins">
                                        Discover through <span class="text-customYellow">Map</span>
                                    </h2>
                                    <p class="text-gray-600 mt-4 font-poppins">
                                        Discover restaurants and foods nearby. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="lg:w-1/2 lg:mt-0 py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Map_Carousel.png')}}" alt="Delicious Food" class="w-full max-w-sm h-96 object-cover">
                                </div>
                            </div>
                        </li>

                        <li class="hidden">
                            <div class="flex flex-col lg:flex-row items-center mt-10 bg-purple-50 rounded-lg shadow-md">
                                <!-- Text Section -->
                                <div class="lg:w-1/2 pl-24">
                                    <h2 class="text-5xl font-bold text-darkPurple font-poppins">
                                        Build your <span class="text-customYellow">Streaks</span>
                                    </h2>
                                    <p class="text-gray-600 mt-4 font-poppins">
                                        Post and review consistently to increase
                                        your streak and earn exclusive badges 
                                        that showcase your foodie skills. 
                                    </p>
                                </div>
                                <!-- Image Section -->
                                <div class="lg:w-1/2 lg:mt-0 py-12 flex justify-center">
                                    <img src="{{asset('assets/img/Chicken-Kimbap-1.png')}}" alt="Delicious Food" class="w-full max-w-sm h-96 object-cover">
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
                <h1 class="text-2xl font-semibold text-customYellow font-poppins">Getting Started is Easy</h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins">How it Works</p>
            </div>
            <div class="px-24" >
                <div class="step my-10 bg-bgPurple p-7 rounded-xl shadow-md">
                <ul>
                    <li>
                        <p class="w-4 h-4 rounded-full bg-black dot">-</p>
                        <p class="pt-4">Sign Up</p>
                    </li>
                    <li>
                        <p class="w-4 h-4 rounded-full bg-black dot">-</p>
                        <p class="pt-4">Explore</p>
                    </li>
                    <li>
                        <p class="w-4 h-4 rounded-full bg-black dot">-</p>
                        <p class="pt-4">Engage</p>
                    </li>
                    <li>
                        <p class="w-4 h-4 rounded-full bg-black dot">-</p>
                        <p class="pt-4">Discover</p>
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
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center">
                    Explore the Most Popular Dishes Among Our Foodies
                </h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins">
                    Popular Foods By Users
                </p>
            </div>

            <!-- Cards Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mt-3 px-4 sm:px-8 lg:px-20">
                <!-- Card 1 -->
                <div class="bg-white overflow-hidden">
                    <div class="flex justify-between items-center p-4">
                        <div class="flex items-center">
                            <a href="">
                                <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smriti Gurung" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-75 transition-opacity duration-300" />
                            </a>
                            <div class="ml-3">
                                <p class="font-semibold text-base">Smriti Gurung</p>
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

    {{----- FIFTH SECTION OF LANDING PAGE -----}}
    <section>
        <div class="py-7">
            <!-- Title Section -->
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-2xl font-semibold text-customYellow font-poppins text-center">
                    Meet the contributors shaping the Foodie’s Archive!
                </h1>
                <p class="bg-black text-white py-2 px-4 mt-4 font-semibold font-poppins">
                    Top Contributors
                </p>
            </div>
            
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-18 px-14 sm:px-14 lg:px-24 lg:gap-14">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg p-5 flex" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Foodie_King" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h2 class="text-lg font-semibold">Foodie_King</h2>
                        <p class="text-gray-600">Total streak: 500</p>
                        <p class="text-gray-600">Total posts: 200</p>
                        <p class="text-gray-600">Total reviews: 300</p>
                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg p-5 flex" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smrii_g" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h2 class="text-lg font-semibold">Smrii_g</h2>
                        <p class="text-gray-600">Total streak: 470</p>
                        <p class="text-gray-600">Total posts: 200</p>
                        <p class="text-gray-600">Total reviews: 200</p>
                        <a href="" class="font-medium text-sm underline hover:text-gray-600">See Badges</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg p-5 flex" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Ramm_44" class="w-16 h-16 rounded-full object-cover mr-4">
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

    
</x-app-layout>