<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center pt-24">
        <div class="max-w-5xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header with success icon -->
            <div class="bg-green-50 p-6 flex flex-col items-center">
                <div class="rounded-full bg-green-100 p-3 mb-4">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 text-center">Payment Successful</h1>
                <p class="text-gray-600 text-center mt-2">Your payment has been processed successfully</p>
            </div>
            
            <!-- Congratulations Premium User Banner -->
            <div class="bg-gradient-to-r from-yellow-300 to-yellow-500 py-6 px-4 flex flex-col items-center">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-star w-6 h-6 text-yellow-300 mr-2"></i>
                    <h2 class="text-2xl font-bold text-white">Congratulations!</h2>
                    <i class="fa-solid fa-star w-6 h-6 text-yellow-300 ml-2"></i>
                </div>
                <p class="text-white text-xl font-medium text-center">You are now a Premium User!</p>
                <p class="text-white text-center mt-2">Enjoy exclusive features</p>
                
                <!-- Premium Badge -->
                <div class="mt-3">
                    <span class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium bg-customYellow text-yellow-900">
                        <i class="ri-bard-fill w-4 h-4 mr-1"></i>
                        PREMIUM MEMBER
                    </span>
                </div>
            </div>

            <!-- Main content -->
            <div class="p-6">
                <!-- Transaction details -->
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Transaction ID:</span>
                        <span class="text-gray-800 font-medium">{{ $transactionId }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Date:</span>
                        <span class="text-gray-800">{{ $date }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Amount:</span>
                        <span class="text-gray-800 font-medium">NPR {{ $amount }}</span>
                    </div>
                </div>

                <div class="flex justify-between">
                    <!-- Premium Benefits -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h2 class="text-gray-800 font-medium mb-3">Your Premium Benefits:</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-indigo-500 mr-1 mt-0.5 flex-shrink-0"></i>
                                <span>Daily Login Bonus: +2 Streak Points!</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-indigo-500 mr-1 mt-0.5 flex-shrink-0"></i>
                                <span>Premium Badges</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Next steps -->
                    <div class="mb-6">
                        <h2 class="text-gray-800 font-medium mb-3">What to do next:</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-green-500 mr-1 mt-0.5 flex-shrink-0"></i>
                                <span>Check your email for the receipt</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-green-500 mr-1 mt-0.5 flex-shrink-0"></i>
                                <span>Explore your new premium features</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="flex flex-col space-y-3">
                    <a href="/" class="w-full bg-customYellow hover:bg-hovercustomYellow text-white font-medium py-3 px-4 rounded-lg text-center transition duration-200">
                        Go to Home
                    </a>
                </div>
            </div>
        </div>

        <!-- Payment methods -->
        <div class="mt-4 flex items-center justify-center">
            <img src="{{asset('assets/img/esewa.png')}}" class="w-20 h-7 " alt="">
        </div>
    </div>
</x-app-layout>