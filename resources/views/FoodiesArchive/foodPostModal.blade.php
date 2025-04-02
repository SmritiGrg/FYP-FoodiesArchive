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
                    <div class="flex justify-between items-center pb-3 border-b-2 sticky top-0 z-10">
                        <div class="flex items-center">
                            <a href="">
                                <img src="{{ asset('uploads/profile-images/' . Auth::user()->image) }}" alt="img" class="w-10 h-10 rounded-full object-cover" />
                            </a>
                            <div class="ml-3">
                                <a href="" class="font-medium text-sm hover:text-gray-500">{{Auth::user()->full_name}}</a>
                                <p class="text-gray-500 text-xs">{{$post->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        
                        {{-- THREE BUTTON EDIT DELETE --}}
                        <div class="relative group">
                            <span class="text-textBlack text-lg font-medium hover:text-gray-500 cursor-pointer"><i class="fa-solid fa-ellipsis"></i></span>
                            <div class="absolute w-36 top-full right-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                <div class="hover:bg-gray-100 border-b-2 border-gray-200 flex justify-center">
                                    <a href="" class="block text-sm font-normal text-textBlack px-2 py-2">Edit</a>
                                </div>
                                <div class="hover:bg-gray-100 flex justify-center">
                                    <form action="{{ route('foodpost.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow overflow-auto scrollable-content pt-1">
                        <h2 class="text-xl font-medium mb-1">{{$post->name}}</h2>
                        <p class="text-gray-700 text-sm">Restaurant: {{$post->restaurant->name}}</p>
                        <p class="text-gray-700 pb-3 text-sm">{{$post->foodType->name}}, {{$post->cuisineType->name}}</p>
                        <p class="bg-green-100 text-green-700 text-xs font-medium py-1 px-3 mb-4 rounded w-fit">{{$post->tag->name}}</p>

                        @php
                            $userRatingValue = round($post->rating);
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
                        <p class="font-medium text-lg mb-2">Rs. {{$post->price}}</p>
                        <p class="text-gray-700 pb-6 border-b-2 border-b-gray-100">
                            {{$post->review}}
                        </p>
                        <div class="flex flex-col space-y-6 w-full pt-3">
                            @foreach($post->reviews as $review)
                                <div class="flex w-full justify-between">
                                    <div class="flex">
                                        <a href="">
                                            <img src="{{ asset('uploads/profile-images/' . $review->user->image) }}" alt="img" class="w-8 h-8 rounded-full object-cover" />
                                        </a>
                                        <div class="ml-3">
                                            <div class="flex items-center justify-between">
                                                <a href="{{ route('otherProfile', ['id' => $review->user->id]) }}" class="font-normal text-xs hover:text-gray-500">{{$review->user->full_name}}</a>
                                            </div>
                                            <p class="text-gray-500 text-xs">{{$post->created_at->diffForHumans()}}</p>
                                            <button onclick="toggleReplyForm({{ $review->id }})" class="text-xs text-gray-500 font-medium hover:text-gray-600">Reply</button>
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
                                            <!-- Reply Form -->
                                            <div id="reply-form-{{ $review->id }}" class="hidden">
                                                <form action="{{ route('review.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="food_post_id" value="{{ $review->food_post_id }}">
                                                    <input type="hidden" name="parent_id" value="{{ $review->id }}"> <!-- This ensures it's a reply -->
                                                    
                                                    <div class="w-full mb-2 mt-2">
                                                        <textarea class="bg-gray-100 rounded text-sm border border-gray-400 resize-none w-full h-20 py-2 px-3 font-normal placeholder-gray-400 focus:outline-none focus:bg-white"
                                                                name="review" placeholder="Reply to this review" {{ $errors->has('review') ? 'border-red-500' : 'border-gray-300' }}></textarea>
                                                        @error('review')
                                                            <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="w-full flex justify-end px-3">
                                                        <button type="submit" class="py-1 px-5 bg-customYellow text-black text-sm font-medium rounded-md hover:bg-hovercustomYellow">
                                                            Post
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Checking if there are replies -->
                                            @if ($review->replies->count() > 0)
                                                <!-- Toggle Replies Button -->
                                                <div class="flex items-center my-2">
                                                    <hr class="w-10 border-gray-400">
                                                    <button id="toggle-replies-btn-{{ $review->id }}" onclick="toggleReplies({{ $review->id }})" class="text-sm text-gray-500 font-normal px-2 mt-2">
                                                        SHOW REPLIES ({{ $review->replies->count() }})
                                                    </button>
                                                </div>

                                                <!-- Replies Section -->
                                                <div id="replies-{{ $review->id }}" class="hidden w-full">
                                                    @foreach ($review->replies as $reply)
                                                        <div class="mb-3 ml-6 lg:ml-12 text-base bg-white w-full">
                                                            <div class="flex justify-between items-center mb-2 w-full">
                                                                <div class="flex items-center">
                                                                    <a href="{{ route('otherProfile', ['id' => $reply->user->id]) }}" class="flex items-center">
                                                                        <img class="mr-2 w-10 h-10 rounded-full object-cover" 
                                                                            src="{{ asset('uploads/profile-images/' . $reply->user->image) }}" >
                                                                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 font-medium">
                                                                            {{ $reply->user->full_name }}
                                                                        </p>
                                                                    </a>
                                                                    <p class="text-xs text-gray-600">
                                                                        <time datetime="{{ $reply->created_at }}">
                                                                            {{ $reply->created_at->diffForHumans() }}
                                                                        </time>
                                                                    </p>
                                                                </div>
                                                                @if (Auth::id() === $reply->user->id)
                                                                    <div class="relative group">
                                                                        <span class="text-gray-600 text-lg font-medium hover:text-gray-500 cursor-pointer">
                                                                            <i class="fa-solid fa-ellipsis"></i>
                                                                        </span>
                                                                        <div class="absolute w-28 top-full right-0 rounded-lg mt-1 shadow-lg p-1 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                                                            <div class="hover:bg-gray-100 flex justify-center">
                                                                                <form action="{{ route('review.delete', $reply->id) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="block text-xs font-normal text-red-500 px-2 py-1">Delete</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <p class="text-gray-600 mt-2 text-sm">{{ $reply->review }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- HELPFUL BUTTON AND THREE BUTTON  --}}
                                    <div class="flex space-x-2">
                                        <div>
                                            @include('components.helpful-button', ['review' => $review])
                                        </div>
                                        @if (Auth::id() === $review->user->id)
                                            <div class="relative group">
                                                <span class="text-gray-600 text-lg font-medium hover:text-gray-500 cursor-pointer">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </span>
                                                <div class="absolute w-32 top-full right-0 rounded-lg mt-1 shadow-lg p-1 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                                    <div class="hover:bg-gray-100 flex justify-center">
                                                        <form action="{{ route('review.delete', $review->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-auto border-t flex items-center justify-between sticky bottom-0 z-10">
                        <div class="flex items-center space-x-4 my-2">
                            @include('components.like-button', ['food' => $post])

                            <span class="text-black text-base">
                                <i class="fa-regular fa-comment text-xl hover:text-gray-500 cursor-pointer"></i> {{$post->reviews->count()}}
                            </span>
                        </div>
                        @include('components.bookmark-button', ['food' => $post])
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

<script>
    function toggleReplies(reviewId) {
        const repliesSection = document.getElementById(`replies-${reviewId}`);
        const toggleButton = document.getElementById(`toggle-replies-btn-${reviewId}`);

        if (repliesSection.classList.contains("hidden")) {
            // Show replies
            repliesSection.classList.remove("hidden");
            toggleButton.innerText = `HIDE REPLIES`;
        } else {
            // Hide replies
            repliesSection.classList.add("hidden");
            toggleButton.innerText = `SHOW REPLIES (${repliesSection.children.length})`;
        }
    }

    function toggleReplyForm(reviewId) {
        const replyForm = document.getElementById(`reply-form-${reviewId}`);
        
        // Toggle visibility of the reply form
        if (replyForm.classList.contains("hidden")) {
            replyForm.classList.remove("hidden");
        } else {
            replyForm.classList.add("hidden");
        }
    }
</script>