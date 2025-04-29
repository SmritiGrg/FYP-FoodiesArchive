@extends('admin.inc.main')
@section('container')
<main class="w-[calc(100%-260px)] ml-64 bg-gray-50 min-h-screen pt-16">
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-white bg-green-500 border border-green-600 px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif

    <div class="px-8 py-4 bg-gray-100">
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
                <label for="map_embed_url" class="block font-medium text-sm text-slate-600">Google Map Embed URL:</label>
                <x-text-input id="map_embed_url" class="block mt-1 w-full" type="text" name="rest_map_embed_url"
                    :error="$errors->has('rest_map_embed_url')" :value="old('rest_map_embed_url')" autofocus />
                <x-input-error :messages="$errors->get('rest_map_embed_url')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="status" class="block font-medium text-sm text-slate-600">Status</label>
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
    </div>
@endsection