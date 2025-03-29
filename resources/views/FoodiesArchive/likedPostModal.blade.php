{{-- FOR LIKED FOODPOST MODAL --}}
<div id="modal-{{ $likedpost->foodPost->id }}" class="modal">
    <div class="w-full flex items-center justify-center relative p-4">
        <a href="" class="close absolute top-4 right-4 text-white text-3xl">
            <i class="fa-solid fa-xmark"></i>
        </a>

        <!-- Modal for md, lg, xl -->
        <div class="hidden md:flex bg-white w-full max-w-5xl rounded-r-md h-[90vh] flex-col md:h-[80vh] lg:h-[80vh] xl:h-[90vh]">
            <div class="flex flex-col md:flex-row flex-grow overflow-auto">
                <!-- Food Image -->
                <div class="w-full md:w-1/2 lg:h-[80vh] xl:h-[90vh]">
                    <img src="{{ asset($likedpost->foodPost->image) }}" alt="Food" class="w-full h-full object-cover">
                </div>
                <!-- Food Details -->
                <div class="w-full md:w-1/2 p-6 flex flex-col">
                    <div class="flex justify-between items-center mb-3 pb-4 border-b-2">
                        <div class="flex items-center">
                            <a href="">
                                <img src="{{ asset('uploads/profile-images/' . $likedpost->foodPost->user->image) }}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                            </a>
                            <div class="ml-3">
                                <a href="" class="font-medium text-base hover:text-gray-500">{{$likedpost->foodPost->user->full_name}}</a>
                                <p class="text-gray-500 text-xs">{{$likedpost->foodPost->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        {{-- <button class="bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button> --}}
                        <div>
                            @php
                                $authUser = auth()->user();
                                $isFollowing = $authUser && isset($likedpost->foodPost->user) ? $authUser->isFollowing($likedpost->foodPost->user->id) : false;
                            @endphp

                            @if ($authUser && $authUser->id === $likedpost->foodPost->user->id)
                                {{-- If the post is by the authenticated user, not showing any button --}}
                            @else
                                @if (!$authUser)
                                    {{-- If the user is not logged in, showing the Follow button --}}
                                    <button type="button" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                        Follow
                                    </button>
                                @else
                                    {{-- If logged in, check if they are following --}}
                                    @if ($isFollowing)
                                        <button class="py-1 px-5 bg-gray-200 text-sm font-medium rounded-md hover:bg-gray-300">
                                            Following
                                        </button>
                                    @else
                                        <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                            Follow
                                        </button>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>

                    <h2 class="text-2xl font-medium mb-1">{{$likedpost->foodPost->name}}</h2>
                    <p class="text-gray-700 text-base">Restaurant: {{$likedpost->foodPost->restaurant->name}}</p>
                    <span class="text-gray-700 mb-3 text-base">{{$likedpost->foodPost->foodType->name}}, {{$likedpost->foodPost->cuisineType->name}}</span>
                    <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-3 mb-4 rounded w-fit">{{$likedpost->foodPost->tag->name}}</span>

                    @php
                        $userRatingValue = round($likedpost->foodPost->rating);
                        $formattedRating = number_format($userRatingValue, 1);
                    @endphp

                    <div class="flex items-center mr-2 my-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $userRatingValue)
                                <!-- Full star if the rating is less than or equal to the user's rating -->
                                <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                    class="bg-customYellow p-1 rounded-md mr-1" 
                                    style="height: 25px; width: 25px;" 
                                    alt="Full">
                            @else
                                <!-- Empty star if the rating is less than the current iteration -->
                                <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                    class="bg-gray-300 p-1 rounded-md mr-1" 
                                    style="height: 25px; width: 25px;" 
                                    alt="Empty">
                            @endif
                        @endfor
                        <p class="pl-1">{{$formattedRating}}</p>
                    </div>
                    <p class="font-medium text-lg mb-4">Rs. {{$likedpost->foodPost->price}}</p>
                    <p class="text-gray-700 mb-6">
                        {{$likedpost->foodPost->review}}
                    </p>
                    <div class="mt-auto border-t flex items-center justify-between">
                        <div class="flex items-center space-x-4 my-2">
                            @include('components.like-button', ['food' => $likedpost->foodPost])

                            <span class="text-black text-xl">
                                <i class="fa-regular fa-comment text-xl hover:text-gray-500 cursor-pointer"></i> {{$likedpost->foodPost->reviews->count()}}
                            </span>
                        </div>
                        @include('components.bookmark-button', ['food' => $likedpost->foodPost])
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for sm and smaller screens -->
        <div class="md:hidden bg-opacity-90 w-full max-w-sm p-4 flex flex-col">
            <!-- Profile Section -->
            <div class="flex items-center w-full justify-between my-3">
                <div class="flex items-center">
                    <img src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover">
                    <div class="ml-2">
                        <a href="" class="text-white text-sm font-medium font-poppins hover:text-gray-200">{{Auth::user()->full_name}}</a>
                        <p class="text-gray-200 text-xs font-poppins">{{$likedpost->foodPost->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <button class="bg-customYellow text-black text-xs px-3 py-1 rounded-full font-medium hover:bg-hovercustomYellow font-poppins">Follow</button>
            </div>

            <!-- Food Image -->
            <div class="w-full overflow-hidden h-[50vh] sm:h-[70vh]">
                <img src="{{ asset($likedpost->foodPost->image) }}" alt="Food" class="w-full h-[60vh] sm:h-[70vh] object-cover">
            </div>

            <!-- Rating & Engagement -->
            <div class="bg-white rounded-b-lg px-2">
                <div class="flex items-center justify-between w-full mt-1">
                    <div class="flex items-center space-x-4">
                        <span class="text-black text-base font-poppins">
                            <i class="fa-regular fa-heart text-lg hover:text-gray-400 cursor-pointer"></i> {{ $likedpost->foodPost->likes->count() }}
                        </span>
                        <span class="text-black text-base font-poppins">
                            <i class="fa-regular fa-comment text-lg hover:text-gray-400 cursor-pointer"></i> {{ $likedpost->foodPost->reviews->count() }}
                        </span>
                        
                    </div>
                    <div>
                        <i class="fa-regular fa-bookmark text-lg text-black hover:text-gray-400 cursor-pointer"></i>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <a href="" class="text-base font-bold hover:text-gray-600">{{$likedpost->foodPost->name}}</a>
                    <div class="flex">
                        <img src="{{asset('assets/img/cutlery (1).png')}}" class="bg-customYellow p-1 rounded-md"
                            style="height: 25px; width: 25px" alt="">
                        <span class="text-customYellow font-normal pl-2">
                            {{ number_format($likedpost->foodPost->rating, 1) }}
                        </span>
                    </div>
                </div>
                <p class="text-black text-sm">Rs. {{$likedpost->foodPost->price}}</p>
                <p class="text-gray-500 my-1 text-sm">{{$likedpost->foodPost->review}}</p>
                
            </div>
        </div>
    </div>
</div>