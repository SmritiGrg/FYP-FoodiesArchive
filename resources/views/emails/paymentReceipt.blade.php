<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
</head>
<body>
    <h2>Thank you for your payment, {{ $user->name }}!</h2>

    <p>Here are your subscription details:</p>
    <ul>
        <li><strong>Plan:</strong> Premium ({{ $subscription->subscriptionPlan->billing_time }})</li>
        <li><strong>Amount Paid:</strong> Rs {{ $payment->amount_paid }}</li>
        <li><strong>Transaction ID:</strong> {{ $payment->transaction_id }}</li>
        <li><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($subscription->start_date)->format('F d, Y') }}</li>
        <li><strong>End Date:</strong> {{ \Carbon\Carbon::parse($subscription->end_date)->format('F d, Y') }}</li>
        <li><strong>Payment Method:</strong> {{ $payment->payment_method }}</li>
    </ul>

    <p>If you have any questions, feel free to reach out to our support team.</p>
</body>
</html>
