@php
    // Use the food post passed to the component
    $currentFood = $food ?? $similarPost ?? $post ?? $likedpost->foodPost;
@endphp
@if ($currentFood)
    <span class="text-black text-base">
        <i class="fa-regular fa-heart text-xl cursor-pointer unlike-heart {{ $currentFood->likes->where('user_id', auth()->id())->count() > 0 ? 'hidden' : '' }}"
            data-post-id="{{ $currentFood->id }}"></i>
        <i class="fa-solid fa-heart text-xl cursor-pointer like-heart text-red-500 {{ $currentFood->likes->where('user_id', auth()->id())->count() > 0 ? 'active' : 'hidden' }}"
            data-post-id="{{ $currentFood->id }}"></i>
        <span class="like-count">{{ $currentFood->likes->count() }}</span>
    </span>
@endif
