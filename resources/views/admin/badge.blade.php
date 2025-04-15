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
                <button type="button" onclick="openBadgeModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                    + Add Badge
                </button>
            </div>
        </div>
        <div class="mb-4 border-b border-gray-200">
            <p class="text-customYellow font-semibold text-xl p-4">Badges</p>
        </div>

        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-8 p-4 bg-gray-100 text-sm font-medium">
                <div class="col-span-1">Image</div>
                <div class="col-span-1">Badge Name</div>
                <div class="col-span-2">Description</div>
                <div class="col-span-1">Streak Criteria</div>
                <div class="col-span-1">Contribution</div>
                <div class="col-span-1">Special</div>
                <div class="col-span-1">Actions</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm">
                @foreach($badges as $badge)
                    @php 
                        $modalId = 'edit-modal-' . $badge->id;
                    @endphp
                    <!-- Scoped wrapper for each peer toggle + modal -->
                    <div>
                        <div class="grid grid-cols-8 items-center hover:bg-gray-50 text-center">
                            <div class="col-span-1 font-medium"><img src="{{asset('uploads/badge-images/'. $badge->image)}}" alt="" class="w-28 h-28"></div>
                            <div class="col-span-1 font-medium">{{ $badge->name }}</div>
                            <div class="col-span-2 font-medium">{{ $badge->description }}</div>
                            <div class="col-span-1">{{ $badge->streak_criteria }}</div>
                            <div class="col-span-1">{{ $badge->contribution_required }}</div>
                            <div class="col-span-1">{{ $badge->special_badge }}</div>
                            <div class="col-span-1 flex space-x-2">
                                {{-- <label for="{{ $viewModalId }}" class="text-gray-600 border border-gray-300 px-3 py-1 rounded-md cursor-pointer">View</label> --}}
                                <div class="flex justify-center">
                                    <label for="{{ $modalId }}" class="block text-sm font-normal text-blue-400 px-2 py-2 cursor-pointer">Edit</label>
                                </div>
                                <div class="flex justify-center">
                                    <form action="{{route('badge.delete', $badge->id)}}" method="POST">
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
                                    <h2 class="text-xl font-bold mb-4">Edit Badge</h2>
                                    <form action="{{route('badge.update', $badge->id)}}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                                        @csrf
                                        @method('PATCH')
                                        @php
                                            $inputId = 'image-' . $badge->id;
                                            $previewId = 'badgePreview-' . $badge->id;
                                        @endphp
                                        <div class="flex items-center justify-center text-center relative">
                                            <div class="relative">
                                                <img id="{{ $previewId }}" src="{{ asset('uploads/badge-images/' . $badge->image) }}" alt="badge" class="object-cover cursor-pointer" style="width: 100px; height: 100px;">
                                                
                                                <!-- Hidden file input -->
                                                <input type="file" id="{{ $inputId }}" name="badge_image" class="hidden" accept="image/*" onchange="previewImage(event, '{{ $previewId }}')">
                                            
                                                <label for="{{ $inputId }}" class="absolute top-0 right-0 bg-gray-800 text-white p-1 rounded-full cursor-pointer hover:bg-gray-700 transition" style="width: 30px; height: 30px;">
                                                    <i class="fa-solid fa-pen"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="name" class="block font-medium text-sm text-slate-600">Badge Name</label>
                                            <x-text-input id="name" name="badge_name" type="text" class="mt-1 block w-full" :value="old('badge_name', $badge->name)" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('badge_name')" />
                                        </div>

                                        <div>
                                            <label for="description" class="block font-medium text-sm text-slate-600">Description</label>
                                            <textarea id="description" class="rounded text-sm border text-slate-400 resize-none w-full h-20 py-2 px-3 font-normal focus:outline-none border-gray-300 focus:border-indigo-300 focus:ring-indigo-300"
                                                                name="badge_description" {{ $errors->has('badge_description') ? 'border-red-500' : 'border-gray-300' }}>{{ old('badge_description', $badge->description) }}</textarea>
                                            <x-input-error class="mt-2" :messages="$errors->get('badge_description')" />
                                        </div>

                                        <div class="flex space-x-2">
                                            <div>
                                                <label for="streak_criteria" class="block font-medium text-sm text-slate-600">Streak Criteria</label>
                                                <x-text-input id="streak_criteria" name="badge_streak_criteria" type="text" class="mt-1 block w-full" :value="old('badge_streak_criteria', $badge->streak_criteria)" autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get('badge_streak_criteria')" />
                                            </div>

                                            <div>
                                                <label for="contribution" class="block font-medium text-sm text-slate-600">Contribution Required</label>
                                                <x-text-input id="contribution" name="badge_contribution_required" type="text" class="mt-1 block w-full" :value="old('badge_contribution_required', $badge->contribution_required)" autofocus />
                                                <x-input-error class="mt-2" :messages="$errors->get('badge_contribution_required')" />
                                            </div>
                                        </div>

                                        <div>
                                            <label for="special_badge" class="block font-medium text-sm text-slate-600">Special Badge</label>
                                            <x-text-input id="special_badge" name="badge_special" type="text" class="mt-1 block w-full" :value="old('badge_special', $badge->special_badge)" autofocus />
                                            <x-input-error class="mt-2" :messages="$errors->get('badge_special')" />
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
            {{ $badges->links() }}
        </div>
    </div>

    <!-- Badge Add Form Modal -->
    <div id="badgeModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Badge</h3>
            <form method="POST" action="{{ route('badge.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mt-3">
                    <label for="name" class="block font-medium text-sm text-slate-600">Badge Name</label>
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autofocus  />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mt-3">
                    <label for="description" class="block font-medium text-sm text-slate-600">Description</label>
                    <textarea id="description" class="rounded text-sm border text-slate-400 resize-none w-full h-20 py-2 px-3 font-normal focus:outline-none border-gray-300 focus:border-indigo-300 focus:ring-indigo-300"
                                        name="description" {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}>{{ old('description') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="flex space-x-2 mt-3">
                    <div>
                        <label for="streak_criteria" class="block font-medium text-sm text-slate-600">Streak Criteria</label>
                        <x-text-input id="streak_criteria" name="streak_criteria" type="number" class="mt-1 block w-full" :value="old('streak_criteria')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('streak_criteria')" />
                    </div>

                    <div>
                        <label for="contribution_required" class="block font-medium text-sm text-slate-600">Contribution Required</label>
                        <x-text-input id="contribution_required" name="contribution_required" type="number" class="mt-1 block w-full" :value="old('contribution_required')" autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('contribution_required')" />
                    </div>
                </div>

                <div class="mt-3">
                    <label for="special_badge" class="block font-medium text-sm text-slate-600">Special Badge</label>
                    <x-text-input id="special_badge" name="special_badge" type="text" class="mt-1 block w-full" :value="old('special_badge')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('special_badge')" />
                </div>

                <div class="mt-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" aria-describedby="file_input" id="file_input" type="file" name="image">
                    <p class="mt-1 text-xs text-gray-300" id="file_input">PNG, JPG, JPEG (MAX. 2048KB).</p>
                </div>


                <div class="flex justify-end mt-4 space-x-2">
                    <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                </div>
            </form>
            <!-- Close button (X) -->
            <button onclick="closeBadgeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    @if ($errors->any())
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('badgeModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex'); // this ensures proper centering
                }
            });
        </script>
    @endif

    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById(previewId).src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection