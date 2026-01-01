{{-- resources/views/emails/newsletter/confirmation.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Your Subscription</title>
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #197b3b;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f6f8f6;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .button {
            display: inline-block;
            background-color: #0fbd0f;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .church-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="church-icon">⛪</div>
            <h1>ELCK Southern Lake Diocese</h1>
        </div>
        
        <div class="content">
            <h2>Confirm Your Newsletter Subscription</h2>
            
            <p>Hello {{ $subscriber->name ?? 'Subscriber' }},</p>
            
            <p>Thank you for subscribing to the ELCK Southern Lake Diocese newsletter!</p>
            
            <p>To complete your subscription and start receiving our weekly sermons, event updates, and spiritual encouragement, please confirm your email address by clicking the button below:</p>
            
            <div style="text-align: center;">
                <a href="{{ $confirmationUrl }}" class="button">
                    Confirm Subscription
                </a>
            </div>
            
            <p>If the button doesn't work, copy and paste this link into your browser:</p>
            <p style="word-break: break-all; background-color: #eee; padding: 10px; border-radius: 4px;">
                {{ $confirmationUrl }}
            </p>
            
            <p>Once confirmed, you'll receive:</p>
            <ul>
                <li>Weekly sermon summaries and reflections</li>
                <li>Upcoming event announcements</li>
                <li>Diocese news and updates</li>
                <li>Spiritual encouragement and devotionals</li>
            </ul>
            
            <p><strong>Note:</strong> If you didn't request this subscription, please ignore this email or click below to unsubscribe.</p>
            
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ $unsubscribeUrl }}" style="color: #666; font-size: 12px;">
                    Unsubscribe
                </a>
            </p>
        </div>
        
        <div class="footer">
            <p>ELCK Southern Lake Diocese</p>
            <p>© {{ date('Y') }} Evangelical Lutheran Church in Kenya. All rights reserved.</p>
            <p>This email was sent to {{ $subscriber->email }}</p>
        </div>
    </div>
</body>
</html>