<x-app-layout>
    <section class="px-8 pt-24 pb-7 max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-darkPurple font-poppins text-center">Following</h1>
        <div class="flex gap-36">
            <!-- Main Content -->
            <div class="w-3/4">
                <!-- Food Cards -->
                <div class="space-y-6">
                    @foreach($foods as $food)
                        <div class="bg-white flex gap-4 border-b-2">
                            <div class="w-1/2">
                                <div class="flex justify-between items-center mb-3">
                                    <div class="flex items-center">
                                        <a href="">
                                            <img src="{{asset('uploads/profile-images/' . $food->user->image)}}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                                        </a>
                                        <div class="ml-3">
                                            <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="font-medium text-base hover:text-gray-500 font-poppins">{{$food->user->full_name}}</a>
                                            <p class="text-gray-500 text-xs font-poppins">{{ $food->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @php
                                        $authUser = auth()->user();
                                        $isFollowing = $authUser && isset($food->user) ? $authUser->isFollowing($food->user->id) : false;
                                    @endphp

                                    @if ($authUser && $authUser->id === $food->user->id)
                                        {{-- If the post is by the authenticated user, not showing any button --}}
                                    @else
                                        @if (!$authUser)
                                            {{-- If the user is not logged in, showing the Follow button --}}
                                            <form method="POST" action="{{route('users.follow', $food->user->id)}}">
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
                                                        <form method="POST" action="{{route('users.unfollow', $food->user->id)}}">
                                                            @csrf
                                                            <button type="submit" class="w-full text-red-500 hover:bg-gray-100 border-b border-gray-200 last:border-b-0 flex items-center py-1 px-3">
                                                                Unfollow
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <form method="POST" action="{{route('users.follow', $food->user->id)}}">
                                                    @csrf
                                                    <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                                        Follow
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                                <img src="{{ asset($food->image) }}" class="w-full h-96 rounded-lg object-cover">
                                <div class="flex justify-between items-center mt-2 mb-2">
                                    <div class="flex items-center space-x-4">
                                        @include('components.like-button', ['food' => $food])
                                        <span class="text-black text-base">
                                            <i class="fa-regular fa-comment text-xl hover:text-gray-500 cursor-pointer"></i> {{ $food->reviews->count() }}
                                        </span>
                                    </div>
                                    <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                    <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                                </div>
                            </div>
                            <div class="w-1/2 flex flex-col justify-between mt-14">
                                <div>
                                    <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$food->tag->name}}</span>
                                    <div class="flex justify-between">
                                        {{-- <a href="{{route('food.details', $food->id)}}" class="text-lg font-medium font-poppins mt-2">{{$food->name}}</a> --}}
                                        <a href="{{ route('food.details', ['id' => $food->id, 'scroll' => $loop->index]) }}" 
                                            class="text-lg font-medium font-poppins mt-2 post-link">
                                            {{ $food->name }}
                                        </a>

                                        <a href="" class="border-2 border-gray-400 rounded-3xl py-2 px-4 text-xs font-poppins hover:bg-black hover:text-white transition">
                                            <i class="fa-solid fa-location-dot text-customYellow mr-2"></i>See Location
                                        </a>
                                    </div>
                                    <p class="text-gray-600 text-base">Restaurant: {{$food->restaurant->name}}</p>
                                    <p class="text-gray-500 text-sm">{{$food->foodType->name}}, {{$food->cuisineType->name}}</p>
                                    {{-- Display the average rating as stars --}}
                                    @php
                                        $userRatingValue = round($food->rating);
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
                                        <p class="ml-2 text-lightgray font-normal text-xs">({{ $food->reviews->count() }} Reviews)</p>
                                    </div>

                                    <p class="font-medium">Rs. {{$food->price}}</p>
                                    <p class="text-gray-600 text-sm mt-2">{{$food->review}}</p>
                                    <a href="{{route('food.details', $food->id)}}" class="font-medium text-sm underline hover:text-gray-600">See More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Suggested For You (Top Foodies Section) -->
            <div class="w-1/4">
                <div class="bg-white">
                    <h2 class="text-base font-medium text-darkPurple mb-4">Foodies You Might Like</h2>
                    <div class="space-y-4">
                        @foreach($topFoodies as $user)
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('uploads/profile-images/' . $user->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover">
                                <div class="w-full">
                                    {{-- <a href="{{ route('otherProfile', ['id' => $user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{ $user->full_name }}</a> --}}
                                    <div class="flex items-center justify-between relative">
                                        <a href="{{ route('otherProfile', ['id' => $user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{$user->full_name}}</a>
                                        <div>
                                            <form method="POST" action="{{route('users.follow', $user->id)}}">
                                                @csrf
                                                <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                                    Follow
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-gray-500 text-xs">{{ $user->username }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>