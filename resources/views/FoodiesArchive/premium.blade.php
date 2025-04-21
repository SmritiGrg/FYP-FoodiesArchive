<x-app-layout>
    <section class="pt-24">
        <div class="max-w-5xl mx-auto mb-10 bg-white rounded-lg shadow-lg border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <!-- Left Column - Order Summary -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">Order Summary</h1>

                    <div class="mb-8">
                        <p class="text-gray-700 mb-3">Upgrading Account:</p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full mr-3">
                                <img src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" alt="">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-gray-800 font-medium text-lg">{{ Auth::user()->full_name }}</span>
                                <span class="text-gray-500 font-normal text-sm">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('esewa.pay') }}" method="post" class="mt-3">
                        @csrf

                        <div class="border-t border-gray-300 pt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Billing Plan</h2>
                            <select name="billing_time" required class="mt-1 w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:ring-2 focus:ring-emerald-500">
                                <option value="monthly">NPR 199 / month</option>
                                <option value="yearly">NPR 2299 / year</option>
                            </select>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Payment Method</h2>
                            <div class="flex items-center">
                                <img src="{{ asset('assets/img/esewa.png') }}" alt="Esewa" class="w-20 h-7">
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                                Confirm Upgrade
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Right Column - Features -->
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Premium Features</h2>

                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fa-solid fa-check w-5 h-5 text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Daily Login Bonus: +2 Streak Points!</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check w-5 h-5 text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Exclusive food guides</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-solid fa-check w-5 h-5 text-green-500 mr-3 mt-1"></i>
                            <span class="text-gray-700">Premium badges</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>