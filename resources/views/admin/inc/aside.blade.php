{{-- SIDEBAR --}}
<div class="fixed left-0 top-0 w-[265px] h-full bg-bgPurple p-4">
    <a href="" class="">
        <img src="{{asset('backend/assets/img/FoodiesArchive_Logo-removebg-preview.png')}}" alt="" style="height: 50px; width: 240px;">
    </a>  
    <ul class="mt-4">
        <li class="mb-1 group active">
            <a href="/admin" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
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
            <a href="/restaurant" class="flex items-center py-3 px-4 text-gray-500 hover:bg-gray-700 hover:text-white rounded-md group-[.active]:bg-gray-700 group-[.active]:text-white">
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