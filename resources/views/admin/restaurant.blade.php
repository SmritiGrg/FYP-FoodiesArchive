@extends('admin.inc.main')
@section('container')
<main class="w-[calc(100%-260px)] ml-64 bg-gray-50 min-h-screen pt-16">
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-white bg-green-500 border border-green-600 px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif
    <div class="flex-1 px-8 py-2 bg-gray-100">
        <div class="flex items-center justify-between mb-2 border-b border-gray-200 pb-2 pt-5">
            <p class="text-customYellow font-semibold text-2xl">Restaurants</p>
            <button type="button" onclick="openRestaurantModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                + Add Restaurant
            </button>
        </div>

        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4 md:items-center">
                    <div class="relative">
                        <input type="search" name="search" id="searchRestaurant" placeholder="Search restaurants..." class="pl-9 w-full md:w-[300px] border border-gray-300 rounded-md py-2 px-3" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                    </div>
                    <div class="flex items-center gap-2">
                        <form method="GET" action="{{ route('restautant.index') }}">
                            <select name="status" class="border border-gray-300 rounded-md h-9 px-6 text-sm" onchange="this.form.submit()">
                                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                        <form method="GET" action="{{ route('restautant.index') }}">
                            <select name="location" class="border border-gray-300 rounded-md h-9 px-7 text-sm" onchange="this.form.submit()">
                                <option value="all" {{ request('location') == 'all' ? 'selected' : '' }}>All Locations</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <form method="GET" action="{{ route('restautant.index') }}">
                            <select name="rating_sort" class="border border-gray-300 rounded-md h-9 px-6 text-sm" onchange="this.form.submit()">
                                <option value="">Sort by Rating</option>
                                <option value="high" {{ request('rating_sort') == 'high' ? 'selected' : '' }}>High Rated</option>
                                <option value="low" {{ request('rating_sort') == 'low' ? 'selected' : '' }}>Low Rated</option>
                            </select>
                        </form>

                        <form method="GET" action="{{ route('restautant.index') }}">
                            <select name="review_sort" class="border border-gray-300 rounded-md h-9 px-6 text-sm" onchange="this.form.submit()">
                                <option value="">Sort by Reviews</option>
                                <option value="high" {{ request('review_sort') == 'high' ? 'selected' : '' }}>Most Reviewed</option>
                                <option value="low" {{ request('review_sort') == 'low' ? 'selected' : '' }}>Least Reviewed</option>
                            </select>
                        </form>
                    </div>
                </div> 
            </div>
        </div>

        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-12 p-4 bg-gray-100">
                <div class="col-span-3 text-xs font-medium text-gray-500 uppercase">Restaurant Name</div>
                <div class="col-span-2 text-xs font-medium text-gray-500 uppercase">Location</div>
                <div class="col-span-2 text-xs font-medium text-gray-500 uppercase">Submitted By</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 uppercase">Food Posts</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 uppercase">Average Rating</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 uppercase">Total Review</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 uppercase">Status</div>
                <div class="col-span-1 text-xs font-medium text-gray-500 uppercase">Actions</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm allrestaurantdata">
                @foreach($restaurants as $restaurant)
                    <x-restaurant-row :restaurant="$restaurant" />
                @endforeach
            </div>
        </div>
        <div class="mt-4 allrestaurantdata">
            {{ $restaurants->appends(request()->query())->links() }}
        </div>

        <div class="divide-y text-sm searchrestaurantdata" id="restaurant-content">
            
        </div>

        {{-- RESTAURANT ANALYSIS --}}
        <div class="mb-2 border-b border-gray-200">
            <p class="text-customYellow font-semibold text-2xl py-2">Restaurant Analytics</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Displaying - Top Restaurants -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Top 10 Restaurants</h3>
                <canvas id="topRestaurantsChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Average Rating By Restaurant -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Average Rating By Restaurant</h3>
                <canvas id="avgRatingChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Restaurant Distribution by Location -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Restaurant Distribution by Location</h3>
                <canvas id="locationChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Most Reviewed Restaurants -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Most Reviewed Restaurants</h3>
                <canvas id="mostReviewedChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Monthly New Restaurants Added -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Monthly New Restaurants Added</h3>
                <canvas id="monthlyAddedChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Restaurant Status Breakdown -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Restaurant Status Breakdown</h3>
                <canvas id="statusChart" class="w-full h-48"></canvas>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('topRestaurantsChart'), {
            type: 'bar',
            data: {
                labels: @json($topRestaurants->pluck('name')),
                datasets: [{
                    label: 'Food Posts',
                    data: @json($topRestaurants->pluck('food_posts_count')),
                }]
            }
        });

        new Chart(document.getElementById('avgRatingChart'), {
            type: 'bar',
            data: {
                labels: @json($avgRatings->pluck('name')),
                datasets: [{
                    label: 'Avg Rating',
                    data: @json($avgRatings->pluck('avg_rating')),
                }]
            }
        });

        new Chart(document.getElementById('locationChart'), {
            type: 'pie',
            data: {
                labels: @json($locationDistribution->pluck('location')),
                datasets: [{
                    label: 'Restaurants by Location',
                    data: @json($locationDistribution->pluck('count')),
                }]
            }
        });

        new Chart(document.getElementById('mostReviewedChart'), {
            type: 'bar',
            data: {
                labels: @json($mostReviewed->pluck('name')),
                datasets: [{
                    label: 'Reviews',
                    data: @json($mostReviewed->pluck('total_reviews')),
                }]
            }
        });

        new Chart(document.getElementById('monthlyAddedChart'), {
            type: 'line',
            data: {
                labels: @json($monthlyRestaurants->pluck('month')),
                datasets: [{
                    label: 'Restaurants Added',
                    data: @json($monthlyRestaurants->pluck('total')),
                }]
            }
        });

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: @json($statusBreakdown->pluck('status')),
                datasets: [{
                    data: @json($statusBreakdown->pluck('total')),
                }]
            }
        });
    </script>

    <!-- Restaurant Add Form Modal -->
    <div id="restaurantModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Restaurant</h3>
            <form method="POST" action="{{ route('restaurant.store') }}">
                @csrf
                <input type="hidden" name="added_by_user_id" value="{{ auth()->id() }}">

                <div class="mt-4">
                    <x-input-label for="rest_name" value="Restaurant Name" />
                    <x-text-input id="rest_name" class="block mt-1 w-full" type="text" name="name"
                        :error="$errors->has('name')" :value="old('name')" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="location" value="Location" />
                    <input id="location" class="block mt-1 w-full text-slate-400 bg-white border rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}"
                        type="text" name="location" placeholder="Eg: Pokhara, Nepal"
                        value="{{ old('location') }}" autofocus>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="latitude" class="block font-medium text-sm text-slate-600">Latitude</label>
                    <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                        :error="$errors->has('latitude')" :value="old('latitude')" autofocus />
                    <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="longitude" class="block font-medium text-sm text-slate-600">Longitude</label>
                    <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                        :error="$errors->has('longitude')" :value="old('longitude')" autofocus />
                    <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="status" class="block font-medium text-sm text-slate-600">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full text-slate-400 bg-white border rounded-md shadow-sm">
                        <option value="approved">approved</option>
                        <option value="pending">pending</option>
                        <option value="rejected">rejected</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                </div>
            </form>
            <!-- Close button (X) -->
            <button onclick="closeRestaurantModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    
</main>
{{-- END MAIN --}}
@if ($errors->any())
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('restaurantModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });
    </script>
@endif

@endsection
