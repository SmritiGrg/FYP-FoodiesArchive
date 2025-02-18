<header>
    <nav class="bg-white fixed">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between p-4">
            <!-- Hamburger Menu (Visible only on md and smaller screens) -->
            <button id="menu-toggle" class="md:hidden text-2xl text-gray-900">
                &#9776;
            </button>

            <a href="#" class="flex items-center ">
                <!-- Logo for larger screens -->
                <img
                    src="{{ asset('assets/img/FoodiesArchive_Logo-removebg-preview.png') }}"
                    class="h-10 hidden sm:block"
                    alt="Foodie's Archive Logo"
                />
                <!-- Logo for small screens -->
                <img
                    src="{{ asset('assets/img/secondary_FA-Logo-removebg-preview.png') }}"
                    class="block sm:hidden ml-9"
                    alt="Foodie's Archive Small Logo" style="width: 55px; height: 35px;"
                />
            </a>

            <!-- Navigation Links (Hidden on md and smaller screens) -->
            <div id="nav-links" class="hidden md:flex space-x-12">
                <a
                href="#"
                class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins"
                >Discover</a
                >
                <a
                href="#"
                class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins"
                >Post a Food</a
                >
                <a
                href="#"
                class="text-gray-900 hover:text-customYellow text-base font-semibold font-poppins"
                >About us</a
                >
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-4">
                <!-- Bookmark Icon (Hidden on md screens and below) -->
                <a href="#" class="hidden md:block">
                <i class="fa-regular fa-bookmark text-xl"></i>
                </a>
                @guest
                    <!-- Log In & Sign Up -->
                    <a
                    href="login"
                    class="hidden md:block text-gray-900 font-semibold hover:text-gray-600 border-l-2 border-gray-300 pl-4"
                    >Log In</a
                    >

                    <a href="register" class="bg-customYellow text-black text-sm px-3 py-1 sm:text-base sm:px-4 sm:py-2 rounded-full hover:bg-hovercustomYellow transition font-semibold">
                        Sign Up
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

                        <div
                        class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden hidden"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="menu-button"
                        tabindex="-1"
                        >
                            <div>
                                <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900">{{ Auth::user()->full_name }}</span>
                                <span class="block text-sm text-gray-500 truncate"
                                    >{{ Auth::user()->username }}</span
                                >
                                </div>
                                <ul class="py-2" aria-labelledby="user-menu-button">
                                    <li>
                                        <a
                                        href="profile"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Edit Profile</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                        href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Settings</a
                                        >
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
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
        <div id="mobile-menu" class="hidden md:hidden bg-lightgray p-4">
            <a href="#" class="block py-2 text-gray-900 hover:text-customYellow"
                >Discover</a
            >
            <a href="#" class="block py-2 text-gray-900 hover:text-customYellow"
                >Post a Food</a
            >
            <a href="#" class="block py-2 text-gray-900 hover:text-customYellow"
                >About us</a
            >
        </div>
    </nav>
</header>