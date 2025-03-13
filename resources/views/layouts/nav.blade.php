<header>
    <nav class="bg-white fixed">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
            <!-- Hamburger Menu (Visible only on md and smaller screens) -->
            <button id="menu-toggle" class="lg:hidden text-lg sm:text-2xl text-gray-900">
                &#9776;
            </button>

            <a href="/" class="flex items-center ">
                <!-- Logo for larger screens -->
                <img
                    src="{{ asset('assets/img/FoodiesArchive_Logo-removebg-preview.png') }}"
                    class="h-10 hidden sm:block"
                    alt="Foodie's Archive Logo"
                />
                <!-- Logo for small screens -->
                <img
                    src="{{ asset('assets/img/secondary_FA-Logo-removebg-preview.png') }}"
                    class="block sm:hidden"
                    alt="Foodie's Archive Small Logo" style="width: 55px; height: 35px;"
                />
            </a>

            <div id="search-bar2" class="hidden transition-all duration-300">
                <div class="relative w-full max-w-2xl">
                    <form action="{{ route('search.food') }}" method="GET">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-black cursor-pointer">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input 
                            id="search-bar"
                            type="text" 
                            name="query"
                            placeholder="Discover foods..." 
                            class="w-52 md:w-80 pl-9 text-gray-800 font-poppins rounded-full border border-gray-300 text-sm"
                        />
                    </form>
                </div>
            </div>

            <!-- Navigation Links (Hidden on md and smaller screens) -->
            <div id="nav-links" class="hidden lg:flex space-x-4 lg:space-x-6 xl:space-x-12">
                <a href="discover" class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins lg:text-sm xl:text-base">Discover</a>
                <div class="relative group">
                    <button
                        class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins"
                    >
                        Review
                    </button>
                    <div class="absolute w-40 top-full left-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 group-hover:scale-y-100 origin-top duration-200 bg-white">
                        <div class="hover:bg-gray-100">
                            <a href="writeReview" class="block text-base font-medium hover:text-customYellow px-2 py-2">Write a Review</a>
                        </div>
                        <div class="hover:bg-gray-100">
                            <a href="{{ route('foodpost.create') }}" class="block text-base font-medium hover:text-customYellow px-2 py-2">Upload Post</a>
                        </div>
                    </div>
                </div>
                <a href="#" class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins lg:text-sm xl:text-base">About us</a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-4">
                <!-- Bookmark Icon (Hidden on md screens and below) -->
                <a href="bookmark" class="hidden lg:block">
                    <i class="fa-regular fa-bookmark text-xl hover:text-gray-500"></i>
                </a>
                @guest
                    <!-- Log In & Sign Up -->
                    <a
                    href="login"
                    class="hidden lg:block text-gray-900 font-semibold hover:text-gray-600 border-l-2 border-gray-300 pl-4"
                    >Log In</a
                    >

                    <a href="register" class="hidden sm:block bg-customYellow text-black text-sm px-3 py-1 sm:text-base sm:px-4 sm:py-2 rounded-full hover:bg-hovercustomYellow transition font-semibold">
                        Sign Up
                    </a>

                    <a href="register" class="sm:hidden border-l-2 border-gray-300 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    </a>
                @endguest
                @auth
                    <div class="relative inline-block text-left border-l-2 border-gray-300 pl-4">
                        <div>
                            <button
                                type="button"
                                class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                                id="user-menu-button"
                            >
                                <img
                                class="w-10 h-10 rounded-full object-cover"
                                src="{{ asset('uploads/profile-images/' . auth()->user()->image) }}"
                                alt="user photo"
                                />
                            </button>
                        </div>

                        <div class="absolute right-0 z-10 mt-2 w-60 origin-top-right rounded-md bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden hidden" role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="menu-button"
                        tabindex="-1"
                        >
                            <div>
                                <div class="px-4 py-3 hover:bg-gray-100">
                                    <a href="" class="flex items-center">
                                        <img src="{{asset('uploads/profile-images/' . Auth::user()->image) }}" alt="" class="w-16 h-16 rounded-full object-cover mr-3">
                                        <div>
                                            <span class="block text-sm text-gray-900">{{ Auth::user()->full_name }}</span>
                                            <span class="block text-sm text-gray-500"
                                                >{{ Auth::user()->username }}</span
                                            >
                                        </div>
                                    </a>
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a
                                        href="profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >My Profile</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Settings</a
                                        >
                                    </li>
                                    <li class="border-t-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100"
                                            >
                                                Log out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white p-4 shadow-lg text-center">
            <a href="discover" class="block py-2 text-gray-900 hover:text-customYellow text-base font-poppins font-medium"
                >Discover</a
            >
            <a href="#" class="block py-2 text-gray-900 hover:text-customYellow text-base font-poppins font-medium"
                >Post a Food</a
            >
            <a href="#" class="block py-2 text-gray-900 hover:text-customYellow text-base font-poppins font-medium"
                >About us</a
            >
            <a href="bookmark" class="block py-2 text-gray-900 hover:text-customYellow text-base font-poppins font-medium"
                >Bookmark</a
            >
        </div>
    </nav>
</header>