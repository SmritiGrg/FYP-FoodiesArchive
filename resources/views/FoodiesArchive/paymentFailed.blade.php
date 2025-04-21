<x-app-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center pt-24">
        <div class="max-w-3xl w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header with error icon -->
            <div class="bg-red-50 p-6 flex flex-col items-center">
                <div class="rounded-full bg-red-100 p-3 mb-4">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 text-center">Payment Failed</h1>
                <p class="text-gray-600 text-center mt-2">We couldn't process your payment</p>
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
                <div class="flex space-x-6">
                    <!-- Possible reasons -->
                    <div class="mb-6">
                        <h2 class="text-gray-800 font-medium mb-3">Possible reasons:</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="ri-error-warning-line w-5 h-5 text-red-500 mr-1 flex-shrink-0"></i>
                                <span>Insufficient funds in your account</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ri-error-warning-line w-5 h-5 text-red-500 mr-1 flex-shrink-0"></i>
                                <span>Incorrect payment details entered</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ri-error-warning-line w-5 h-5 text-red-500 mr-1 flex-shrink-0"></i>
                                <span>Payment gateway timeout or error</span>
                            </li>
                        </ul>
                    </div>
                
                    <!-- What to do next -->
                    <div class="mb-6">
                        <h2 class="text-gray-800 font-medium mb-3">What to do next:</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-green-500 mr-1 mt-0.5 flex-shrink-0"></i>
                                <span>Check your payment details and try again</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-regular fa-circle-check w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Contact your bank if the issue persists</span>
                            </li>
                        </ul>
                    </div>
                </div>
            
                <!-- Action buttons -->
                <div class="flex flex-col space-y-3">
                    <a href="/premium" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 text-center">
                        Try Again
                    </a>
                </div>
            </div>
        </div>
    
        <!-- Payment methods -->
        <div class="mt-4 flex items-center justify-center">
            <div class="flex items-center justify-center"><img src="{{asset('assets/img/esewa.png')}}" class="w-20 h-7 " alt=""></div>
        </div>
    </div>
</x-app-layout>
