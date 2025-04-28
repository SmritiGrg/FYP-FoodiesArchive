@extends('admin.inc.main')
@section('container')
    <main class="w-[calc(100%-260px)] ml-64 bg-gray-50 min-h-screen pt-16">
        @if (session('message'))
            <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-white bg-green-500 border border-green-600 px-4 py-2 rounded-lg shadow-md w-fit z-50">
                {{ session('message') }}
            </p>
        @endif
        <div class="flex-1 px-8 py-2 bg-gray-100">
            <div class="mb-2 border-b border-gray-200">
                <p class="text-customYellow font-semibold text-2xl py-2">Cuisine Types</p>
            </div>
            <!-- Cuisine Add Form Modal -->
            <div class="w-full max-w-md mb-2">
                <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Cuisine</h3>
                <form method="POST" action="{{ route('cuisine.store') }}">
                    @csrf
                    <div class="mt-3">
                        <label for="name" class="block font-medium text-sm text-slate-600">Cuisine Name</label>
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}" :value="old('name')" autofocus  />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                    </div>
                </form>
            </div>
            <div class="bg-white rounded-md shadow">
                <!-- Header -->
                <div class="grid grid-cols-5 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4 text-center">
                    <div class="col-span-2">CUISINE TYPE NAME</div>
                    <div class="col-span-1">USED IN (POSTS)</div>
                    <div class="col-span-2">ACTIONS</div>
                </div>
                
                <!-- Rows -->
                <div class="divide-y text-sm">
                    @foreach($cuisines as $cuisine)
                        <div>
                            <div class="grid grid-cols-5 items-center hover:bg-gray-50 space-x-4 text-center">
                                <div class="col-span-2">{{ $cuisine->name }}</div>
                                <div class="col-span-1">{{ $cuisine->food_posts_count }}</div>
                                <div class="col-span-2 flex justify-center">
                                    <button onclick="openCuisineEditModal({{ $cuisine->id }})" class="text-blue-500">Edit</button>                                        
                                    <form action="{{route('cuisine.delete', $cuisine->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <div>
                                <!-- Edit Modal -->
                                <div id="edit-modal-{{ $cuisine->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <!-- Close Button -->
                                        <button onclick="closeCuisineEditModal({{ $cuisine->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>                                        
                                        <h2 class="text-xl font-bold mb-4">Edit Cuisine</h2>
                                        <form action="{{route('cuisine.update', $cuisine->id)}}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="cuisine_id" value="{{ $cuisine->id }}">
                                            <div>
                                                <label for="name" class="block font-medium text-sm text-slate-600">Cuisine Type Name</label>
                                                <x-text-input id="name" name="cuisine_name" type="text" class="mt-1 block w-full" :value="old('cuisine_name', $cuisine->name)" autofocus  />
                                                <x-input-error class="mt-2" :messages="$errors->get('cuisine_name')" />
                                            </div>

                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-customYellow text-white px-4 py-2 rounded hover:bg-hovercustomYellow">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if ($errors->any())
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    // Finding the cuisine ID from the old input
                    const cuisineId = "{{ old('cuisine_id') }}";
                    if (cuisineId) {
                        const modal = document.getElementById('edit-modal-' + cuisineId);
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                        }
                    }
                });
            </script>
        @endif
@endsection
