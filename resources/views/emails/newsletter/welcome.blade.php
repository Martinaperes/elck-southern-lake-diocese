{{-- resources/views/emails/newsletter/welcome.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Newsletter</title>
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
        .welcome-message {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #0fbd0f;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        .feature {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #e7f3e7;
        }
        .feature-icon {
            color: #0fbd0f;
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Our Diocesan Family!</h1>
        </div>
        
        <div class="content">
            <div class="welcome-message">
                <p>Dear {{ $subscriber->name ?? 'Beloved in Christ' }},</p>
                
                <p><strong>Shalom!</strong> We rejoice with you as you join our newsletter community. Your subscription has been confirmed, and we're excited to have you as part of the ELCK Southern Lake Diocese family.</p>
                
                <p>As it is written in <strong>Psalm 133:1</strong>: <em>"How good and pleasant it is when God's people live together in unity!"</em></p>
            </div>
            
            <h3>Here's what you can expect:</h3>
            
            <div class="feature">
                <div style="display: flex; align-items: center;">
                    <span class="feature-icon">📖</span>
                    <div>
                        <strong>Weekly Sermons</strong>
                        <p style="margin: 5px 0 0 0; color: #666;">Spiritual nourishment from our Sunday services</p>
                    </div>
                </div>
            </div>
            
            <div class="feature">
                <div style="display: flex; align-items: center;">
                    <span class="feature-icon">📅</span>
                    <div>
                        <strong>Event Updates</strong>
                        <p style="margin: 5px 0 0 0; color: #666;">Never miss important diocesan gatherings</p>
                    </div>
                </div>
            </div>
            
            <div class="feature">
                <div style="display: flex; align-items: center;">
                    <span class="feature-icon">🙏</span>
                    <div>
                        <strong>Prayer Points</strong>
                        <p style="margin: 5px 0 0 0; color: #666;">Join us in prayer for our diocese and communities</p>
                    </div>
                </div>
            </div>
            
            <div class="feature">
                <div style="display: flex; align-items: center;">
                    <span class="feature-icon">🎉</span>
                    <div>
                        <strong>Testimonies & Celebrations</strong>
                        <p style="margin: 5px 0 0 0; color: #666;">Share in the joys of our church family</p>
                    </div>
                </div>
            </div>
            
            <div style="background-color: #e7f3e7; padding: 15px; border-radius: 5px; margin-top: 20px;">
                <p><strong>Your Information:</strong></p>
                <p>Email: {{ $subscriber->email }}</p>
                @if($subscriber->parish)
                    <p>Parish: {{ ucfirst($subscriber->parish) }}</p>
                @endif
                <p>Subscription Date: {{ $subscriber->subscribed_at->format('F j, Y') }}</p>
            </div>
            
            <p style="margin-top: 20px;">If you ever wish to unsubscribe, you can do so at any time by clicking the link below:</p>
            <p style="text-align: center;">
                <a href="{{ $unsubscribeUrl }}" style="color: #0fbd0f;">Unsubscribe</a>
            </p>
            
            <p style="text-align: center; font-style: italic; margin-top: 30px;">
                "May the grace of our Lord Jesus Christ, and the love of God, and the fellowship of the Holy Spirit be with you all."<br>
                <strong>— 2 Corinthians 13:14</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>ELCK Southern Lake Diocese Newsletter</p>
            <p>© {{ date('Y') }} Evangelical Lutheran Church in Kenya</p>
            <p>To manage your subscription preferences, <a href="{{ $unsubscribeUrl }}">click here</a></p>
        </div>
    </div>
</body>
</html>