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
            <p class="text-customYellow font-semibold text-2xl py-2">Tags</p>
        </div>
        <div class="mb-3">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4 md:items-center">
                    <div class="relative search">
                        <input type="search" name="search" id="searchtag" placeholder="Search tags..." class="pl-9 w-full md:w-[300px] border border-gray-300 rounded-md py-2 px-3" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <form method="GET" action="{{ route('tag.index') }}">
                        <label for="filter" class="text-sm font-medium">Filter:</label>
                        <select name="filter" id="filter" onchange="this.form.submit()" class="border border-gray-300 rounded-md h-9 px-3 text-sm">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Tags</option>
                            <option value="most" {{ request('filter') == 'most' ? 'selected' : '' }}>Most Used</option>
                            <option value="least" {{ request('filter') == 'least' ? 'selected' : '' }}>Least Used</option>
                        </select>
                    </form>

                    <button type="button" onclick="openTagModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                        + Add Tag
                    </button>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-8 p-4 bg-gray-100 text-sm font-medium text-center">
                <div class="col-span-3 text-xs font-medium text-gray-500 uppercase3">Tag Name</div>
                <div class="col-span-3 text-xs font-medium text-gray-500 uppercase">Used In (Posts)</div>
                <div class="col-span-2 text-xs font-medium text-gray-500 uppercase">Actions</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm alldatatag">
                @foreach($tags as $tag)
                    <div>
                        <div class="grid grid-cols-8 items-center hover:bg-gray-50 text-center">
                            <div class="col-span-3 font-base text-sm">{{ $tag->name }}</div>
                            <div class="col-span-3 font-base text-sm">{{ $tag->foodPosts->count() }}</div>
                            <div class="col-span-2 flex space-x-2 text-center justify-center">
                                <div class="flex justify-center">
                                    <button onclick="openTagEditModal({{ $tag->id }})" class="text-blue-500">Edit</button>
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
                            <!-- Edit Modal -->
                            <div id="edit-modal-{{ $tag->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 hidden">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                    <!-- Close Button -->
                                    <button onclick="closeTagEditModal({{ $tag->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>                                    <h2 class="text-xl font-bold mb-4">Edit Tag</h2>
                                    <form action="{{route('tag.update', $tag->id)}}" method="POST" class="mt-6 space-y-6">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="name" class="block font-medium text-sm text-slate-600">Tag Name</label>
                                            <x-text-input id="name" name="tag_name" type="text" class="mt-1 block w-full" :value="old('tag_name', $tag->name)" autofocus  />
                                            <x-input-error class="mt-2" :messages="$errors->get('tag_name')" />
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
        <div class="mt-4 alldatatag">
            {{ $tags->links() }}
        </div>

        <div class="divide-y text-sm searchdatatag" id="tag-content">

        </div>

        <div class="mb-2 border-b border-gray-200">
            <p class="text-customYellow font-semibold text-2xl py-2">Tag Analytics</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Displaying - Top Tags -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Top 10 Tags</h3>
                <canvas id="topTagsChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Tags Never Used -->
            <div class="bg-white p-5 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4 text-gray-500 flex items-center gap-2">
                    <i class="fa-solid fa-xmark text-red-500"></i>
                    Tags Never Used
                </h3>

                <div class="flex flex-wrap gap-2">
                    @forelse ($unusedTags as $tag)
                        <span class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full shadow-sm">
                            {{ $tag->name }}
                        </span>
                    @empty
                        <span class="text-gray-500">All tags have been used.</span>
                    @endforelse
                </div>
            </div>

            <!-- Displaying - Trending This Week -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Trending This Week</h3>
                <canvas id="weekTrendingChart" class="w-full h-48"></canvas>
            </div>

            <!-- Displaying - Trending This Month -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-lg font-semibold mb-2 text-gray-500">Trending This Month</h3>
                <canvas id="monthTrendingChart" class="w-full h-48"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('topTagsChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($topTags->pluck('name')) !!},
                datasets: [{
                    label: 'Post Count',
                    data: {!! json_encode($topTags->pluck('food_posts_count')) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                }]
            }
        });

        new Chart(document.getElementById('weekTrendingChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($weekTrending->pluck('name')) !!},
                datasets: [{
                    label: 'Posts This Week',
                    data: {!! json_encode($weekTrending->pluck('food_posts_count')) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                }]
            }
        });

        new Chart(document.getElementById('monthTrendingChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthTrending->pluck('name')) !!},
                datasets: [{
                    label: 'Posts This Month',
                    data: {!! json_encode($monthTrending->pluck('food_posts_count')) !!},
                    backgroundColor: 'rgba(251, 191, 36, 0.7)',
                }]
            }
        });
    </script>

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
            <!-- Close button -->
            <button onclick="closeTagModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
@endsection

