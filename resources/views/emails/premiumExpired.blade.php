<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Expired</title>
</head>
<body>
    <h2>Hello {{ $user->full_name }},</h2>
    <p>We wanted to let you know that your <strong>Premium Subscription</strong> has expired.</p>
    <p>If you’d like to continue enjoying premium features like daily streak bonuses, exclusive badges, and more, you can renew your subscription anytime.</p>

    <a href="{{ url('/premium') }}" style="display: inline-block; padding: 10px 20px; background: #10b981; color: white; text-decoration: none; border-radius: 5px;">Renew Now</a>

    <p>Thanks,<br>Foodies Archive</p>
</body>
</html>
