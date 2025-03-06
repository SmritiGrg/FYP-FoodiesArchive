<x-app-layout>
    <section>
        <div class="text-center pb-12 pt-28 bg-white">
            <p class="text-darkPurple font-poppins text-2xl sm:text-4xl md:text-4xl font-extrabold">
                A few words from you,
            </p>
            <p class="text-customYellow font-poppins text-2xl sm:text-4xl md:text-4xl font-extrabold pt-3">
                a delicious journey for someone else!
            </p>
            <p class="mt-3 text-xs sm:text-sm md:text-base text-gray-600 font-poppins">
                Tried something unforgettable? From local eateries to fancy restaurants—review it here!
            </p>

            <div class="mt-10 flex justify-center px-4 sm:px-0" id="search-container">
                <div class="relative w-full max-w-2xl">
                    <form action="" method="GET">
                        <input 
                            id="search-bar"
                            type="text" 
                            placeholder="Type the name of a place or dish to review..." 
                            class="w-full p-4 pr-4 sm:pr-20 pl-9 text-gray-800 font-poppins rounded-full border border-gray-300 focus:outline-none"
                            style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;"
                            onfocus="showModal()"
                            onblur="hideModal()"
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
                    <div id="search-modal" class="absolute left-0 mt-2 w-full z-50 bg-white rounded-xl shadow-md hidden">
                        <div class="p-4 flex items-center">
                            <i class="fa-solid fa-location-arrow text-base"></i>
                            <span class="pl-3">Nearby</span>
                        </div>
                        <!-- Add more content to your modal as needed -->
                    </div>
                </div>
            </div>
            <a href="postFood" class="bg-darkPurple text-white py-2 px-4 md:px-6 mt-6 rounded-3xl hover:bg-lightPurple font-poppins text-sm md:text-base hvr-icon-forward">
                Upload Post<i class="fa-solid fa-arrow-right ml-2 hvr-icon"></i>
            </a>
        </div>
    </section>
</x-app-layout>