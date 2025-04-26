<?php

namespace App\Http\Controllers;

use App\Models\UserSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubscriptionUserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSubscriber $UserSubscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSubscriber $UserSubscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $userSubscriber = UserSubscriber::findOrFail($id);

        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:Active,Expired,Cancelled',
        ]);

        $userSubscriber->update($validatedData);

        return redirect()->route('subscription.index', ['tab' => 'subscribers'])
            ->with('message', 'Subscriber updated successfully.');
    }



    public function exportSubscribersCsv()
    {
        $subscribers = UserSubscriber::with([
            'user:id,full_name,email',
            'subscriptionPlan:id,type,billing_time',
            'payments' => function ($query) {
                $query->latest('payment_date')->limit(1);
            }
        ])->get();

        // Define CSV Header
        $csvHeader = [
            'Full Name',
            'Email',
            'Plan Duration',
            'Start Date',
            'End Date',
            'Last Payment Date',
            'Payment Status',
            'Subscription Status'
        ];

        // Build CSV data rows
        $csvData = [];
        foreach ($subscribers as $subscriber) {
            $csvData[] = [
                $subscriber->user->full_name ?? '',
                $subscriber->user->email ?? '',
                $subscriber->subscriptionPlan->billing_time ?? '',
                optional($subscriber->start_date)->format('Y-m-d'),
                optional($subscriber->end_date)->format('Y-m-d'),
                optional($subscriber->payments->first()->payment_date)->format('Y-m-d'),
                $subscriber->payments->first()->status ?? '-',
                $subscriber->status ?? '-',
            ];
        }

        // Open a memory stream
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        // Response for download
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers.csv"',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSubscriber $UserSubscriber)
    {
        //
    }
}
