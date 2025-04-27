{{-- SIDEBAR --}}
<div class="fixed left-0 top-0 w-[265px] h-full bg-bgPurple p-4 z-50">
    <a href="" class="">
        <img src="{{asset('backend/assets/img/FoodiesArchive_Logo-removebg-preview.png')}}" alt="" style="height: 50px; width: 240px;">
    </a>  
    <ul class="mt-4 overflow-y-auto">
        <li class="mb-1 group active">
            <a href="/admin" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('admin') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}">
                <i class="ri-group-fill mr-3 text-lg"></i>
                <span class="text-sm">User Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="/restaurant" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('restaurant') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="ri-restaurant-2-line mr-3 text-lg"></i>
                <span class="text-sm">Restaurant Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="fa-solid fa-grip mr-3 text-lg"></i>
                <span class="text-sm">Food Post Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="fa-regular fa-star mr-3 text-lg"></i>
                <span class="text-sm">Review & Rating Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="/badge" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('badge') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="ri-award-fill mr-3 text-lg"></i>
                <span class="text-sm">Badge Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="/tag" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('tag') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="fa-solid fa-tag mr-3 text-lg"></i>
                <span class="text-sm">Tag Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="fa-solid fa-utensils mr-3 text-lg"></i>
                <span class="text-sm">Types Management</span>
            </a>
        </li>
        <li class="mb-1">
            <a href="/subscription" class="flex items-center py-3 px-4 text-gray-500 rounded-md {{ Request::is('subscription') ? 'bg-hovercustomYellow text-white' : 'text-gray-500 hover:bg-hovercustomYellow hover:text-white' }}"">
                <i class="ri-bill-line mr-3 text-lg"></i>
                <span class="text-sm">Subscription Management</span>
            </a>
        </li>
    </ul>  
</div>