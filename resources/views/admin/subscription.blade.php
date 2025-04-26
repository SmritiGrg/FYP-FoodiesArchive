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
            <p class="text-customYellow font-semibold text-2xl py-2">Subscriptions</p>
        </div>
        <div class="flex space-x-12 pb-2 text-gray-500">
            <a href="{{ route('subscription.index', ['tab' => 'subscribers']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'subscribers' || !request('tab') ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                SUBSCRIBERS LIST
            </a>

            <a href="{{ route('subscription.index', ['tab' => 'plans']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'plans' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                SUBSCRIPTIONS PLANS
            </a>

            <a href="{{ route('subscription.index', ['tab' => 'paymentHistory']) }}" 
            class="font-normal border-b-2 {{ request('tab') == 'paymentHistory' ? 'text-darkPurple border-darkPurple' : 'border-transparent' }}">
                PAYMENT HISTORY
            </a>
        </div>

        <div id="subscribers" class="mt-4">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h2 class="text-base font-semibold text-gray-900">Current Subscribers</h2>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-customYellow px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-hovercustomYellow focus:outline-none sm:w-auto">
                        Export
                    </button>
                </div>
            </div>

            {{-- FILTERS --}}
            <div class="mt-4 bg-white shadow rounded-t-lg p-4">
                <h3 class="text-sm font-medium text-gray-500 mb-3">Filters</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <div>
                        <label htmlFor="time-filter" class="block text-sm font-medium text-gray-700">Plan Duration</label>
                        <select id="time-filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Plan Duration</option>
                            <option>Month</option>
                            <option>Year</option>
                        </select>
                    </div>
                    <div>
                        <label htmlFor="status-filter" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status-filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">All Status</option>
                            <option>Active</option>
                            <option>Expired</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <div>
                        <label htmlFor="start-date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start-date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" />
                    </div>
                    <div>
                        <label htmlFor="end-date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                        <input type="date" id="end-date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" />
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-md shadow">
                <!-- Header -->
                <div class="grid grid-cols-10 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4">
                    <div class="col-span-1">FULL NAME</div>
                    <div class="col-span-2">EMAIL</div>
                    <div class="col-span-1">DURATION TYPE</div>
                    <div class="col-span-1">START DATE</div>
                    <div class="col-span-1">END DATE</div>
                    <div class="col-span-1">LAST PAYMENT DATE</div>
                    <div class="col-span-1">PAYMENT STATUS</div>
                    <div class="col-span-1">SUBSCRIPTION STATUS</div>
                    <div class="col-span-1">ACTIONS</div>
                </div>

                <!-- Rows -->
                <div class="divide-y text-sm alldata">
                    @foreach($subscribers as $subscriber)
                        <div>
                            <div class="grid grid-cols-10 items-center hover:bg-gray-50 space-x-4">
                                <div class="col-span-1 p-2">{{$subscriber->user->full_name}}</div>
                                <div class="col-span-2">{{ $subscriber->user->email }}</div>
                                <div class="col-span-1">{{ $subscriber->subscriptionPlan->billing_time }}</div>
                                <div class="col-span-1">{{ $subscriber->start_date->format('Y-m-d') }}</div>
                                <div class="col-span-1">{{ $subscriber->start_date->format('Y-m-d') }}</div>
                                <div class="col-span-1">
                                    {{ $subscriber->payments->first()->payment_date->format('Y-m-d')}}
                                </div>

                                <div class="col-span-1">
                                    @php
                                        $paymentStatus = $subscriber->payments->first()->status;
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        @if ($paymentStatus === 'Paid')
                                            bg-green-100 text-green-700
                                        @elseif ($paymentStatus === 'Failed')
                                            bg-red-100 text-red-700
                                        @else
                                            bg-yellow-100 text-yellow-700
                                        @endif
                                    ">
                                        {{ $paymentStatus }}
                                    </span>
                                </div>
                                <div class="col-span-1">
                                    @php
                                        $subscriptionStatus = $subscriber->status;
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        @if ($subscriptionStatus === 'Active')
                                            bg-green-100 text-green-700
                                        @elseif ($subscriptionStatus === 'Expired' || $subscriptionStatus === 'Cancelled')
                                            bg-red-100 text-red-700
                                        @else
                                            bg-yellow-100 text-yellow-700
                                        @endif
                                    ">
                                        {{ $subscriptionStatus }}
                                    </span>
                                </div>

                                <div class="col-span-1 flex">
                                    <button onclick="openBadgeEditModal({{ $subscriber->id }})" class="text-blue-500">Edit</button>                                        
                                    <form action="{{route('badge.delete', $subscriber->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 alldata">
                {{ $subscribers->links() }}
            </div>

            <div class="divide-y text-sm searchdata" id="badge-content">
                
            </div>
        </div>
@endsection