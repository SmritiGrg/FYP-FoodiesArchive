<x-app-layout>
    <section class="pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <a href="/discover" class="text-gray-700 font-medium hover:text-gray-500 hvr-icon-back"><i class="fa-solid fa-arrow-left-long hvr-icon"></i> Back</a>

            <h1 class="text-2xl font-bold mt-2">{{$singlePost->name}}</h1>
            <p class="text-gray-600 pt-2">Restaurant: {{$singlePost->restaurant->name}}</p>
            <p class="text-gray-500 text-sm">{{$singlePost->cuisineType->name}}, {{$singlePost->foodType->name}}</p>

            <div class="grid md:grid-cols-5 gap-8 mt-4 border-b-2 border-gray-100 pb-6">
                <!-- Left Column - Image & Details (Takes 2/5 of the width) -->
                <div class="col-span-2">
                    <img src="{{ asset($singlePost->image) }}" alt="Food img" class="w-full h-2/4 object-cover rounded-lg" />
                    
                    <div class="flex items-center justify-between mt-3">
                        <div class="flex items-center gap-5 text-gray-600">
                            <span class="text-black text-base">
                                <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> {{ $singlePost->likes->count() }}
                            </span>

                            <span class="text-black text-base">
                                <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> {{ $singlePost->reviews->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="border-t-2 border-gray-100 mt-3 pt-5">
                        <div class="flex items-center">
                            <img src="{{asset('uploads/profile-images/' . $singlePost->user->image) }}" alt="" class="w-12 h-12 rounded-full object-cover mr-3">
                            <div>
                                <p class="text-base text-darkPurple">Uploaded by {{$singlePost->user->username}}</p>
                                <a href="{{ route('otherProfile', ['id' => $singlePost->user->id]) }}" class="text-sm text-gray-500 underline hover:text-gray-600">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Rating & Reviews (Takes 3/5 of the width) -->
                <div class="col-span-3">
                    <div class="flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$singlePost->tag->name}}</span>
                    </div>

                    @php
                        $userRatingValue = round($singlePost->rating);
                        $formattedRating = number_format($userRatingValue, 1);
                    @endphp

                    <div class="flex items-center mr-2 my-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                class="p-1 rounded-md mr-2 {{ $i <= $userRatingValue ? 'bg-customYellow' : 'bg-gray-300' }}" 
                                style="height: 29px; width: 29px;" 
                                alt="{{ $i <= $userRatingValue ? 'Full' : 'Empty' }}">
                        @endfor
                        <p class="ml-2 text-darkPurple font-normal text-sm">{{$formattedRating}}</p>
                    </div>

                    <p class="text-lg font-medium mt-2">Rs. {{$singlePost->price}}</p>
                    <p class="text-gray-500 mt-2 pb-4">{{$singlePost->review}}</p>

                    <div class="mt-4 border-t-2 border-gray-100 pb-4 pt-2">
                        <p class="text-xl text-darkPurple font-bold pb-2">Contribute</p>
                        <a href="{{ route('writeReview', ['food_id' => $singlePost->id]) }}" class="bg-darkPurple text-white px-4 py-2 rounded-3xl hover:bg-lightPurple">Write a Review</a>
                        <button class="ml-2 border border-darkPurple text-darkPurple px-4 py-2 rounded-3xl hover:bg-darkPurple hover:text-white">Ask a Question</button>
                    </div>

                    <h3 class="mt-4 text-lg font-medium">({{$singlePost->reviews->count()}} reviews)</h3>

                    <!-- Reviews Grid (2 Columns) -->
                    <div class="grid md:grid-cols-1 gap-4 mt-3">
                        @foreach($reviewsPaginate as $review)
                            <div class="p-3 border-b-2 border-gray-100">
                                <a href="{{ route('otherProfile', ['id' => $review->user->id]) }}" class="flex items-center">
                                    <img src="{{asset('uploads/profile-images/' . $review->user->image) }}" alt="" class="w-10 h-10 rounded-full object-cover mr-3">
                                    <div>
                                        <span class="block text-sm text-gray-900 font-medium">{{$review->user->full_name}}</span>
                                        <span class="block text-sm text-gray-500"
                                            >{{$review->user->username}}</span
                                        >
                                    </div>
                                </a>
                                @php
                                    $userRatingValue = round($review->rating);
                                    $formattedRating = number_format($userRatingValue, 1);
                                @endphp

                                <div class="flex items-center mr-2 my-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $userRatingValue)
                                            <!-- Full star if the rating is less than or equal to the user's rating -->
                                            <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                class="bg-customYellow p-1 rounded-md mr-1" 
                                                style="height: 20px; width: 20px;" 
                                                alt="Full">
                                        @else
                                            <!-- Empty star if the rating is less than the current iteration -->
                                            <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                class="bg-gray-300 p-1 rounded-md mr-1" 
                                                style="height: 20px; width: 20px;" 
                                                alt="Empty">
                                        @endif
                                    @endfor
                                    <p class="ml-2 text-darkPurple font-normal text-sm">{{$formattedRating}}</p>
                                </div>
                                <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                <p class="text-gray-600 mt-2 text-sm">{{ $review->review }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $reviewsPaginate->links() }}
                    </div>
                </div>
            </div>

            <!-- Location Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Location</h3>
                <p class="text-gray-600 text-sm"><i class="fa-solid fa-location-dot pr-1"></i> Street no 18, Pokhara 33700</p>
                <div class="w-full h-96 bg-gray-300 mt-2 rounded-md">
                    <iframe class="w-full h-full object-cover rounded-md" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d219.73573546818173!2d83.95905542858723!3d28.21424598805742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39959558ac66c7af%3A0x963bdee9ff7501dd!2sKafe%C3%AC%20Joy%20(Cafe)!5e0!3m2!1sen!2snp!4v1741682197379!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="py-7">
        <p class="border-t-2 border-gray-100 pt-4 font-bold text-2xl pl-24">You May Also Like</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mt-3 px-4 sm:px-8 lg:px-20">
            @if(isset($similarPosts) && $similarPosts->isNotEmpty())
                @foreach($similarPosts as $similarPost)
                    <div class="bg-white">
                        <div class="flex justify-between items-center p-4">
                            <div class="flex items-center">
                                <a href="">
                                    <img src="{{asset('uploads/profile-images/'. $similarPost->user->image)}}" alt="profile" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-80 transition-opacity duration-300" />
                                </a>
                                <div class="ml-3 relative group">
                                    <a href="" class="font-medium text-sm hover:text-gray-500">{{$similarPost->user->full_name}}</a>
                                    <!-- Modal -->
                                    <div class="absolute hidden group-hover:block w-60 p-4 bg-white shadow-lg rounded-lg z-10 border border-gray-200">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{asset('uploads/profile-images/' . $similarPost->user->image)}}" alt="profile" class="w-12 h-12 rounded-full object-cover">
                                            <div>
                                                <a href="" class="font-semibold text-sm font-poppins">{{$similarPost->user->full_name}}</a>
                                                <p class="text-gray-500 text-xs font-poppins">{{$similarPost->user->username}}</p>
                                                <p class="border border-gray-300 rounded-full text-sm w-16 pl-2 mt-2"><i class="fa-solid fa-fire-flame-curved text-red-400"></i> {{$similarPost->user->streak_count}}</p>
                                            </div>
                                        </div>
                                        <div class="flex justify-between text-center mt-4">
                                            <!-- Posts -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $similarPost->user->foodposts->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Posts</p>
                                            </div>
                                            <!-- Followers -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $similarPost->user->followers->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Followers</p>
                                            </div> 
                                            <!-- Following -->
                                            <div>
                                                <p class="font-bold text-sm font-poppins">{{ $similarPost->user->followings->count() }}</p>
                                                <p class="text-gray-500 text-xs font-poppins">Following</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="font-medium text-sm text-gray-500">{{$similarPost->user->username}}</p>
                                    <p class="text-gray-500 text-xs">{{ $similarPost->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <button class="font-poppins bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button>
                        </div>

                        <div class="px-4">
                            <img src="{{ asset('uploads/' . $similarPost->image) }}" alt="Food Img" class="w-full h-72 object-cover object-center rounded-xl"/>
                            <div class="mt-2">
                                <div class="flex justify-between items-center mt-2 mb-2">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-black text-base">
                                            <i class="unlike-heart fa-regular fa-heart text-lg hover:text-gray-500 cursor-pointer"></i>
                                            <i class="fa-solid fa-heart text-lg like-heart text-red-500 hidden cursor-pointer"></i> {{$similarPost->likes->count()}}
                                        </span>

                                        <span class="text-black text-base">
                                            <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> {{$similarPost->reviews->count()}}
                                        </span>
                                    </div>
                                    <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                    <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                                </div>
                                <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$similarPost->tag->name}}</span>
                                <div class="flex justify-between items-center mt-2">
                                    <a href="" class="text-base font-bold hover:text-gray-600">{{$similarPost->name}}</a>
                                    <div class="flex">
                                        <img src="{{asset('assets/img/cutlery (1).png')}}" class="bg-customYellow p-1 rounded-md"
                                            style="height: 25px; width: 25px" alt="">
                                        <span class="text-customYellow font-normal pl-2">
                                            5.0
                                        </span>
                                    </div>
                                </div>
                                <p class="text-black text-sm">Rs. {{$similarPost->price}}</p>
                                <p class="text-gray-500 mt-1 text-sm">{{$similarPost->review}}</p>
                                <a href="" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 text-sm text-center mt-4">No similar posts available.</p>
            @endif
        </div>
    </section>

</x-app-layout>