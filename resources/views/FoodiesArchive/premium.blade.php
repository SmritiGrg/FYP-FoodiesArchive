<x-app-layout>
<div class="max-w-5xl mx-auto pt-20 mb-10 bg-white rounded-lg shadow-sm border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column - Order Summary -->
        <div>
            <h1 class="text-3xl font-medium text-gray-800 mb-6">Order Summary</h1>
            
            <div class="mb-8">
                <p class="text-gray-700 mb-3">Upgrading Website:</p>
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white font-medium mr-3">
                        
                    </div>
                    <span class="text-gray-800 font-medium">{{ Auth::user()->full_name }}</span>
                </div>
            </div>
        
            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-xl font-medium text-gray-800 mb-4">Billing Plan</h2>
                <select name="billing" class="mt-1 w-full border rounded p-2">
                    <option value="monthly">NPR 199 / month</option>
                    <option value="yearly">NPR 2299 / year</option>
                </select>
            </div>
        </div>
        
        <!-- Right Column - Features -->
        <div>
            <h2 class="text-2xl font-medium text-textBlack mb-6">Premium</h2>
        
            <ul class="space-y-3">
                <li class="flex items-start">
                    <i class="fa-solid fa-check w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                    <div>
                        <span class="text-gray-700">Exclusive food guides</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
</x-app-layout>