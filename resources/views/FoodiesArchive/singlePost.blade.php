<x-app-layout>
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-green-500 border border-green-200 bg-white px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif
    @if (session('error'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-red-500 border border-red-200 bg-white px-4 py-2 rounded-lg shadow-xl w-fit z-50">
            {{ session('error') }}
        </p>
    @endif
    @if (session('delete'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-red-500 border border-red-200 bg-white px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('delete') }}
        </p>
    @endif
    
    <section class="pt-20">
        <div class="max-w-7xl mx-auto p-6">
            <a href="{{ route('food.discover', ['scroll' => session('scroll_position')]) }}" class="text-gray-700 font-medium hover:text-gray-500 hvr-icon-back">
                <i class="fa-solid fa-arrow-left-long hvr-icon"></i> Back
            </a>

            <h1 class="text-2xl font-bold mt-2">{{$food->name}}</h1>
            <p class="text-gray-600 pt-2">Restaurant: {{$food->restaurant->name}}</p>
            <p class="text-gray-500 text-sm">{{$food->cuisineType->name}}, {{$food->foodType->name}}</p>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-1 sm:gap-8 mt-4 border-b-2 border-gray-100 pb-3">
                <!-- Left Column - Image & Details -->
                <div class="col-span-2 self-start mb-3">
                    <img src="{{ asset($food->image) }}" alt="Food img" class="w-full h-auto sm:h-1/4 object-cover rounded-lg" />
                    
                    <div class="flex items-center justify-between my-2">
                        <div class="flex items-center gap-5 text-gray-600">
                            @include('components.like-button', ['food' => $food])
                            <span class="text-black text-base">
                                <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> {{ $food->reviews->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="flex items-center">
                            <img src="{{asset('uploads/profile-images/' . $food->user->image) }}" alt="" class="w-12 h-12 rounded-full object-cover mr-3">
                            <div>
                                <p class="text-base text-darkPurple">Uploaded by {{$food->user->username}}</p>
                                <a href="{{ route('otherProfile', ['id' => $food->user->id]) }}" class="text-sm text-gray-500 underline hover:text-gray-600">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Rating & Reviews (Takes 3/5 of the width) -->
                <div class="col-span-3">
                    <div class="flex items-center gap-2">
                        <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$food->tag->name}}</span>
                    </div>

                    @php
                        $userRatingValue = round($food->rating);
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

                    <p class="text-lg font-medium mt-2">Rs. {{$food->price}}</p>
                    <p class="text-gray-500 mt-2 pb-4">{{$food->review}}</p>

                    <div class="mt-4 border-t-2 border-gray-100 pb-4 pt-2">
                        <p class="text-xl text-darkPurple font-bold pb-2">Contribute</p>
                        <a href="{{ route('writeReview', ['food_id' => $food->id]) }}" class="bg-darkPurple text-white px-4 py-2 rounded-md hover:bg-lightPurple">Write a Review</a>
                        <button class="ml-2 border border-darkPurple text-darkPurple px-4 py-2 rounded-md hover:bg-darkPurple hover:text-white">Ask a Question</button>
                    </div>

                    <h3 class="mt-4 text-lg font-medium">({{$food->reviews->count()}} reviews)</h3>

                    <!-- Reviews Grid -->
                    <div class="grid grid-cols-1 gap-4 mt-3">
                        @foreach($reviewsPaginate as $review)
                            <div class="border-b-2 border-gray-100 pb-2">
                                <!-- Reviewer Info -->
                                <div class="flex w-full justify-between">
                                    <a href="{{ route('otherProfile', ['id' => $review->user->id]) }}" class="flex items-center">
                                        <img src="{{ asset('uploads/profile-images/' . $review->user->image) }}" alt="" class="w-10 h-10 rounded-full object-cover mr-3">
                                        <div class="w-full">
                                            <div class="flex justify-between">
                                                <div class="flex space-x-2 items-center">
                                                    <p class="block text-sm text-gray-900 font-medium">
                                                        {{$review->user->full_name}} 
                                                        <span class="text-xs text-gray-500 pl-2">{{ $review->created_at->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <span class="block text-sm text-gray-500">{{$review->user->username}}</span>
                                        </div>
                                    </a>
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
                            
                                <button onclick="toggleReplyForm({{ $review->id }})" class="text-xs text-gray-500 font-medium hover:text-gray-600">Reply</button>
                                
                                <!-- Star Rating -->
                                @php
                                    $userRatingValue = round($review->rating);
                                    $formattedRating = number_format($userRatingValue, 1);
                                @endphp
                                <div class="flex items-center mr-2 my-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $userRatingValue)
                                            <img src="{{ asset('assets/img/cutlery (1).png') }}" class="bg-customYellow p-1 rounded-md mr-1" style="height: 20px; width: 20px;" alt="Full">
                                        @else
                                            <img src="{{ asset('assets/img/cutlery (1).png') }}" class="bg-gray-300 p-1 rounded-md mr-1" style="height: 20px; width: 20px;" alt="Empty">
                                        @endif
                                    @endfor
                                    <p class="ml-2 text-darkPurple font-normal text-sm">{{ $formattedRating }}</p>
                                </div>

                                <!-- Review Content -->
                                <p class="text-gray-600 mt-2 text-sm">{{ $review->review }}</p>

                                <!-- Reply Form -->
                                <div id="reply-form-{{ $review->id }}" class="hidden">
                                    <form action="{{ route('review.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="food_post_id" value="{{ $review->food_post_id }}">
                                        <input type="hidden" name="parent_id" value="{{ $review->id }}"> <!-- This ensures it's a reply -->
                                        
                                        <div class="w-full px-3 mb-2 mt-6">
                                            <textarea class="bg-gray-100 rounded border border-gray-400 resize-none w-full h-20 py-2 px-3 font-normal placeholder-gray-400 focus:outline-none focus:bg-white"
                                                    name="review" placeholder="Reply to this review" {{ $errors->has('review') ? 'border-red-500' : 'border-gray-300' }}></textarea>
                                            @error('review')
                                                <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="w-full flex justify-end px-3 my-3">
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
                                    <div id="replies-{{ $review->id }}" class="hidden">
                                        @foreach ($review->replies as $reply)
                                            <div class="mb-3 ml-6 lg:ml-12 text-base bg-white">
                                                <div class="flex justify-between items-center mb-2">
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
                                                            <div class="absolute w-32 top-full right-0 rounded-lg mt-1 shadow-lg p-1 text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white">
                                                                <div class="hover:bg-gray-100 flex justify-center">
                                                                    <form action="{{ route('review.delete', $reply->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
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
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $reviewsPaginate->links() }}
                    </div>
                </div>
            </div>

            <!-- Location Section -->
            <div class="mt-2">
                <h3 class="text-xl font-semibold">Location</h3>
                <p class="text-gray-600 text-sm"><i class="fa-solid fa-location-dot pr-1"></i> Street no 18, Pokhara 33700</p>
                <div class="w-full h-96 bg-gray-300 mt-2 rounded-md">
                    <iframe class="w-full h-full object-cover rounded-md" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d219.73573546818173!2d83.95905542858723!3d28.21424598805742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39959558ac66c7af%3A0x963bdee9ff7501dd!2sKafe%C3%AC%20Joy%20(Cafe)!5e0!3m2!1sen!2snp!4v1741682197379!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- YOU MAY ALSO LIKE --}}
    <section class="py-7">
        <p class="border-t-2 border-gray-100 pt-4 font-bold text-2xl pl-24">You May Also Like</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-1 mt-3 px-4 sm:px-8 lg:px-20">
            @if(isset($similarPosts) && $similarPosts->isNotEmpty())
                @foreach($similarPosts as $similarPost)
                    <div class="bg-white">
                        <div class="flex justify-between items-center p-4">
                            <div class="flex items-center">
                                <a href="">
                                    <img src="{{asset('uploads/profile-images/'. $similarPost->user->image)}}" alt="img" class="w-10 h-10 rounded-full object-cover object-center hover:opacity-80 transition-opacity duration-300" />
                                </a>
                                <div class="ml-3 relative group">
                                    <a href="{{ route('otherProfile', ['id' => $similarPost->user->id]) }}" class="font-medium text-sm hover:text-gray-500">{{$similarPost->user->full_name}}</a>
                                    <!-- Modal -->
                                    <div class="absolute hidden group-hover:block w-60 p-4 bg-white shadow-lg rounded-lg z-10 border border-gray-200">
                                        <div class="flex items-center space-x-4">
                                            <img src="{{asset('uploads/profile-images/' . $similarPost->user->image)}}" alt="img" class="w-12 h-12 rounded-full object-cover">
                                            <div>
                                                <a href="" class="font-medium text-sm font-poppins">{{$similarPost->user->full_name}}</a>
                                                <p class="text-gray-500 text-xs font-poppins">{{$similarPost->user->username}}</p>
                                                <p class="border border-gray-300 rounded-full text-sm w-16 pl-2 mt-2"><i class="fa-solid fa-fire-flame-curved text-red-400"></i> {{$similarPost->user->total_streak_points}}</p>
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
                            @php
                                $authUser = auth()->user();
                                $isFollowing = $authUser && isset($similarPost->user) ? $authUser->isFollowing($similarPost->user->id) : false;
                            @endphp

                            @if (!$authUser)
                                {{-- If the user is not logged in, show the Follow button --}}
                                <form method="POST" action="{{route('users.follow', $similarPost->user->id)}}" class="flex space-x-1 items-center">
                                    @csrf
                                    <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                        Follow
                                    </button>
                                </form>
                            @else
                                {{-- If logged in, check if they are following --}}
                                @if ($isFollowing)
                                    <form method="POST" action="{{route('users.unfollow', $similarPost->user->id)}}" class="flex space-x-1 items-center">
                                        @csrf
                                        <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                            Unfollow
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{route('users.follow', $similarPost->user->id)}}" class="flex space-x-1 items-center">
                                        @csrf
                                        <button class="text-sm font-medium text-customYellow hover:text-hovercustomYellow">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        <div class="px-4">
                            <img src="{{ asset( $similarPost->image) }}" alt="Food Img" class="w-full h-72 object-cover object-center rounded-xl"/>
                            <div class="mt-2">
                                <div class="flex justify-between items-center mt-2 mb-2">
                                    <div class="flex items-center space-x-4">
                                        @include('components.like-button', ['food' => $similarPost])
                                        <span class="text-black text-base">
                                            <i class="fa-regular fa-comment text-lg hover:text-gray-500 cursor-pointer"></i> {{$similarPost->reviews->count()}}
                                        </span>
                                    </div>
                                    <i class="not-bookmarked fa-regular fa-bookmark text-lg hover:text-gray-500 cursor-pointer"></i>
                                    <i class="bookmarked fa-solid fa-bookmark text-lg text-black hidden cursor-pointer"></i>
                                </div>
                                <span class="bg-green-100 text-green-700 text-xs font-medium py-1 px-2 rounded">{{$similarPost->tag->name}}</span>
                                <div class="flex justify-between items-center mt-2">
                                    <a href="" class="text-base font-semibold hover:text-gray-600">{{$similarPost->name}}</a>
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
</x-app-layout>