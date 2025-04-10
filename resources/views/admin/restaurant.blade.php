@extends('admin.inc.main')
@section('container')
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-white bg-green-500 border border-green-600 px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif
    <div class="flex-1 p-8 bg-gray-100">
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col md:flex-row gap-4 md:items-center">
                <div class="relative">
                    <input type="text" placeholder="Search restaurants..." class="pl-9 w-full md:w-[300px] border border-gray-300 rounded-md py-2 px-3" />
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                </div>
                <div class="flex items-center gap-2">
                    <button class="flex items-center border border-gray-300 px-4 py-2 text-sm rounded-md hover:bg-gray-200">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 4a1 1 0 0 1 1-1h1.3a1 1 0 0 1 .97.757L7.6 6H20a1 1 0 0 1 0 2H7.1a1 1 0 0 1-.97-.757L4.3 3H4a1 1 0 0 1-1-1ZM6 10a1 1 0 0 1 1-1h13a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm1 4a1 1 0 0 0 0 2h10a1 1 0 1 0 0-2H7Z"></path></svg>
                        Filter
                    </button>
                    <select class="border border-gray-300 rounded-md h-9 px-3 text-sm">
                        <option value="all">All Status</option>
                        <option value="approved">Approved</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option> 
                    </select>
                    <select class="border border-gray-300 rounded-md h-9 px-3 text-sm">
                        <option value="all">All Locations</option>
                        <option value="kathmandu">Kathmandu</option>
                        <option value="lalitpur">Lalitpur</option>
                        <option value="bhaktapur">Bhaktapur</option>
                        <option value="pokhara">Pokhara</option>
                    </select>
                </div>
            </div>
            <button type="button" onclick="openModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                + Add Restaurant
            </button>
            </div>
        </div>

        <div class="mb-4 border-b border-gray-200">
            <p class="text-customYellow font-semibold text-base">Restaurants</p>
        </div>

        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-12 p-4 bg-gray-100 text-sm font-medium">
                <div class="col-span-3">Restaurant Name</div>
                <div class="col-span-2">Location</div>
                <div class="col-span-2">Submitted By</div>
                <div class="col-span-2">Food Post</div>
                <div class="col-span-1">Status</div>
                <div class="col-span-2">Actions</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm">
                @foreach($restaurants as $restaurant)
                    @php 
                        $modalId = 'edit-modal-' . $restaurant->id;
                        $viewModalId = 'view-modal-' . $restaurant->id; 
                    @endphp

                    <!-- Scoped wrapper for each peer toggle + modal -->
                    <div>
                        <div class="grid grid-cols-12 p-4 items-center hover:bg-gray-50">
                            <div class="col-span-3 font-medium">{{ $restaurant->name }}</div>
                            <div class="col-span-2">{{ $restaurant->location }}</div>
                            <div class="col-span-2">{{ $restaurant->addedByUser->full_name }}</div>
                            <div class="col-span-2">{{ $restaurant->foodPosts->count() }}</div>
                            <div class="col-span-1">
                                <span class="px-2 py-1 rounded
                                    @if($restaurant->status == 'approved') bg-green-100 text-green-800
                                    @elseif($restaurant->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($restaurant->status == 'rejected') bg-red-100 text-red-800
                                    @endif">
                                    {{ $restaurant->status }}
                                </span>
                            </div>
                            <div class="col-span-2 flex space-x-2">
                                <label for="{{ $viewModalId }}" class="text-gray-600 border border-gray-300 px-3 py-1 rounded-md cursor-pointer">View</label>

                                <div class="relative group">
                                    <span class="text-textBlack text-lg font-medium hover:text-gray-500 cursor-pointer">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </span>
                                    <div class="absolute w-36 top-full right-0 rounded-lg mt-1 shadow-lg text-start scale-y-0 border-gray-200 group-hover:scale-y-100 origin-top duration-200 bg-white z-50">
                                        <div class="hover:bg-gray-100 border-b-2 border-gray-200 flex justify-center">
                                            <label for="{{ $modalId }}" class="block text-sm font-normal text-textBlack px-2 py-2 cursor-pointer">Edit</label>
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

                        <div>
                            <!-- Hidden Checkbox to Toggle Modal -->
                            <input type="checkbox" id="{{ $modalId }}" class="hidden peer" />

                            <!-- Edit Modal -->
                            <div class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden peer-checked:flex">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                    <!-- Close Button -->
                                    <label for="{{ $modalId }}" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl cursor-pointer"><i class="fa-solid fa-xmark"></i></label>
                                    <h2 class="text-xl font-bold mb-4">Edit Restaurant</h2>
                                    <form action="{{route('restaurant.update', $restaurant->id)}}" method="POST" class="mt-6 space-y-6">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="name" class="block font-medium text-sm text-slate-600">Restaurant Name</label>
                                            <x-text-input id="name" name="rest_name" type="text" class="mt-1 block w-full" :value="old('rest_name', $restaurant->name)" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('rest_name')" />
                                        </div>

                                        <div>
                                            <label for="location" class="block font-medium text-sm text-slate-600">Location</label>
                                            <x-text-input id="location" name="rest_location" type="text" class="mt-1 block w-full" :value="old('rest_location', $restaurant->location)" autofocus />
                                            <x-input-error class="mt-2" :messages="$errors->get('rest_location')" />
                                        </div>

                                        <div>
                                            <label for="latitude" class="block font-medium text-sm text-slate-600">Latitude</label>
                                            <x-text-input id="latitude" name="rest_latitude" type="text" class="mt-1 block w-full" :value="old('rest_latitude', $restaurant->latitude)" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('rest_latitude')" />
                                        </div>

                                        <div>
                                            <label for="longitude" class="block font-medium text-sm text-slate-600">Longitude</label>
                                            <x-text-input id="longitude" name="rest_longitude" type="text" class="mt-1 block w-full" :value="old('rest_longitude', $restaurant->longitude)" autofocus />
                                            <x-input-error class="mt-2" :messages="$errors->get('rest_vlongitude')" />
                                        </div>

                                        {{-- Hidden field to submit correct user ID --}}
                                        <input type="hidden" name="added_by_user_id" value="{{ $restaurant->added_by_user_id }}">

                                        {{-- Readonly field just to display user’s name --}}
                                        <div>
                                            <label for="added_by_user_id_display" class="block font-medium text-sm text-slate-600">Added by</label>
                                            <x-text-input id="added_by_user_id_display" type="text"
                                                :value="$restaurant->addedByUser->full_name" readonly class="mt-1 block w-full" />
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
                                            <label for="{{ $modalId }}" class="mr-2 px-4 py-2 border rounded text-gray-700 cursor-pointer">Cancel</label>
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div>
                            <!-- View Modal Checkbox -->
                            <input type="checkbox" id="{{ $viewModalId }}" class="hidden peer" />
                            <!-- View Modal -->
                            <div class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden peer-checked:flex">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 overflow-y-auto max-h-[90vh] relative">
                                    <!-- Close Button -->
                                    <label for="{{ $viewModalId }}" class="absolute top-2 right-4 text-gray-500 hover:text-black text-2xl cursor-pointer"><i class="fa-solid fa-xmark"></i></label>
                                    <div class="mb-6">
                                        <h2 class="text-2xl font-bold">Restaurant Validation</h2>
                                        <p class="text-sm text-gray-500">Review and validate the restaurant details before approval.</p>
                                    </div>

                                    <div class="grid gap-6 pt-4">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div class="md:col-span-2 space-y-4">
                                                <div>
                                                    <h3 class="text-lg font-semibold">{{$restaurant->name}}</h3>
                                                    <p class="text-sm text-gray-500 flex items-center">
                                                        <i class="fa-solid fa-location-dot pr-1"></i>
                                                        {{$restaurant->location}}
                                                    </p>
                                                </div>

                                                <div class="grid grid-cols-2 gap-4 text-sm">
                                                    <div>
                                                        <p class="font-medium">Submitted By</p>
                                                        <p>{{$restaurant->addedByUser->full_name}}</p>
                                                        <p class="text-xs text-gray-500">{{$restaurant->addedByUser->email}}</p>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium">Submission Date</p>
                                                        <p>{{ $restaurant->created_at->format('m/d/Y') }}</p>
                                                        <p class="text-xs text-gray-500">{{ $restaurant->created_at->format('h:i A') }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-4">
                                                <div class="rounded-md overflow-hidden border h-[200px] bg-gray-100 flex items-center justify-center">
                                                    <div class="text-center p-4">
                                                    <!-- Globe icon -->
                                                    <svg class="h-8 w-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path d="M..." />
                                                    </svg>
                                                    <p class="text-xs text-gray-500">Map Preview</p>
                                                    </div>
                                                </div>

                                                <div class="text-sm">
                                                    <p class="font-medium">Coordinates</p>
                                                    <p>Lat: 27.7172</p>
                                                    <p>Lng: 85.3240</p>
                                                </div>

                                                <button class="w-full text-sm border rounded-md py-2 flex items-center justify-center gap-2 hover:bg-gray-100">
                                                    <!-- MapPin icon -->
                                                    <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M..." />
                                                    </svg>
                                                    View on Map
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-2 mt-6">
                                        <button class="sm:flex-1 border border-red-200 text-red-500 py-2 rounded-md hover:bg-red-50 flex items-center justify-center gap-2">
                                            Reject
                                        </button>
                                        <button class="sm:flex-1 bg-green-600 text-white py-2 rounded-md hover:bg-green-700 flex items-center justify-center gap-2">
                                            Approve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4">
            {{ $restaurants->links() }}
        </div>
    </div>

    <!-- Restaurant Add Form Modal -->
    <div id="restaurantModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Restaurant</h3>
            <form method="POST" action="{{ route('restaurant.store') }}">
                @csrf
                <input type="hidden" name="added_by_user_id" value="{{ auth()->id() }}">

                <div class="mt-4">
                    <x-input-label for="rest_name" value="Restaurant Name" />
                    <x-text-input id="rest_name" class="block mt-1 w-full" type="text" name="name"
                        :error="$errors->has('name')" :value="old('name')" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="location" value="Location" />
                    <input id="location" class="block mt-1 w-full text-slate-400 bg-white border rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300' }}"
                        type="text" name="location" placeholder="Eg: Pokhara, Nepal"
                        value="{{ old('location') }}" autofocus>
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="latitude" value="Latitude" />
                    <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude"
                        :error="$errors->has('latitude')" :value="old('latitude')" autofocus />
                    <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="longitude" value="Longitude" />
                    <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude"
                        :error="$errors->has('longitude')" :value="old('longitude')" autofocus />
                    <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="status" value="Status" />
                    <select name="status" id="status" class="mt-1 block w-full text-slate-400 bg-white border rounded-md shadow-sm">
                        <option value="approved">approved</option>
                        <option value="pending">pending</option>
                        <option value="rejected">rejected</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                </div>
            </form>
            <!-- Close button (X) -->
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
</main>
{{-- END MAIN --}}
@endsection
