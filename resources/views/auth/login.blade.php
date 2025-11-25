<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ELCK Southern-Lake</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
        
        .login-container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-right {
            flex: 1;
            padding: 50px 40px;
        }
        
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            font-size: 28px;
            margin-right: 10px;
            color: #4CAF50;
        }
        
        .logo-text {
            font-size: 24px;
            font-weight: 700;
        }
        
        .welcome-text {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 30px;
        }
        
        .features {
            margin-top: 30px;
        }
        
        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .feature i {
            margin-right: 10px;
            color: #4CAF50;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }
        
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .remember {
            display: flex;
            align-items: center;
        }
        
        .remember input {
            margin-right: 8px;
        }
        
        .forgot-password {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(76, 175, 80, 0.2);
        }
        
        .login-button:hover {
            background: linear-gradient(135deg, #45a049 0%, #4CAF50 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(76, 175, 80, 0.3);
        }
        
        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }
        
        .register-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        
        .divider-text {
            padding: 0 15px;
            color: #777;
            font-size: 14px;
        }
        
        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #555;
            font-size: 18px;
            transition: all 0.3s;
        }
        
        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .facebook:hover {
            background: #3b5998;
            color: white;
        }
        
        .google:hover {
            background: #dd4b39;
            color: white;
        }
        
        .twitter:hover {
            background: #1da1f2;
            color: white;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-left {
                padding: 30px;
            }
            
            .login-right {
                padding: 30px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="logo">
                <i class="fas fa-church logo-icon"></i>
                <span class="logo-text">ELCK Southern-Lake</span>
            </div>
            <h1 class="welcome-text">Welcome Back</h1>
            <p class="subtitle">Sign in to your ELCK Southern-Lake account</p>
            
            <div class="features">
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Access member resources</span>
                </div>
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Connect with your community</span>
                </div>
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Stay updated with events</span>
                </div>
            </div>
        </div>
        
        <div class="login-right">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                
                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span>Remember me</span>
                    </label>
                    
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                </div>
                
                <button type="submit" class="login-button">
                    Login
                </button>
                
                <div class="divider">
                    <span class="divider-text">Or continue with</span>
                </div>
                
                <div class="social-login">
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-btn twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
                
                <p class="register-link">
                    Don't have an account? 
                    <a href="{{ route('register') }}">Register here</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>