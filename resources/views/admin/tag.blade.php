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
                        <select class="border border-gray-300 rounded-md h-9 px-3 text-sm">
                            <option value="all">All Locations</option>
                            <option value="kathmandu">Kathmandu</option>
                            <option value="lalitpur">Lalitpur</option>
                            <option value="bhaktapur">Bhaktapur</option>
                            <option value="pokhara">Pokhara</option>
                        </select>
                    </div>
                </div>
                <button type="button" onclick="openTagModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                    + Add Tag
                </button>
            </div>
        </div>
        <div class="mb-4 pb-4 border-b border-gray-200">
            <p class="text-customYellow font-semibold text-2xl">Tags</p>
        </div>

        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-8 p-4 bg-gray-100 text-sm font-medium text-center">
                <div class="col-span-3">Tag Name</div>
                <div class="col-span-3">Used In (Posts)</div>
                <div class="col-span-2">Actions</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm">
                @foreach($tags as $tag)
                    @php 
                        $modalId = 'edit-modal-' . $tag->id;
                    @endphp
                    <!-- Scoped wrapper for each peer toggle + modal -->
                    <div>
                        <div class="grid grid-cols-8 items-center hover:bg-gray-50 text-center">
                            <div class="col-span-3 font-base">{{ $tag->name }}</div>
                            <div class="col-span-3 font-base">{{ $tag->foodPosts->count() }}</div>
                            <div class="col-span-2 flex space-x-2 text-center justify-center">
                                <div class="flex justify-center">
                                    <label for="{{ $modalId }}" class="block text-sm font-normal text-blue-400 px-2 py-2 cursor-pointer">Edit</label>
                                </div>
                                <div class="flex justify-center">
                                    <form action="{{route('tag.delete', $tag->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                    </form>
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
                                    <h2 class="text-xl font-bold mb-4">Edit Tag</h2>
                                    <form action="{{route('tag.update', $tag->id)}}" method="POST" class="mt-6 space-y-6">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="name" class="block font-medium text-sm text-slate-600">Tag Name</label>
                                            <x-text-input id="name" name="tag_name" type="text" class="mt-1 block w-full" :value="old('tag_name', $tag->name)" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('tag_name')" />
                                        </div>

                                        <div>
                                            <label for="description" class="block font-medium text-sm text-slate-600">Used In (Post)</label>
                                            <textarea id="description" class="rounded text-sm border text-slate-400 resize-none w-full h-20 py-2 px-3 font-normal focus:outline-none border-gray-300 focus:border-indigo-300 focus:ring-indigo-300"
                                                                name="tag_description" {{ $errors->has('tag_description') ? 'border-red-500' : 'border-gray-300' }}>{{ old('tag_description', $tag->description) }}</textarea>
                                            <x-input-error class="mt-2" :messages="$errors->get('tag_description')" />
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
        <div class="mt-4">
            {{ $tags->links() }}
        </div>
    </div>

    <!-- Tag Add Form Modal -->
    <div id="tagModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Tag</h3>
            <form method="POST" action="{{ route('tag.store') }}">
                @csrf

                <div class="mt-4">
                    <x-input-label for="name" value="Tag Name" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :error="$errors->has('name')" :value="old('name')" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                </div>
            </form>
            <!-- Close button (X) -->
            <button onclick="closeTagModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endsection

