<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'billing_time' => 'required|in:monthly,yearly,lifetime',
            'amount' => 'required|integer|min:50',
            'features' => 'required|string',
        ]);

        SubscriptionPlan::create([
            'type' => $request->type,
            'billing_time' => $request->billing_time,
            'amount' => $request->amount,
            'features' => array_map('trim', explode(',', $request->features)),
        ]);

        return redirect()->route('subscription.index', ['tab' => 'plans'])->with('message', 'Subscription Plan Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'billing_time' => 'required|in:monthly,yearly,lifetime',
            'amount' => 'required|integer|min:0',
            'features' => 'required|string',
        ]);

        $plan = SubscriptionPlan::findOrFail($id);
        $plan->update([
            'type' => $request->type,
            'billing_time' => $request->billing_time,
            'amount' => $request->amount,
            'features' => json_encode(array_map('trim', explode(',', $request->features))),
        ]);

        return redirect()->route('subscription.index', ['tab' => 'plans'])->with('message', 'Subscription Plan Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->delete();

        return redirect()->route('subscription.index', ['tab' => 'plans'])->with('message', 'Subscription Plan Deleted Successfully');
    }
}
