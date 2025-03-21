<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/hover-min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/hover.css')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css" integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css" integrity="sha512-kJlvECunwXftkPwyvHbclArO8wszgBGisiLeuDFwNM8ws+wKIw0sv1os3ClWZOcrEB2eRXULYUsm8OVRGJKwGA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    {{-- @auth
        <li class="nav-item
                dropdown mx-5">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle fs-2"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ 'Log Out' }}
                    </x-dropdown-link>
                </form>
            </ul>
        </li>
    @endauth
    <h1>
        HELLO WELCOME ADMIN
    </h1> --}} 

    <div class="fixed left-0 top-0 w-72 h-full bg-bgPurple p-4">
        <a href="" class="">
            <img src="{{asset('backend/assets/img/FoodiesArchive_Logo-removebg-preview.png')}}" alt="" style="height: 50px; width: 240px;">
        </a>  
        <ul class="mt-4">
            <li class="mb-1 group active">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="ri-group-fill mr-3 text-lg"></i>
                    <span class="text-sm">User Management</span>
                </a>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="ri-restaurant-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Restaurant Management</span>
                </a>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="fa-solid fa-grip mr-3 text-lg"></i>
                    <span class="text-sm">Food Post Management</span>
                </a>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="fa-regular fa-star mr-3 text-lg"></i>
                    <span class="text-sm">Review & Rating Management</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-award-fill mr-3 text-lg"></i>
                    <span class="text-sm">Badge Management</span>
                    <i class="ri-arrow-right-wide-line ml-auto text-lg group-[.selected]:rotate-90"></i>
                </a>
                <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                    <li class="mb-4">
                        <a href="" class="text-gray-500 text-sm flex items-center hover:text-white before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-500 before:mr-3">Create</a>
                    </li>
                    <li class="mb-4">
                        <a href="" class="text-gray-500 text-sm flex items-center hover:text-white before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-500 before:mr-3">Index</a>
                    </li>
                </ul>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="ri-bill-line mr-3 text-lg"></i>
                    <span class="text-sm">Subscription Management</span>
                </a>
            </li>
            <li class="mb-1">
                <a href="" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
                    <i class="fa-solid fa-credit-card mr-3 text-lg"></i>
                    <span class="text-sm">Payment Management</span>
                </a>
            </li>
        </ul>  
    </div>

    <script src="{{asset('backend/assets/js/script.js')}}"></script>
</body>
</html>
