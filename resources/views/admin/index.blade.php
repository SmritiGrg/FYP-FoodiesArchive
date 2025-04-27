@extends('admin.inc.main')
@section('container')
<main class="w-[calc(100%-260px)] ml-64 bg-gray-50 min-h-screen pt-16">
    <div class="flex-1 overflow-auto bg-gray-100 px-8">
        <div class="container px-4 py-6 mx-auto">
            <h2 class="text-2xl font-semibold text-gray-800">Dashboard Overview</h2>
            <p class="mt-1 text-sm text-gray-600">Welcome to Foodie's Archive admin panel</p>

            {{-- CARDS --}}
            <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-md">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Food Posts</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalFoodPosts }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-md">
                            <i class="ri-group-line w-6 h-6 text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Users</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-md">
                            <i class="ri-arrow-up-long-fill w-6 h-6 text-yellow-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Premium Users</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalSubscriptions }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-md">
                            <i class="fa-solid fa-money-bills w-6 h-6 text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
                            <p class="text-2xl font-semibold text-gray-800">Rs. {{ $totalRevenue }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-purple-100 rounded-md">
                            <i class="ri-restaurant-2-line w-6 h-6 text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Restaurants</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalRestaurants }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-100 rounded-md">
                            <i class="fa-regular fa-comment w-6 h-6 text-red-600" title="Write Review"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Reviews</h3>
                            <p class="text-2xl font-semibold text-gray-800">{{ $totalReviews }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 gap-4 mt-8 lg:grid-cols-2">
            <!-- User Activity Chart -->
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">User Activity</h3>
                <p class="text-sm text-gray-500">Daily active users over the last 30 days</p>
                <div class="mt-4 h-72">
                    <canvas id="dailyActiveUsersChart"></canvas>
                </div>
            </div>

            <!-- Monthly Growth Chart -->
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">Monthly Growth</h3>
                <p class="text-sm text-gray-500">New registrations, food posts, and reviews</p>
                <div class="mt-4 h-72">
                    <canvas id="monthlyGrowthChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-8 lg:grid-cols-3">
            {{-- TOP FOOD POSTS --}}
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">Top Food Posts</h3>
                <div class="mt-4 space-y-4">
                    @forelse($topFoodPosts as $post)
                        <div class="flex items-start p-2 rounded-lg hover:bg-gray-50">
                            <div class="flex-shrink-0 w-14 h-14 overflow-hidden rounded-lg">
                                <img src="{{ asset($post->image) }}" alt="Food" class="object-cover w-full h-full" />
                            </div>
                            <div class="ml-4 flex flex-col justify-between">
                                <h4 class="text-sm font-medium text-gray-800">{{ $post->name }}</h4>
                                <div class="flex items-center mt-1">
                                    <img src="{{ asset('assets/img/cutlery (1).png') }}" class="bg-customYellow p-1 rounded-md"
                                        style="height: 22px; width: 22px" alt="">
                                    <span class="ml-1 text-xs text-gray-500">{{ number_format($post->reviews_avg_rating, 1) }}({{ $post->likes_count }} likes)</span>
                                </div>
                                <div class="mt-1 text-xs font-medium text-gray-600">{{ $post->user->username }}</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No food posts available.</p>
                    @endforelse
                </div>
            </div>

            {{-- Top Users --}}
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">Top Performing Users</h3>
                <div class="mt-4 space-y-4">
                    @forelse($topUsers as $user)
                        <div class="flex items-center p-2 rounded-lg hover:bg-gray-50">
                            <div class="flex-shrink-0 w-10 h-10 overflow-hidden rounded-full">
                                <img src="{{asset('uploads/profile-images/'. $user->image)}}" alt="User" class="object-cover w-full h-full" />
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-800">{{ $user->full_name }}</h4>
                                <div class="flex items-center mt-1">
                                    <span class="text-xs text-gray-500">
                                        {{ $user->food_posts_count }} posts - {{$user->followers_count }} followers
                                    </span>
                                </div>
                            </div>
                            <div class="ml-auto">
                                @if($user->role === 'premium_user')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        Premium
                                    </span>
                                @elseif($user->role === 'general')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                        General
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No top users available.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="grid grid-cols-1 gap-4 mt-8 lg:grid-cols-2">
            {{-- Most Used Cuisine Types  --}}
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">Most Used Cuisine Types</h3>
                <div class="mt-4 h-72">
                    <canvas id="cuisineTypeChart"></canvas>
                </div>
            </div>

            {{-- Most Used Food Types  --}}
            <div class="p-4 bg-white rounded-lg shadow">
                <h3 class="text-lg font-medium text-gray-800">Most Used Food Types</h3>
                <div class="mt-4 h-72">
                    <canvas id="foodTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // User Activity Chart
    const dailyActiveLabels = @json($dailyActiveUsers->pluck('date'));
    const dailyActiveData = @json($dailyActiveUsers->pluck('active_users'));

    const dailyActiveUsersCtx = document.getElementById('dailyActiveUsersChart').getContext('2d');
    new Chart(dailyActiveUsersCtx, {
        type: 'line',
        data: {
            labels: dailyActiveLabels,
            datasets: [{
                label: 'Active Users',
                data: dailyActiveData,
                fill: true,
                borderColor: 'rgb(255, 144, 187)',
                backgroundColor: 'rgba(255, 237, 250, 1)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Chart for showing Monthly Growth
    const monthlyLabels = @json($last30Days);
    const registrations = @json($registrationsData);
    const foodPosts = @json($foodPostsData);
    const reviews = @json($reviewsData);

    const monthlyGrowthCtx = document.getElementById('monthlyGrowthChart').getContext('2d');
    new Chart(monthlyGrowthCtx, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [
                {
                    label: 'Registrations',
                    data: registrations,
                    backgroundColor: 'rgba(247, 90, 90, 1)'
                },
                {
                    label: 'Food Posts',
                    data: foodPosts,
                    backgroundColor: 'rgba(255, 169, 85, 1)'
                },
                {
                    label: 'Reviews',
                    data: reviews,
                    backgroundColor: 'rgba(255, 214, 58, 1)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        maxRotation: 90,
                        minRotation: 45,
                        autoSkip: true,
                        maxTicksLimit: 10,
                    }
                },
                y: {
                    stacked: true
                }
            }
        }
    });

    const cuisineTypeLabels = @json($cuisineTypes->pluck('name'));
    const cuisineTypeCounts = @json($cuisineTypes->pluck('food_posts_count'));

    const foodTypeLabels = @json($foodTypes->pluck('name'));
    const foodTypeCounts = @json($foodTypes->pluck('food_posts_count'));

    // Cuisine Type Chart
    const cuisineCtx = document.getElementById('cuisineTypeChart').getContext('2d');
    new Chart(cuisineCtx, {
        type: 'bar',
        data: {
            labels: cuisineTypeLabels,
            datasets: [{
                label: 'Number of Food Posts',
                data: cuisineTypeCounts,
                backgroundColor: 'rgba(72, 166, 167, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Food Type Chart
    const foodCtx = document.getElementById('foodTypeChart').getContext('2d');
    new Chart(foodCtx, {
        type: 'bar',
        data: {
            labels: foodTypeLabels,
            datasets: [{
                label: 'Number of Food Posts',
                data: foodTypeCounts,
                backgroundColor: 'rgba(198, 142, 253, 1)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection