@extends('admin.inc.main')
@section('container')
<main class="w-[calc(100%-260px)] ml-64 bg-gray-50 min-h-screen pt-16">
    @if (session('message'))
        <p id="success-message" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 text-base text-white bg-green-500 border border-green-600 px-4 py-2 rounded-lg shadow-md w-fit z-50">
            {{ session('message') }}
        </p>
    @endif
    <div class="flex-1 px-8 py-5 bg-gray-100">
        <div class="mb-3">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4 md:items-center">
                    <div class="relative search">
                        <input type="search" name="search" id="searchUser" placeholder="Search users..." class="pl-9 w-full md:w-[300px] border border-gray-300 rounded-md py-2 px-3" />
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <form method="GET" action="{{ route('user.index') }}">
                        <select name="role" onchange="this.form.submit()" class="border border-gray-300 rounded-md h-9 px-5 text-sm">
                            <option value="">Filter by Role</option>
                            <option value="premium_user" {{ request('role') == 'premium_user' ? 'selected' : '' }}>Premium User</option>
                            <option value="general" {{ request('role') == 'general' ? 'selected' : '' }}>General User</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md shadow">
            <!-- Header -->
            <div class="grid grid-cols-6 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4">
                <div class="col-span-1">IMAGE</div>
                <div class="col-span-1">Full NAME</div>
                <div class="col-span-1">EMAIL</div>
                <div class="col-span-1 text-center">ROLE</div>
                <div class="col-span-1 text-center">TOTAL CONTRIBUTIONS</div>
                <div class="col-span-1 text-center">ACTIONS</div>
            </div>

            <!-- Rows -->
            <div class="divide-y text-sm alluserdata">
                @foreach($users as $user)
                    <div class="grid grid-cols-6 items-center hover:bg-gray-50 space-x-4">
                        <div class="col-span-1 p-2">
                            <img src="{{ asset('uploads/profile-images/' . $user->image) }}" alt="" class="w-12 h-12 rounded-full object-cover">
                        </div>
                        <div class="col-span-1">{{ $user->full_name }}</div>
                        <div class="col-span-1">{{ $user->email }}</div>
                        <div class="col-span-1 text-center">{{ ucfirst($user->role) }}</div>
                        <div class="col-span-1 text-center">{{ $user->total_contributions }}</div>
                        <div class="col-span-1 flex justify-center">
                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4 alluserdata">
            {{ $users->appends(request()->query())->links() }}
        </div>
        <div class="divide-y text-sm searchuserdata" id="user-content">
                
        </div>
    </div>
@endsection