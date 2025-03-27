{{-- FOR FOODPOST MODAL --}}
<div id="modal-{{ $post->id }}" class="modal">
    <div class="w-full flex items-center justify-center relative p-4">
        <a href="" class="close absolute top-4 right-4 text-white text-3xl">
            <i class="fa-solid fa-xmark"></i>
        </a>

        <!-- Modal for md, lg, xl -->
        <div class="hidden md:flex bg-white w-full max-w-5xl rounded-r-md h-[90vh] flex-col md:h-[80vh] lg:h-[80vh] xl:h-[90vh]">
            <div class="flex flex-col md:flex-row flex-grow overflow-auto">
                <!-- Food Image -->
                <div class="w-full md:w-1/2 lg:h-[80vh] xl:h-[90vh]">
                    <img src="{{ asset($post->image) }}" alt="Food" class="w-full h-full object-cover">
                </div>
                <!-- Food Details -->
                <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow overflow-hidden">
                    <div class="flex justify-between items-center mb-3 pb-4 border-b-2 sticky top-0 z-10">
                        <div class="flex items-center">
                            <a href="">
                                <img src="{{ asset('uploads/profile-images/' . $post->user->image) }}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                            </a>
                            <div class="ml-3">
                                <a href="" class="font-medium text-base hover:text-gray-500">{{$post->user->full_name}}</a>
                                <p class="text-gray-500 text-xs">{{$post->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        {{-- <button class="bg-customYellow text-black text-sm px-5 py-1 rounded-full font-medium hover:bg-hovercustomYellow">Follow</button> --}}
                        @php
                            $authUser = auth()->user();
                            $isFollowing = $authUser && isset($user) ? $authUser->isFollowing($user->id) : false;
                        @endphp

                        @if (!$authUser)
                            {{-- If the user is not logged in, show the Follow button --}}
                            <form method="POST" action="{{route('users.follow', $user->id)}}">
                                @csrf
                                <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                    Follow
                                </button>
                            </form>
                        @else
                            {{-- If logged in, check if they are following --}}
                            @if ($isFollowing)
                                <div class="relative group">
                                    <button class="py-1 px-5 bg-gray-200 text-sm font-medium rounded-md hover:bg-gray-300">
                                        Following
                                    </button>                               
                                    <div class="absolute w-32 top-full left-0 rounded-lg p-1 mt-1 shadow-lg text-start scale-y-0 border-2 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        <form method="POST" action="{{route('users.unfollow', $user->id)}}">
                                            @csrf
                                            <button type="submit" class="w-full text-red-500 hover:bg-gray-100 border-b border-gray-200 last:border-b-0 flex items-center py-1 px-3">
                                                Unfollow
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <form method="POST" action="{{route('users.follow', $user->id)}}">
                                    @csrf
                                    <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                        Follow
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>

                    <div class="flex-grow overflow-auto scrollable-content pt-3">
                        <h2 class="text-xl font-medium mb-1">{{$post->name}}</h2>
                        <p class="text-gray-700 text-sm">Restaurant: {{$post->restaurant->name}}</p>
                        <p class="text-gray-700 mb-3 text-sm">{{$post->foodType->name}}, {{$post->cuisineType->name}}</p>
                        <p class="bg-green-100 text-green-700 text-xs font-medium py-1 px-3 mb-4 rounded w-fit">{{$post->tag->name}}</p>

                        @php
                        $userRatingValue = round($post->rating);
                        $formattedRating = number_format($userRatingValue, 1);
                        @endphp

                        <div class="flex items-center mr-2 my-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <=$userRatingValue)
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
                        <p class="font-medium text-lg mb-2">Rs. {{$post->price}}</p>
                        <p class="text-gray-700 pb-6 border-b-2 border-b-gray-100">
                            {{$post->review}}
                        </p>
                        <div class="flex flex-col space-y-6 w-full pt-3">
                            @foreach($post->reviews as $review)
                                <div class="flex">
                                    <a href="">
                                        <img src="{{ asset('uploads/profile-images/' . $review->user->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover" />
                                    </a>
                                    <div class="ml-3">
                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('otherProfile', ['id' => $review->user->id]) }}" class="font-normal text-xs hover:text-gray-500">{{$review->user->full_name}}</a>
                                        </div>
                                        <p class="text-gray-500 text-xs">{{$post->created_at->diffForHumans()}}</p>
                                        <div class="mt-2">
                                            @php
                                                $userRatingValue = round($review->rating);
                                                $formattedRating = number_format($userRatingValue, 1);
                                            @endphp
                                            
                                            <div class="flex items-center space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <img src="{{ asset('assets/img/cutlery (1).png') }}" 
                                                        class="p-1 rounded-md {{ $i <= $userRatingValue ? 'bg-customYellow' : 'bg-gray-300' }}" 
                                                        style="height: 20px; width: 20px;" 
                                                        alt="{{ $i <= $userRatingValue ? 'Full' : 'Empty' }}">
                                                @endfor
                                                <p class="pr-2 text-xs font-normal">{{ $formattedRating }}</p>
                                            </div>
                                            <p class="text-xs text-textBlack mt-2 font-light">{{$review->review}}</p>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-auto border-t flex items-center justify-between sticky bottom-0 z-10">
                        <div class="flex items-center space-x-4 my-2">
                            @include('components.like-button', ['food' => $post])

                            <span class="text-black text-xl">
                                <i class="fa-regular fa-comment text-xl hover:text-gray-500 cursor-pointer"></i> {{$post->reviews->count()}}
                            </span>
                        </div>
                        <i class="not-bookmarked fa-regular fa-bookmark text-xl hover:text-gray-500 cursor-pointer"></i>
                        <i class="bookmarked fa-solid fa-bookmark text-xl text-black hidden cursor-pointer"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for sm and smaller screens -->
        <div class="md:hidden bg-opacity-90 w-full max-w-sm p-4 flex flex-col">
            <!-- Profile Section -->
            <div class="flex items-center w-full justify-between my-3">
                <div class="flex items-center">
                    <img src="{{ asset('uploads/profile-images/' . $post->user->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover">
                    <div class="ml-2">
                        <a href="" class="text-white text-sm font-medium font-poppins hover:text-gray-200">{{$post->user->full_name}}</a>
                        <p class="text-gray-200 text-xs font-poppins">{{$post->created_at->diffForHumans()}}</p>
                    </div>
                </div>
                <button class="bg-customYellow text-black text-xs px-3 py-1 rounded-full font-medium hover:bg-hovercustomYellow font-poppins">Follow</button>
                
            </div>

            <!-- Food Image -->
            <div class="w-full overflow-hidden h-[50vh] sm:h-[70vh]">
                <img src="{{ asset($post->image) }}" alt="Food" class="w-full h-[60vh] sm:h-[70vh] object-cover">
            </div>

            <!-- Rating & Engagement -->
            <div class="bg-white rounded-b-lg px-2">
                <div class="flex items-center justify-between w-full mt-1">
                    <div class="flex items-center space-x-4">
                        <span class="text-black text-base font-poppins">
                            <i class="fa-regular fa-heart text-lg hover:text-gray-400 cursor-pointer"></i> {{ $post->likes->count() }}
                        </span>
                        <span class="text-black text-base font-poppins">
                            <i class="fa-regular fa-comment text-lg hover:text-gray-400 cursor-pointer"></i> {{ $post->reviews->count() }}
                        </span>

                    </div>
                    <div>
                        <i class="fa-regular fa-bookmark text-lg text-black hover:text-gray-400 cursor-pointer"></i>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <a href="" class="text-base font-bold hover:text-gray-600">{{$post->name}}</a>
                    <div class="flex">
                        <img src="{{asset('assets/img/cutlery (1).png')}}" class="bg-customYellow p-1 rounded-md"
                            style="height: 25px; width: 25px" alt="">
                        <span class="text-customYellow font-normal pl-2">
                            {{ number_format($post->rating, 1) }}
                        </span>
                    </div>
                </div>
                <p class="text-black text-sm">Rs. {{$post->price}}</p>
                <p class="text-gray-500 my-1 text-sm">{{$post->review}}</p>

            </div>
        </div>
    </div>
</div>