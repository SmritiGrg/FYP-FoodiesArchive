{{-- <span class="hover:bg-gray-200 rounded-xl">
    <i class="ri-thumb-up-line text-gray-600 text-base cursor-pointer not-helpful hover:text-gray-500 {{ $review->helpfuls->where('user_id', auth()->id())->count() > 0 ? 'hidden' : '' }}"
        data-review-id="{{ $review->id }}" title="Helpful?"></i>
    <i class="ri-thumb-up-fill text-textBlack text-base cursor-pointer helpful {{ $review->helpfuls->where('user_id', auth()->id())->count() > 0 ? 'active' : 'hidden' }}"
        data-review-id="{{ $review->id }}" title="Remove"></i>
    <span class="pr-2 text-gray-600 text-base helpful-count">{{ $review->helpfuls->count() }}</span>
</span> --}}

<span class="hover:bg-gray-200 rounded-xl cursor-pointer">
    @php
        $userHasMarkedHelpful = $review->helpfuls->contains('user_id', auth()->id());
    @endphp

    <i class="ri-thumb-up-line text-gray-600 pl-2 text-base not-helpful hover:text-gray-500 {{ $userHasMarkedHelpful ? 'hidden' : '' }}"
        data-review-id="{{ $review->id }}" title="Helpful?"></i>

    <i class="ri-thumb-up-fill text-textBlack pl-2 text-base helpful {{ $userHasMarkedHelpful ? 'active' : 'hidden' }}"
        data-review-id="{{ $review->id }}" title="Remove"></i>

    <span class="pr-3 text-gray-600 text-base helpful-count">{{ $review->helpfuls->count() }}</span>
</span>
