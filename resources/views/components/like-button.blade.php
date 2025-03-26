<span class="text-black text-base">
    <i class="fa-regular fa-heart text-xl cursor-pointer unlike-heart {{ $food->likes->where('user_id', auth()->id())->count() > 0 ? 'hidden' : '' }}"
        data-post-id="{{ $food->id }}"></i>
    <i class="fa-solid fa-heart text-xl cursor-pointer like-heart text-red-500 {{ $food->likes->where('user_id', auth()->id())->count() > 0 ? 'active' : 'hidden' }}"
        data-post-id="{{ $food->id }}"></i>
    <span class="like-count">{{ $food->likes->count() }}</span>
</span>
