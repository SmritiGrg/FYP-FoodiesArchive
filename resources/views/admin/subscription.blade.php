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

        @if(request('tab') == 'paymentHistory')
            {{-- PAYMENT HISTORY --}}
            <div id="paymentHistory" class="mt-4">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-base font-semibold text-gray-900">Payment History</h2>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a href="{{ route('payments.export') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-customYellow px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-hovercustomYellow focus:outline-none sm:w-auto">
                            Export CSV
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-md shadow mt-4">
                    <!-- Header -->
                    <div class="grid grid-cols-11 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4">
                        <div class="col-span-2">SUBSCRIBER NAME</div>
                        <div class="col-span-1">PLAN TYPE</div>
                        <div class="col-span-1">AMOUNT PAID</div>
                        <div class="col-span-1">PAYMENT METHOD</div>
                        <div class="col-span-1">STATUS</div>
                        <div class="col-span-1">PAYMENT DATE</div>
                        <div class="col-span-1">TRANSACTION ID</div>
                        <div class="col-span-3 text-center">PAID FOR DURATION</div>
                    </div>

                    <!-- Rows -->
                    <div class="divide-y text-sm">
                        @foreach($subscribers as $subscriber)
                            @foreach($subscriber->payments as $payment)
                                <div class="grid grid-cols-11 items-center hover:bg-gray-50 space-x-4 p-4">
                                    <div class="col-span-2">{{ $subscriber->user->full_name }}</div>
                                    <div class="col-span-1">{{ $subscriber->subscriptionPlan->type }}</div>
                                    <div class="col-span-1">Rs. {{ $payment->amount_paid }}</div>
                                    <div class="col-span-1">{{ $payment->payment_method }}</div>
                                    <div class="col-span-1">
                                        <span class="px-2 py-1 rounded text-xs font-medium
                                            @if ($payment->status === 'Paid')
                                                bg-green-100 text-green-700
                                            @elseif ($payment->status === 'Failed')
                                                bg-red-100 text-red-700
                                            @else
                                                bg-yellow-100 text-yellow-700
                                            @endif
                                        ">
                                            {{ $payment->status }}
                                        </span>
                                    </div>
                                    <div class="col-span-1">{{ $payment->payment_date->format('Y-m-d') }}</div>
                                    <div class="col-span-1">{{ $payment->transaction_id }}</div>
                                    <div class="col-span-3 text-center">{{ $subscriber->start_date->format('Y-m-d') }} - {{ $subscriber->end_date->format('Y-m-d') }}</div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                <div class="mt-4">
                    {{ $subscribers->links() }}
                </div>
            </div>
        @elseif(request('tab') == 'plans')
            {{-- PLANS LIST --}}
            <div id="plans" class="mt-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-700">Subscription Plans</h2>
                    <div class="flex items-center space-x-4">
                        <form method="GET" action="{{ route('subscription.index') }}">
                            <input type="hidden" name="tab" value="plans">
                            <select name="plan_filter" class="border border-gray-300 rounded-md h-9 px-6 text-sm" onchange="this.form.submit()">
                                <option value="">All Plans</option>
                                <option value="highly_used" {{ request('plan_filter') == 'highly_used' ? 'selected' : '' }}>Highly Used</option>
                            </select>
                        </form>
                        <button type="button" onclick="openAddPlanModal()" class="bg-customYellow hover:bg-hovercustomYellow text-white px-4 py-2 rounded-md text-sm flex items-center">
                            + Add Plan
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-md shadow">
                    <!-- Header -->
                    <div class="grid grid-cols-8 p-4 bg-gray-100 text-sm font-medium text-gray-500 space-x-4">
                        <div class="col-span-1">PLAN TYPE</div>
                        <div class="col-span-1">BILLING TIME</div>
                        <div class="col-span-1">AMOUNT</div>
                        <div class="col-span-3">FEATURES</div>
                        <div class="col-span-1">PLAN USED BY</div>
                        <div class="col-span-1">ACTIONS</div>
                    </div>

                    <!-- Rows -->
                    <div class="divide-y text-sm">
                        @foreach($plans as $plan)
                            <div class="grid grid-cols-8 items-center hover:bg-gray-50 space-x-4 p-4">
                                <div class="col-span-1 p-2">{{ $plan->type }}</div>
                                <div class="col-span-1">{{ $plan->billing_time }}</div>
                                <div class="col-span-1">Rs. {{ $plan->amount }}</div>
                                <div class="col-span-3">
                                    <ul class="list-disc pl-5">
                                        @foreach($plan->features as $feature)
                                            <li>{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-span-1">{{ $plan->subscribers_count }}</div>
                                <div class="col-span-1 flex">
                                    <button onclick="openEditPlanModal({{ $plan->id }})" class="text-blue-500">Edit</button>
                                    <form action="{{ route('subscription.delete', $plan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4">
                    {{ $plans->links() }}
                </div>
            </div>

            <!-- Add Plan Modal -->
            <div id="addPlanModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
                <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Add New Subscription Plan</h3>
                    <form method="POST" action="{{ route('subscription.store') }}">
                        @csrf
                        <div class="mt-3">
                            <label for="type" class="block font-medium text-sm text-slate-600">Plan Type</label>
                            <input id="type" name="type" type="text" class="mt-1 block w-full border-gray-300 rounded-md {{ $errors->has('type') ? 'border-red-500' : 'border-gray-300' }}"/>
                            @error('type')
                                <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="billing_time" class="block font-medium text-sm text-slate-600">Billing Time</label>
                            <select id="billing_time" name="billing_time" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                                <option value="lifetime">Lifetime</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="amount" class="block font-medium text-sm text-slate-600">Amount</label>
                            <input id="amount" name="amount" type="number" class="mt-1 block w-full border-gray-300 rounded-md"/>
                            @error('amount')
                                <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="features" class="block font-medium text-sm text-slate-600">Features (comma-separated)</label>
                            <textarea id="features" name="features" class="mt-1 block w-full border-gray-300 rounded-md {{ $errors->has('features') ? 'border-red-500' : 'border-gray-300' }}"></textarea>
                            @error('features')
                                <p class="text-sm text-red-600 space-y-1 font-poppins">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end mt-4 space-x-2">
                            <button type="button" onclick="closeAddPlanModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Add</button>
                        </div>
                    </form>
                    <button onclick="closeAddPlanModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>

            <!-- Edit Plan Modal -->
            @foreach($plans as $plan)
            <div id="editPlanModal-{{ $plan->id }}" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
                <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Edit Subscription Plan</h3>
                    <form method="POST" action="{{ route('subscription.update', $plan->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mt-3">
                            <label for="type" class="block font-medium text-sm text-slate-600">Plan Type</label>
                            <input id="type" name="type" type="text" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $plan->type }}" required />
                        </div>

                        <div class="mt-3">
                            <label for="billing_time" class="block font-medium text-sm text-slate-600">Billing Time</label>
                            <select id="billing_time" name="billing_time" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                <option value="monthly" {{ $plan->billing_time == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                <option value="yearly" {{ $plan->billing_time == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                <option value="lifetime" {{ $plan->billing_time == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="amount" class="block font-medium text-sm text-slate-600">Amount</label>
                            <input id="amount" name="amount" type="number" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $plan->amount }}" required />
                        </div>

                        <div class="mt-3">
                            <label for="features" class="block font-medium text-sm text-slate-600">Features (comma-separated)</label>
                            <textarea id="features" name="features" class="mt-1 block w-full border-gray-300 rounded-md" required>{{ implode(',', $plan->features) }}</textarea>
                        </div>

                        <div class="flex justify-end mt-4 space-x-2">
                            <button type="button" onclick="closeEditPlanModal({{ $plan->id }})" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Update</button>
                        </div>
                    </form>
                    <button onclick="closeEditPlanModal({{ $plan->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            @endforeach

            @if ($errors->any())
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        const modal = document.getElementById('addPlanModal');
                        if (modal) {
                            modal.classList.remove('hidden');
                            modal.classList.add('flex');
                        }
                    });
                </script>
            @endif
            <script>
                function openAddPlanModal() {
                    document.getElementById('addPlanModal').classList.remove('hidden');
                    document.getElementById('addPlanModal').classList.add('flex');
                }

                function closeAddPlanModal() {
                    document.getElementById('addPlanModal').classList.add('hidden');
                    document.getElementById('addPlanModal').classList.remove('flex');
                }

                function openEditPlanModal(planId) {
                    document.getElementById(`editPlanModal-${planId}`).classList.remove('hidden');
                    document.getElementById(`editPlanModal-${planId}`).classList.add('flex');
                }

                function closeEditPlanModal(planId) {
                    document.getElementById(`editPlanModal-${planId}`).classList.add('hidden');
                    document.getElementById(`editPlanModal-${planId}`).classList.remove('flex');
                }
            </script>
        @else
            {{-- SUBSCRIBERS LIST --}}
            <div id="subscribers" class="mt-4">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="text-base font-semibold text-gray-900">Subscribers</h2>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                        <a href="{{ route('subscribers.export') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-customYellow px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-hovercustomYellow focus:outline-none sm:w-auto">
                            Export CSV
                        </a>
                    </div>
                </div>

                {{-- FILTERS --}}
                <div class="mt-4 bg-white shadow rounded-t-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Filters</h3>
                    <form method="GET" action="{{ route('subscription.index') }}" id="filter-form">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                            <div>
                                <label for="plan-duration" class="block text-sm font-medium text-gray-700">Plan Duration</label>
                                <select name="billing_time" id="plan-duration" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="document.getElementById('filter-form').submit()">
                                    <option value="">All Durations</option>
                                    <option value="monthly" {{ request('billing_time') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="yearly" {{ request('billing_time') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="lifetime" {{ request('billing_time') == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="document.getElementById('filter-form').submit()">
                                    <option value="">All Status</option>
                                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Expired" {{ request('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div>
                                <label for="date-filter" class="block text-sm font-medium text-gray-700">Date Filter</label>
                                <select name="date_filter" id="date-filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="document.getElementById('filter-form').submit()">
                                    <option value="">All Dates</option>
                                    <option value="this_month" {{ request('date_filter') == 'this_month' ? 'selected' : '' }}>This Month</option>
                                    <option value="last_month" {{ request('date_filter') == 'last_month' ? 'selected' : '' }}>Last Month</option>
                                </select>
                            </div>
                            <div class="flex justify-end items-center">
                                <a href="{{ route('subscription.index') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-gray-300 px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-400 focus:outline-none sm:w-auto">
                                    Clear Filters
                                </a>
                            </div>
                        </div>
                    </form>
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
                    <div class="divide-y text-sm">
                        @foreach($subscribers as $subscriber)
                            <div>
                                <div class="grid grid-cols-10 items-center hover:bg-gray-50 space-x-4">
                                    <div class="col-span-1 p-2">{{$subscriber->user->full_name}}</div>
                                    <div class="col-span-2">{{ $subscriber->user->email }}</div>
                                    <div class="col-span-1">{{ $subscriber->subscriptionPlan->billing_time }}</div>
                                    <div class="col-span-1">{{ $subscriber->start_date->format('Y-m-d') }}</div>
                                    <div class="col-span-1">{{ $subscriber->end_date->format('Y-m-d') }}</div>
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
                                            @elseif ($subscriptionStatus === 'Expired')
                                                bg-red-100 text-red-700
                                            @elseif ($subscriptionStatus === 'Cancelled')
                                                bg-yellow-100 text-yellow-700
                                            @else
                                                bg-gray-100 text-gray-700
                                            @endif
                                        ">
                                            {{ $subscriptionStatus }}
                                        </span>
                                    </div>

                                    <div class="col-span-1 flex">
                                        <button onclick="openEditSubscriberModal({{ $subscriber->id }})" class="text-blue-500">Edit</button>
                                        {{-- <form action="{{route('badge.delete', $subscriber->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="block text-sm font-normal text-red-500 px-2 py-2">Delete</button>
                                        </form> --}}

                                        <!-- Edit Subscriber Modal -->
                                        <div id="editSubscriberModal-{{ $subscriber->id }}" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden items-center justify-center">
                                            <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                                                <h3 class="text-xl font-bold text-gray-800 mb-2">Edit Subscriber</h3>
                                                <form method="POST" action="{{ route('subscriptionUser.update', $subscriber->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mt-3">
                                                        <label for="start_date" class="block font-medium text-sm text-slate-600">Start Date</label>
                                                        <input id="start_date" name="start_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $subscriber->start_date->format('Y-m-d') }}" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="end_date" class="block font-medium text-sm text-slate-600">End Date</label>
                                                        <input id="end_date" name="end_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ $subscriber->end_date->format('Y-m-d') }}" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                                    </div>

                                                    <div class="mt-3">
                                                        <label for="status" class="block font-medium text-sm text-slate-600">Status</label>
                                                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                                                            <option value="Active" {{ $subscriber->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                            <option value="Expired" {{ $subscriber->status == 'Expired' ? 'selected' : '' }}>Expired</option>
                                                            <option value="Cancelled" {{ $subscriber->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        </select>

                                                    </div>

                                                    <div class="flex justify-end mt-4 space-x-2">
                                                        <button type="button" onclick="closeEditSubscriberModal({{ $subscriber->id }})" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
                                                        <button type="submit" class="px-4 py-2 bg-customYellow text-white rounded hover:bg-hovercustomYellow">Update</button>
                                                    </div>
                                                </form>
                                                <button onclick="closeEditSubscriberModal({{ $subscriber->id }})" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl"><i class="fa-solid fa-xmark"></i></button>
                                            </div>
                                        </div>

                                        <script>
                                            function openEditSubscriberModal(subscriberId) {
                                                document.getElementById(`editSubscriberModal-${subscriberId}`).classList.remove('hidden');
                                                document.getElementById(`editSubscriberModal-${subscriberId}`).classList.add('flex');
                                            }

                                            function closeEditSubscriberModal(subscriberId) {
                                                document.getElementById(`editSubscriberModal-${subscriberId}`).classList.add('hidden');
                                                document.getElementById(`editSubscriberModal-${subscriberId}`).classList.remove('flex');
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 alldata">
                    {{ $subscribers->links() }}
                </div>

                {{-- SUBSCRIPTION ANALYSIS --}}
                <div class="mb-2 border-b border-gray-200">
                    <p class="text-customYellow font-semibold text-2xl py-2">Subscription Analytics</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Displaying - Active vs Expired Subscriptions -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-500">Active vs Expired Subscriptions</h3>
                        <canvas id="subscriptionStatusChart" class="w-full h-48"></canvas>
                    </div>
                    <!-- Displaying - Monthly New Subscriptions -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-500">Monthly New Subscriptions</h3>
                        <canvas id="monthlyNewSubscriptionsChart" class="w-full h-48"></canvas>
                    </div>

                    <!-- Displaying - Revenue from Subscriptions (Monthly) -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-500">Revenue from Subscriptions (Monthly)</h3>
                        <canvas id="monthlyRevenueChart" class="w-full h-48"></canvas>
                    </div>

                    <!-- Displaying - Top Subscription Plans by Popularity -->
                    <div class="bg-white p-4 rounded shadow">
                        <h3 class="text-lg font-semibold mb-2 text-gray-500">Top Subscription Plans by Popularity</h3>
                        <canvas id="topPlansChart" class="w-full h-48"></canvas>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>;
            <script>
                const subscriptionStatusChart = new Chart(document.getElementById('subscriptionStatusChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Active', 'Expired', 'Cancelled'],
                        datasets: [{
                            data: [{{ $activeCount }}, {{ $expiredCount }}, {{ $cancelledCount }}],
                            backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
                        }]
                    }
                });

                const monthlyNewSubscriptionsChart = new Chart(document.getElementById('monthlyNewSubscriptionsChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyNewSubscriptions->map(fn($item) => $item->month . '-' . $item->year)) !!},
                        datasets: [{
                            label: 'New Subscriptions',
                            data: {!! json_encode($monthlyNewSubscriptions->pluck('count')) !!},
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    }
                });

                const monthlyRevenueChart = new Chart(document.getElementById('monthlyRevenueChart'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($monthlyRevenue->map(fn($item) => $item->month . '-' . $item->year)) !!},
                        datasets: [{
                            label: 'Revenue (NPR)',
                            data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                            borderWidth: 2,
                            borderColor: '#4CAF50',
                            backgroundColor: 'rgba(76, 175, 80, 0.2)',
                            tension: 0.4
                        }]
                    }
                });

                const topPlansChart = new Chart(document.getElementById('topPlansChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($topPlans->pluck('label')) !!},
                        datasets: [{
                            label: 'Subscribers',
                            data: {!! json_encode($topPlans->pluck('count')) !!},
                            backgroundColor: '#4F46E5', // Indigo
                        }]
                    },
                    options: {
                        indexAxis: 'y', // Horizontal Bar
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
        @endif
@endsection