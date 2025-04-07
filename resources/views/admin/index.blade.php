@extends('admin.inc.main')
@section('container')
    {{-- @auth
        <li class="nav-item
                dropdown mx-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-2"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ 'Log Out' }}
                    </x-dropdown-link>
                </form>
            </ul>
        </li>
    @endauth
    <h1>
        HELLO WELCOME ADMIN
    </h1> --}} 

        <div class="p-8">
            <!-- Tab Navigation -->
            <div class="flex justify-between items-center mb-6">
                <div class="space-x-2">
                    <button class="px-4 py-2 text-sm font-medium bg-white rounded shadow hover:bg-gray-100">Overview</button>
                    <button class="px-4 py-2 text-sm font-medium bg-white rounded shadow hover:bg-gray-100">Food Posts</button>
                    <button class="px-4 py-2 text-sm font-medium bg-white rounded shadow hover:bg-gray-100">Users</button>
                    <button class="px-4 py-2 text-sm font-medium bg-white rounded shadow hover:bg-gray-100">Reviews</button>
                </div>
                <button class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Export Data</button>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Total Users</p>
                    <div class="text-2xl font-bold">{{ $totalUsers }}</div>
                    <p class="text-xs mt-1 {{ $userGrowth < 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $userGrowth < 0 ? '-' : '+' }}{{ min(abs(round($userGrowth, 2)), 100)}}% from last month ({{ $usersLastMonth }} → {{ $usersThisMonth }})
                    </p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Premium Users</p>
                    <div class="text-2xl font-bold">{{ $premiumUsers }}</div>
                    <p class="text-xs mt-1 {{ $premiumGrowth < 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $premiumGrowth < 0 ? '-' : '+' }}{{ min(abs(round($premiumGrowth, 2)), 100)}}% from last month ({{ $premiumLastMonth }} → {{ $premiumThisMonth }})
                    </p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Food Posts</p>
                    <div class="text-2xl font-bold">{{ $totalFoodPosts }}</div>
                    <p class="text-xs mt-1 {{ $postGrowth < 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $postGrowth < 0 ? '-' : '+' }}{{ min(abs(round($postGrowth, 2)), 100)}}% from last month ({{ $postsLastMonth }} → {{ $postsThisMonth }})
                    </p>
                </div>
                <div class="bg-white p-4 rounded shadow">
                    <p class="text-sm text-gray-500">Reviews</p>
                    <div class="text-2xl font-bold">{{ $totalMainReviews }}</div>
                    <p class="text-xs mt-1 {{ $reviewGrowth < 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $reviewGrowth < 0 ? '-' : '+' }}{{ min(abs(round($reviewGrowth, 2)), 100)}}% from last month ({{ $reviewsLastMonth }} → {{ $reviewsThisMonth }})
                    </p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded shadow p-6 mb-6">
                <h2 class="text-lg font-semibold mb-2">Recent Activity</h2>
                <p class="text-sm text-gray-500 mb-4">Latest actions across the platform</p>

                <div class="space-y-4">
                    <div class="flex gap-4 items-start">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">JD</div>
                        <div>
                            <p class="text-sm font-medium">John Doe added a new food post</p>
                            <p class="text-sm text-gray-500">Authentic Newari Cuisine at Bhojan Griha</p>
                            <p class="text-xs text-gray-400">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">SM</div>
                        <div>
                            <p class="text-sm font-medium">Sarah Miller left a review</p>
                            <p class="text-sm text-gray-500">5-star review for Thakali Kitchen</p>
                            <p class="text-xs text-gray-400">4 hours ago</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">RK</div>
                        <div>
                            <p class="text-sm font-medium">Rajesh Kumar upgraded to premium</p>
                            <p class="text-sm text-gray-500">Annual subscription plan</p>
                            <p class="text-xs text-gray-400">Yesterday</p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">AP</div>
                        <div>
                            <p class="text-sm font-medium">Aakriti Pradhan asked a question</p>
                            <p class="text-sm text-gray-500">About Sel Roti preparation techniques</p>
                            <p class="text-xs text-gray-400">Yesterday</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Food Posts Table -->
            <div class="bg-white rounded shadow p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Food Posts Management</h2>
                    <button class="px-4 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">Add New Post</button>
                </div>
                <p class="text-sm text-gray-500 mb-4">Manage all food posts across the platform</p>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                        <th class="p-3">Post Title</th>
                        <th class="p-3">Author</th>
                        <th class="p-3">Rating</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <tr>
                            <td class="p-3 font-medium">Authentic Momo Experience in Thamel</td>
                            <td class="p-3">Binod Sharma</td>
                            <td class="p-3">4.8</td>
                            <td class="p-3 text-gray-500">Apr 2, 2023</td>
                            <td class="p-3"><span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Published</span></td>
                        </tr>
                        <tr>
                            <td class="p-3 font-medium">Street Food Tour of Patan</td>
                            <td class="p-3">Anita Gurung</td>
                            <td class="p-3">4.2</td>
                            <td class="p-3 text-gray-500">Apr 1, 2023</td>
                            <td class="p-3"><span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">Under Review</span></td>
                        </tr>
                        <tr>
                            <td class="p-3 font-medium">Hidden Gem: Newari Feast in Kirtipur</td>
                            <td class="p-3">Suraj Maharjan</td>
                            <td class="p-3">4.9</td>
                            <td class="p-3 text-gray-500">Mar 30, 2023</td>
                            <td class="p-3"><span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Flagged</span></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    {{-- END MAIN --}}
@endsection