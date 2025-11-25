<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - ELCK Southern-Lake</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Use the same styles as your registration page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .verification-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }
        
        .verification-icon {
            font-size: 64px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 15px;
        }
        
        p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .resend-button {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .resend-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(76, 175, 80, 0.3);
        }
        
        .message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-icon">
            <i class="fas fa-envelope-circle-check"></i>
        </div>
        
        <h1>Verify Your Email Address</h1>
        
        @if (session('status') == 'verification-link-sent')
            <div class="message">
                <i class="fas fa-check-circle"></i> A fresh verification link has been sent to your email address.
            </div>
        @endif
        
        <p>
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you at <strong>{{ Auth::user()->email }}</strong>? If you didn't receive the email, we will gladly send you another.
        </p>
        
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="resend-button">
                <i class="fas fa-paper-plane"></i> Resend Verification Email
            </button>
        </form>
    </div>
</body>
</html>