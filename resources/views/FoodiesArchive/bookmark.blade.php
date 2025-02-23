<x-app-layout>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-7">
        <h1 class="text-2xl font-semibold text-darkPurple mb-6">Bookmarked</h1>
        <div class="grid grid-cols-3 gap-2">
            <!-- Food Card -->
            <div class="relative shadow-md overflow-hidden border group cursor-pointer" onclick="openModal()">
                    <img src="{{asset('assets/img/Chicken-Kimbap-1.png')}}" alt="Food 1" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">
                        <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>50</p>
                    </div>
            </div>
            <div class="relative shadow-md overflow-hidden border group cursor-pointer" onclick="openModal()">
                    <img src="{{asset('assets/img/momo.jpg')}}" alt="Food 1" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">
                        <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>50</p>
                    </div>
            </div>
            <div class="relative shadow-md overflow-hidden border group">
                    <img src="{{asset('assets/img/sandwich.png')}}" alt="Food 3" class="w-full h-48 sm:h-72 md:h-96 object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out">
                        <p class="text-white text-lg font-semibold"><i class="fa-solid fa-heart text-white pr-2"></i>50</p>
                    </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="foodModal" class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50">
        <div class="w-full flex items-center justify-center relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-3xl">
                    <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="bg-white w-full max-w-5xl rounded-r-md h-[90vh] flex flex-col">
                <div class="flex flex-col md:flex-row flex-grow overflow-auto">
                    <!-- Food Image -->
                    <div class="w-full md:w-1/2 h-[90vh]">
                        <img src="{{asset('assets/img/keemaNoodle.jpg')}}" alt="Food 1" class="w-full h-full object-cover">
                    </div>
                    <!-- Food Details -->
                    <div class="w-full md:w-1/2 p-6 flex flex-col">
                        <div class="flex justify-between items-center mb-3 pb-4 border-b-2">
                            <div class="flex items-center">
                                <a href="">
                                    <img src="{{asset('uploads/profile-images/aries28-profile-1739687395.png')}}" alt="Smriti Gurung" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-80 transition-opacity duration-300" />
                                </a>
                                <div class="ml-3 relative group">
                                    <a href="" class="font-semibold text-base hover:text-gray-500">Smriti Gurung</a>
                                    <p class="text-gray-500 text-xs">20 days ago</p>
                                </div>
                            </div>
                            <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                        </div>

                        <h2 class="text-2xl font-bold mb-1">Buff Keema Noodles</h2>
                        <p class="text-gray-700 mb-2">Restaurant: Kafe Joy</p>
                        <span class="text-gray-700 mb-3">Traditional, Lunch</span>
                        <span class="bg-green-100 text-green-700 text-xs font-semibold py-1 px-3 mb-4 rounded w-fit">Must Try</span>
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400 mr-2">
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="fas fa-star mr-1 text-lg"></i>
                                <i class="far fa-star mr-1 text-lg"></i>
                            </div>
                            <span class="text-gray-700">4.00</span>
                        </div>
                        <p class="font-bold text-lg mb-4">Rs. 300</p>
                        <p class="text-gray-700 mb-6">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                        </p>

                        <!-- Bottom Section (Fixed at the Bottom) -->
                        <div class="mt-auto border-t pt-4 flex items-center justify-between">
                            <button class="text-gray-700 hover:text-black">
                                <i class="far fa-heart text-2xl"></i>
                            </button>
                            <button class="text-gray-700 hover:text-black">
                                <i class="far fa-bookmark text-2xl"></i>
                            </button>
                            <button class="flex items-center space-x-2 border px-4 py-2 rounded-md">
                                <i class="far fa-comment-dots"></i>
                                <span>Write a Review</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>