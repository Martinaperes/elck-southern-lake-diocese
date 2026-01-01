{{-- resources/views/emails/newsletter/campaign.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->subject }}</title>
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f6f8f6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
        }
        .header {
            background-color: #197b3b;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .footer {
            background-color: #102210;
            color: #e7f3e7;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }
        h1, h2, h3 {
            color: #197b3b;
            font-family: 'Noto Serif', serif;
        }
        .btn {
            display: inline-block;
            background-color: #0fbd0f;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            margin: 10px 0;
        }
        .scripture {
            background-color: #e7f3e7;
            padding: 15px;
            border-left: 4px solid #0fbd0f;
            margin: 20px 0;
            font-style: italic;
        }
        .event {
            border: 1px solid #cfe7cf;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
            background-color: #f9fcf9;
        }
        .unsubscribe {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        /* Tracking pixel (invisible) */
        .tracking-pixel {
            height: 1px;
            width: 1px;
            opacity: 0;
        }
    </style>
</head>
<body>
    <!-- Open tracking pixel -->
    <img src="{{ $trackingPixel }}" alt="" class="tracking-pixel" />
    
    <div class="container">
        <div class="header">
            <h1>ELCK Southern Lake Diocese</h1>
            <p>{{ $campaign->subject }}</p>
            <p style="font-size: 12px; opacity: 0.8;">{{ $campaign->sent_at?->format('F j, Y') ?? date('F j, Y') }}</p>
        </div>
        
        <div class="content">
            <!-- Email content from the campaign -->
            {!! $campaign->content !!}
            
            <!-- Convert links to tracking links -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var links = document.querySelectorAll('a');
                    links.forEach(function(link) {
                        if (link.href && !link.href.includes('{{ config('app.url') }}') && 
                            !link.href.includes('mailto:') && !link.href.includes('tel:')) {
                            var url = new URL('{{ $trackingUrl }}');
                            url.searchParams.set('url', encodeURIComponent(link.href));
                            link.href = url.toString();
                        }
                    });
                });
            </script>
            
            <div class="unsubscribe">
                <p style="font-size: 12px; color: #666;">
                    You are receiving this email because you subscribed to the ELCK Southern Lake Diocese newsletter.<br>
                    To unsubscribe, <a href="{{ $unsubscribeUrl }}" style="color: #0fbd0f;">click here</a>.
                </p>
                <p style="font-size: 10px; color: #999; margin-top: 10px;">
                    This email was sent to {{ $subscriber->email }}
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p>ELCK Southern Lake Diocese</p>
            <p>© {{ date('Y') }} Evangelical Lutheran Church in Kenya</p>
            <p style="font-size: 11px; opacity: 0.7;">
                "For I know the plans I have for you," declares the LORD, "plans to prosper you and not to harm you, plans to give you hope and a future." — Jeremiah 29:11
            </p>
        </div>
    </div>
</body>
</html>