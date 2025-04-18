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
            <p class="text-customYellow font-semibold text-2xl py-2">Badges</p>
        </div>
        <div class="flex space-x-12 pb-2 text-gray-500">
            <a href="{{ route('badge', ['tab' => 'list']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'list' || !request('tab') ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                <i class="fa-solid fa-grip text-lg pr-1"></i> BADGE LIST
            </a>

            <a href="{{ route('badge', ['tab' => 'analytics']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'analytics' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                <i class="fa-solid fa-chart-line text-lg pr-1"></i> BADGE ANALYTICS
            </a>

            <a href="{{ route('badge', ['tab' => 'leaderboard']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'leaderboard' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                <i class="fa-solid fa-ranking-star text-lg pr-1"></i> LEADERBOARD
            </a>
        </div>

        @if(request('tab') == 'leaderboard')
            <!-- Leaderboard -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6">
                    <h2 class="text-lg leading-6 font-medium text-gray-900">Badge Leaderboard</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Top badge collectors</p>
                </div>
                <div class="border-t border-gray-200">
                    <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <!-- Top Badge Collector -->
                        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-4 shadow-sm text-white">
                            <h3 class="text-sm font-medium">Top Badge Collector</h3>
                            <div class="mt-2 flex items-center">
                                <div>
                                    <img src="{{asset('uploads/profile-images/'. $topBadgeCollector?->image)}}" alt="" class="h-12 w-12 rounded-full object-cover object-center">
                                </div>
                                <div class="ml-3">
                                    <div class="text-lg font-medium">{{ $topBadgeCollector?->full_name ?? 'N/A' }}</div>
                                    <div class="text-sm opacity-80">{{ $topBadgeCollector?->badges_count ?? 0 }} badges total</div>
                                </div>
                            </div>
                        </div>
                        <!-- Most Badges This Month -->
                        <div class="bg-gradient-to-r from-gray-400 to-gray-500 rounded-lg p-4 shadow-sm text-white">
                            <h3 class="text-sm font-medium">Most Badges This Month</h3>
                            <div class="mt-2 flex items-center">
                                <div>
                                    <img src="{{asset('uploads/profile-images/'. $mostBadgesThisMonth?->image)}}" alt="" class="h-10 w-10 rounded-full object-cover object-center">
                                </div>
                                <div class="ml-3">
                                    <div class="text-lg font-medium">{{ $mostBadgesThisMonth?->full_name ?? 'N/A' }}</div>
                                    <div class="text-sm opacity-80">{{ $mostBadgesThisMonth?->badge_count ?? 0 }} badges this month</div>
                                </div>
                            </div>
                        </div>
                        <!-- Longest Streak -->
                        <div class="bg-gradient-to-r from-orange-400 to-orange-500 rounded-lg p-4 shadow-sm text-white">
                            <h3 class="text-sm font-medium">Longest Streak</h3>
                            <div class="mt-2 flex items-center">
                                <div>
                                    <img src="{{asset('uploads/profile-images/'. $longestStreakUser?->image)}}" alt="" class="h-12 w-12 rounded-full object-cover object-center">
                                </div>
                                <div class="ml-3">
                                    <div class="text-lg font-medium">{{ $longestStreakUser?->full_name ?? 'N/A' }}</div>
                                    <div class="text-sm opacity-80">{{ $longestStreakUser?->streak_count ?? 0 }} day streak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Badges</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Streak</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($topUsersByBadge as  $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-900">{{ $loop->iteration }}</div></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm text-gray-900">{{ $user->full_name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $user->badges_count }} badges</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->streak_count ?? 0 }} days</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>

            @else
            <div class="mb-3">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex flex-col md:flex-row gap-4 md:items-center">
                        <div class="relative search">
                            <input type="search" name="search" id="search" placeholder="Search badges..." class="pl-9 w-full md:w-[300px] border border-gray-300 rounded-md py-2 px-3" />
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                        </div>
                        
                    </div>
                    <div class="flex space-x-3">
                        <form method="GET" action="{{ route('badge') }}">
                            <select name="type" onchange="this.form.submit()" class="border border-gray-300 rounded-md h-9 px-5 text-sm">
                                <option value="">Badge Type</option>
                                <option value="streak" {{ request('type') == 'streak' ? 'selected' : '' }}>Streak-based</option>
                                <option value="contribution" {{ request('type') == 'contribution' ? 'selected' : '' }}>Contribution-based</option>
                                <option value="special" {{ request('type') == 'special' ? 'selected' : '' }}>Special-badge</option>
                            </select>
                        </form>

                        <button type="button" onclick="openBadgeModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                            + Add Badge
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-md shadow">
                <!-- Header -->
                <div class="grid grid-cols-9 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4">
                    <div class="col-span-1">IMAGE</div>
                    <div class="col-span-1">BADGE NAME</div>
                    <div class="col-span-2">DESCRIPTION</div>
                    <div class="col-span-1">STREAK CRITERIA</div>
                    <div class="col-span-1">CONTRIBUTITON</div>
                    <div class="col-span-1">SPECIAL</div>
                    <div class="col-span-1">TOTAL EARNED (USERS)</div>
                    <div class="col-span-1">ACTIONS</div>
                </div>

                <!-- Rows -->
                <div class="divide-y text-sm alldata">
                    @foreach($badges as $badge)
                        @php 
                            $modalId = 'edit-modal-' . $badge->id;
                        @endphp

                        <div>
                            <div class="grid grid-cols-9 items-center hover:bg-gray-50 space-x-4">
                                <div class="col-span-1 p-2"><img src="{{asset('uploads/badge-images/'. $badge->image)}}" alt="" class="w-24 h-20"></div>
                                <div class="col-span-1">{{ $badge->name }}</div>
                                <div class="col-span-2">{{ $badge->description }}</div>
                                <div class="col-span-1">{{ $badge->streak_criteria }}</div>
                                <div class="col-span-1">{{ $badge->contribution_required }}</div>
                                <div class="col-span-1">{{ $badge->special_badge }}</div>
                                <div class="col-span-1">{{ $badge->users->count() }}</div>
                                <div class="col-span-1 flex">
                                        <label for="{{ $modalId }}" class="block text-sm font-normal text-blue-400 px-2 py-2 cursor-pointer">Edit</label>
                                        <form action="{{route('badge.delete', $badge->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                        </form>
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
            <div class="mt-4 alldata">
                {{ $badges->appends(['type' => request('type')])->links() }}
            </div>

            <div class="divide-y text-sm searchdata" id="badge-content">
            </div>
        @endif
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