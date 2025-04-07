{{-- MAIN --}}
<main class="w-[calc(100%-265px)] ml-64 bg-gray-50 min-h-screen">
    <div class="py-3 px-6 bg-white flex items-center shadow-md shadow-black/5">
        <ul class="flex items-center text-2xl ml-4 font-semibold">
            <li class="mr-4">
                Dashboard
            </li>
        </ul>
        <ul class="ml-auto flex items-center">
            <li>
                <button class="text-gray-400 w-8 h-8 mr-3 rounded-full flex items-center justify-center hover:bg-gray-100 hover:text-gray-600">
                    <i class="fa-regular fa-bell text-xl"></i>
                </button>
            </li>
            <li>
                <div class="relative group inline-block border-l-2 border-gray-300 pl-4">
                    <button class="flex text-sm bg-gray-800 rounded-full md:me-0 border-4 border-gray-300 ">
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ asset('uploads/profile-images/' . auth()->user()->image) }}" alt="user photo"/>
                    </button>
                    <div class="absolute w-56 top-full right-0 rounded-lg mt-1 shadow-lg p-3 text-start scale-y-0 group-hover:scale-y-100 origin-top duration-200 bg-white">
                        <div class="hover:bg-gray-100 py-3 px-2">
                            <a href="/PersonalProfile" class="flex items-center">
                                <img src="{{asset('uploads/profile-images/' . Auth::user()->image) }}" alt="" class="w-16 h-16 rounded-full object-cover mr-3">
                                <div>
                                    <span class="block text-sm text-gray-900">{{ Auth::user()->full_name }}</span>
                                    <span class="block text-sm text-gray-500"
                                        >{{ Auth::user()->username }}</span
                                    >
                                </div>
                            </a>        
                        </div>
                        <div class="hover:bg-gray-100">
                            <a href="/PersonalProfile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" >My Profile </a>        
                        </div>
                        <div class="hover:bg-gray-100">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" >Settings</a>        
                        </div>
                        <div class="hover:bg-gray-100 border-t-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                    Log out
                                </button>
                            </form>        
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>