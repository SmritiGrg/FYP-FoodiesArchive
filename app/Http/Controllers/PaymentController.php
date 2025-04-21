<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xentixar\EsewaSdk\Esewa;
use App\Mail\PaymentReceiptMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $transaction_uuid = strtoupper(bin2hex(random_bytes(10)));
        $user = Auth::user();

        // Save billing time in session
        session()->put('billing_time', $request->billing_time);

        $subscriptionPlan = SubscriptionPlan::where('type', 'Premium')
            ->where('billing_time', $request->billing_time)
            ->first();

        if ($subscriptionPlan) {
            $amount = $subscriptionPlan->amount;

            $esewa = new Esewa();
            $esewa->config(
                route('esewa.check'),
                route('esewa.check'),
                $amount,
                $transaction_uuid
            );
            $esewa->init();
        }
    }

    public function check(Request $request)
    {
        $esewa = new Esewa();
        $data = $esewa->decode();

        if ($data) {
            if ($data["status"] === 'COMPLETE') {
                // Payment successful, handle subscription creation
                $user = Auth::user();
                $billing_time = session()->get('billing_time'); //retriving from the session

                $subscriptionPlan = SubscriptionPlan::where('type', 'Premium')
                    ->where('billing_time', $billing_time)
                    ->first();


                // Create subscription record
                $subscription = UserSubscriber::create([
                    'user_id' => $user->id,
                    'subscription_id' => $subscriptionPlan->id,
                    'start_date' => now(),
                    'end_date' => now()->addMonths($subscriptionPlan->billing_time === 'monthly' ? 1 : 12), // Add 1 month or 1 year
                    'status' => 'Active',
                ]);

                //  Creating payment record
                $amount = str_replace(',', '', $data['total_amount']); // Clean amount
                $payment = Payment::create([
                    'subscriber_id' => $subscription->id,
                    'amount_paid' => $amount,
                    'payment_method' => 'Esewa',
                    'transaction_id' => $data['transaction_code'],
                    'status' => 'Paid',
                    'payment_date' => now(),
                ]);

                // Updating user role to premium_user 
                $user->role = 'premium_user';
                $user->save();
                session()->forget('billing_time');
                Mail::to($user->email)->send(new PaymentReceiptMail($user, $subscription, $payment));

                // Redirecting to success page with dynamic data
                return view('FoodiesArchive.paymentSuccessful', [
                    'transactionId' => $data['transaction_code'],
                    'date' => now()->format('F d, Y'),
                    'amount' => $amount
                ]);
            }
        }

        // Handling payment failure with dynamic data
        return view('FoodiesArchive.paymentFailed', [
            'transactionId' => $data['transaction_code'] ?? 'N/A',
            'date' => now()->format('F d, Y'),
            'amount' => $data['total_amount'] ?? '0.00'
        ]);
    }

    public function paymentFailed(Request $request)
    {
        // $errorMessage = $request->session()->get('error_message', 'Payment failed due to an unknown error.');
        return view('FoodiesArchive.paymentFailed');
    }
}
