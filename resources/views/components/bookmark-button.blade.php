@php
    // Determine the current food post
    $currentFood = $food ?? $similarPost ?? $post ?? $likedpost->foodPost;
    $isBookmarked = $currentFood && $currentFood->bookmarkedByUsers->contains(auth()->id());
@endphp

@if ($currentFood)
    <span class="text-black text-base">
        <!-- Unbookmarked Icon -->
        <i class="fa-regular fa-bookmark text-xl cursor-pointer not-bookmarked hover:text-gray-500 {{ $isBookmarked ? 'hidden' : '' }}"
            data-post-id="{{ $currentFood->id }}" title="Bookmark"></i>

        <!-- Bookmarked Icon -->
        <i class="fa-solid fa-bookmark text-xl cursor-pointer bookmarked text-black {{ $isBookmarked ? 'active' : 'hidden' }}"
            data-post-id="{{ $currentFood->id }}" title="Remove"></i>

    </span>
@endif