<x-app-layout>
    <section class="pt-20">
        <!-- Hero Section -->
        <div class="hero-section h-[70vh] relative overflow-hidden">
            <!-- Background Image Layer -->
            <div class="absolute inset-0 z-0" style="background-image: url('/assets/img/food-banner.png'); background-size: cover; background-position: center;opacity: 0.8;"></div>

            <!-- Gradient Overlay Layer (dark to white) -->
            <div class="absolute inset-0 z-0 bg-gradient-to-b from-black/70 via-transparent to-gray-400"></div>

            <!-- Content Layer -->
            <div class="container relative z-10 mx-auto px-4 py-24 sm:px-6 lg:px-8 flex flex-col items-center text-center justify-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">Discover Nepal's Culinary Treasures</h1>
                <p class="text-xl text-white max-w-2xl mb-8" style="text-shadow: 2px 2px 6px rgba(0,0,0,0.5);">
                    Foodie's Archive is a community-driven platform celebrating the rich and diverse food culture across Nepal.
                </p>
                <div class="flex space-x-4">
                    <a href="/discover" class="bg-customYellow text-white hover:bg-hovercustomYellow px-6 py-3 rounded-full font-medium flex items-center shadow-2xl hvr-icon-forward">
                        Explore Foods
                        <i class="fa-solid fa-arrow-right hvr-icon ml-2 h-4 w-4"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="container mx-auto px-4 pt-12 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">About Foodie's Archive</h2>
                <p class="text-lg text-gray-600">
                We're more than just a food review platform - we're a passionate community of food lovers dedicated to
                uncovering and celebrating Nepal's vibrant culinary landscape.
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-8 items-center mb-16">
                <div class="md:w-1/2">
                    <div class="relative h-[600px] w-full rounded-xl overflow-hidden shadow-xl">
                        <img src="{{asset('assets/img/aboutusImage.jpeg')}}" alt="" class="object-cover h-full w-full">
                    </div>
                </div>
                <div class="md:w-1/2">
                    <div class="text-gray-700 space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">My Mission</h3>
                            <p class="mb-4">
                                At Foodie's Archive, our mission is to connect food enthusiasts with authentic culinary experiences across Nepal.
                            </p>
                            <p>
                                We strive to preserve and promote the rich food heritage of Nepal while supporting local eateries and food artisans.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">My Vision</h3>
                            <p class="mb-4">
                                We envision a world where every delicious dish in Nepal is discoverable, every food story is told.
                            </p>
                            <p>
                                Foodie's Archive aims to become the definitive digital archive of Nepal's food culture.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">My Story</h3>
                            <p class="mb-4">
                                Foodie's Archive began as a final year project born from a passion for Nepal's diverse culinary
                                landscape. What started as an academic project is now a thriving foodie community.
                            </p>
                            <p>
                                We celebrate Nepal’s food culture by encouraging food lovers to share their stories, reviews, and food journeys.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gray-50 py-12">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">What Makes Us Special</h2>
                    <p class="text-lg text-gray-600">
                        Discover the features that make Foodie's Archive the ultimate platform for food lovers in Nepal.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @php
                        $features = [
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/94/marker.png" alt="marker"/>', 'title' => 'Interactive Food Map', 'desc' => 'Locate restaurants, street food stalls, and famous food spots across Nepal.'],
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/94/christmas-star.png" alt="christmas-star"/>', 'title' => 'Reviews & Ratings', 'desc' => 'Share your dining experiences and help others discover great food.'],
                        // ['icon' => 'hi', 'title' => 'Q&A Community', 'desc' => 'Ask questions and get answers from fellow food enthusiasts.'],
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/94/fire--v2.png" alt="fire--v2"/>', 'title' => 'Streaks & Achievements', 'desc' => 'Earn badges like "Best Food Traveler" or "Top Foodie".'],
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/100/membership-card.png" alt="membership-card"/>', 'title' => 'Premium Membership', 'desc' => 'Unlock exclusive features and become a premium user.'],
                        // ['icon' => 'hi', 'title' => 'Food Events', 'desc' => 'Discover and participate in food festivals and culinary events.'],
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/100/bookmark-ribbon.png" alt="bookmark-ribbon"/>', 'title' => 'Bookmarking', 'desc' => 'Save your favorite foods.'],
                        ['icon' => '<img width="32" height="32" src="https://img.icons8.com/3d-fluency/100/upload.png" alt="upload"/>', 'title' => 'Food Posts', 'desc' => 'Create and share detailed food posts with images.'],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="mb-4 text-3xl">{!! $feature['icon'] !!}</div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                            <p class="text-gray-600">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="container mx-auto px-4 pt-6 sm:px-6 lg:px-8 py-12">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Meet The Developer</h2>
                <p class="text-lg text-gray-600">The passionate food enthusiast behind Foodie's Archive.</p>
            </div>

            <div class=" flex flex-col items-center justify-center pt-3">
                <div class="max-w-md w-full bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    <div class="relative h-80 w-full">
                        <img src="{{asset('assets/img/FoodieArchive_Developer.jpg')}}" alt="img" class="object-cover object-center h-full w-full" />
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-1">Developer</h3>
                        <p class="text-red-600 mb-3">Developer & Food Explorer</p>
                        <p class="text-gray-600 mb-4">Passionate in web development and designing.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Join Us Section -->
        <div class="bg-gradient-to-r from-orange-500 to-yellow-600 py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Join Our Food-Loving Community</h2>
                <p class="text-xl text-white/90 max-w-2xl mx-auto mb-8">
                Become part of Foodie's Archive and help us document and celebrate Nepal's incredible food culture.
                </p>
                <a href="/register" class="bg-white text-customYellow hover:bg-gray-100 px-8 py-4 rounded-full font-medium inline-flex items-center hvr-icon-forward">
                    Sign Up Now
                    <i class="fa-solid fa-arrow-right hvr-icon ml-2 h-4 w-4"></i>
                </a>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="container mx-auto px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">{{ number_format($foodPostCount) }}+</p>
                    <p class="text-gray-600">Food Posts</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">{{ number_format($userCount) }}+</p>
                    <p class="text-gray-600">Active Users</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">{{ number_format($districtCount) }}+</p>
                    <p class="text-gray-600">Cities Covered</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-red-600 mb-2">{{ number_format($restaurantCount) }}+</p>
                    <p class="text-gray-600">Local Eateries</p>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>