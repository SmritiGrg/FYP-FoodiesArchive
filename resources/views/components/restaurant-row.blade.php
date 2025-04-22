@props(['restaurant'])
@php 
    $modalId = 'edit-modal-' . $restaurant->id;
    $viewModalId = 'view-modal-' . $restaurant->id; 
@endphp

<!-- Scoped wrapper for each peer toggle + modal -->
<div>
    <div class="grid grid-cols-12 p-4 items-center hover:bg-gray-50">
        <div class="col-span-3 text-sm">{{ $restaurant->name }}</div>
        <div class="col-span-2 text-sm">{{ $restaurant->location }}</div>
        <div class="col-span-2 text-sm">{{ $restaurant->addedByUser->full_name }}</div>
        <div class="col-span-1 text-sm">{{ $restaurant->foodPosts->count() }}</div>
        <div class="col-span-1 text-sm">{{ number_format($restaurant->avg_rating, 1) ?? 'N/A' }}</div>
        <div class="col-span-1 text-sm">{{ $restaurant->total_reviews }}</div>
        <div class="col-span-1">
            <span class="px-2 py-1 rounded text-sm
                @if($restaurant->status == 'approved') bg-green-100 text-green-800
                @elseif($restaurant->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($restaurant->status == 'rejected') bg-red-100 text-red-800
                @endif">
                {{ $restaurant->status }}
            </span>
        </div>
        <div class="col-span-1 flex space-x-2 justify-center">
            {{-- <label for="{{ $viewModalId }}" class="text-gray-600 border text-sm border-gray-300 px-3 py-1 rounded-md cursor-pointer">View</label> --}}
            <button onclick="openRestaurantViewModal({{ $restaurant->id }})" class="text-gray-600 border text-sm border-gray-300 hover:bg-gray-200 px-3 py-1 rounded-md cursor-pointer">View</button>


            <div class="relative group">
                <span class="text-textBlack text-lg font-medium hover:text-gray-500 cursor-pointer">
                    <i class="fa-solid fa-ellipsis"></i>
                </span>
                <div class="absolute w-36 top-full right-0 rounded-lg mt-1 shadow-lg text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                    <div class="hover:bg-gray-100 border-b-2 border-gray-200 flex justify-center">
                        <button onclick="openRestaurantEditModal({{ $restaurant->id }})" class="text-blue-500 px-2 py-2 text-sm font-normal">Edit</button>
                    </div>
                    <div class="hover:bg-gray-100 flex justify-center">
                        <form action="{{route('restaurant.delete', $restaurant->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-restaurant-modals :restaurant="$restaurant" />
</div>
