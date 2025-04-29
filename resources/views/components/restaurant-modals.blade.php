@props(['restaurant'])

<!-- View Modal -->
<div id="view-modal-{{ $restaurant->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh] relative">
        <button onclick="closeRestaurantViewModal({{ $restaurant->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="mb-6">
            <h2 class="text-2xl font-bold">Restaurant Validation</h2>
            <p class="text-sm text-gray-500">Review and validate the restaurant details before approval.</p>
        </div>
        <div class="grid gap-6 pt-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $restaurant->name }}</h3>
                        <p class="text-sm text-gray-500 flex items-center">
                            <i class="fa-solid fa-location-dot pr-1"></i>{{ $restaurant->location }}
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="font-medium">Submitted By</p>
                            <p>{{ $restaurant->addedByUser->full_name }}</p>
                            <p class="text-xs text-gray-500">{{ $restaurant->addedByUser->email }}</p>
                        </div>
                        <div>
                            <p class="font-medium">Submission Date</p>
                            <p>{{ $restaurant->created_at->format('m/d/Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $restaurant->created_at->format('h:i A') }}</p>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="space-y-4">
                <div class="rounded-md overflow-hidden border h-[200px] bg-gray-100 flex items-center justify-center">
                    <div class="text-center p-4 w-full">
                        @if(!empty($restaurant->map_embed_url))
                            <iframe
                                src="{{ $restaurant->map_embed_url }}"
                                width="100%"
                                height="200"
                                style="border: 0; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"
                                loading="lazy"
                                allowfullscreen
                                aria-label="Map location for {{ $restaurant->name }}"
                                title="Map location of {{ $restaurant->name }}"
                                referrerpolicy="no-referrer-when-downgrade"
                                class="transition-all duration-300 ease-in-out hover:scale-[1.01]"></iframe>
                        @else
                            <p class="text-gray-500 text-sm">Map not available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="flex sm:flex-row gap-2 mt-6">
            <label onclick="closeRestaurantViewModal({{ $restaurant->id }})" class="flex-1 border border-red-200 text-red-500 py-2 rounded-md hover:bg-red-50 flex items-center justify-center cursor-pointer">
                Cancel
            </label>
            <form method="POST" action="{{ route('restaurant.approve', $restaurant->id) }}" class="flex-1">
                @csrf
                @method('PATCH')
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                    Approve
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="edit-modal-{{ $restaurant->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <button onclick="closeRestaurantEditModal({{ $restaurant->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h2 class="text-xl font-bold mb-4">Edit Restaurant</h2>
        <form action="{{ route('restaurant.update', $restaurant->id) }}" method="POST" class="mt-6 space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="block font-medium text-sm text-slate-600">Restaurant Name</label>
                <x-text-input id="name" name="rest_name" type="text" class="mt-1 block w-full" :value="old('rest_name', $restaurant->name)" autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('rest_name')" />
            </div>
            <div>
                <label for="location" class="block font-medium text-sm text-slate-600">Location</label>
                <x-text-input id="location" name="rest_location" type="text" class="mt-1 block w-full" :value="old('rest_location', $restaurant->location)" autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('rest_location')" />
            </div>
            <div>
                <label for="map_embed_url" class="block font-medium text-sm text-slate-600">Google Map Embed URL:</label>
                <x-text-input id="map_embed_url" name="map_embed_url" type="text" class="mt-1 block w-full" :value="old('map_embed_url', $restaurant->map_embed_url)" autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('map_embed_url')" />
            </div>
            <input type="hidden" name="added_by_user_id" value="{{ $restaurant->added_by_user_id }}">
            <div>
                <label for="added_by_user_id_display" class="block font-medium text-sm text-slate-600">Added by</label>
                <x-text-input id="added_by_user_id_display" type="text" :value="$restaurant->addedByUser->full_name" readonly class="mt-1 block w-full" />
            </div>
            <div>
                <label for="status" class="block font-medium text-sm text-slate-600">Status</label>
                <select name="rest_status" id="status" class="mt-1 block w-full text-slate-400 bg-white border rounded-md shadow-sm">
                    <option value="approved" {{ old('rest_status', $restaurant->status) == 'approved' ? 'selected' : '' }}>approved</option>
                    <option value="pending" {{ old('rest_status', $restaurant->status) == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="rejected" {{ old('rest_status', $restaurant->status) == 'rejected' ? 'selected' : '' }}>rejected</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>
            <div class="flex justify-end">
                <label onclick="closeRestaurantEditModal({{ $restaurant->id }})" class="mr-2 px-4 py-2 border rounded text-gray-700 cursor-pointer">Cancel</label>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
            </div>
        </form>
    </div>
</div>
