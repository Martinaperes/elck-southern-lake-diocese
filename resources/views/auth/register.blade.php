<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ELCK Southern-Lake</title>
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
        
        .register-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .register-left {
            flex: 1;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .register-right {
            flex: 1;
            padding: 40px;
            max-height: 90vh;
            overflow-y: auto;
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
        
        .form-row {
            display: flex;
            gap: 15px;
        }
        
        .form-row .form-group {
            flex: 1;
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
        
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
            outline: none;
        }
        
        textarea {
            padding: 15px;
            min-height: 80px;
            resize: vertical;
        }
        
        .register-button {
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
            margin-top: 10px;
        }
        
        .register-button:hover {
            background: linear-gradient(135deg, #45a049 0%, #4CAF50 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(76, 175, 80, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }
        
        .login-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }
            
            .register-left {
                padding: 30px;
            }
            
            .register-right {
                padding: 30px 25px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .success-message {
            color: #27ae60;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <div class="logo">
                <i class="fas fa-church logo-icon"></i>
                <span class="logo-text">ELCK Southern-Lake</span>
            </div>
            <h1 class="welcome-text">Join Our Community</h1>
            <p class="subtitle">Create your ELCK Southern-Lake account</p>
            
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
                <div class="feature">
                    <i class="fas fa-check-circle"></i>
                    <span>Manage your profile</span>
                </div>
            </div>
        </div>
        
        <div class="register-right">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <h2 style="color: #333; margin-bottom: 20px;">Account Information</h2>
                
                <div class="form-group">
                    <label for="name">Username *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Choose a username">
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" required placeholder="Create password">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password *</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password">
                        </div>
                    </div>
                </div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
                
                <h2 style="color: #333; margin: 30px 0 20px 0;">Personal Information</h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required placeholder="First name">
                        </div>
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <div class="input-with-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required placeholder="Last name">
                        </div>
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <div class="input-with-icon">
                            <i class="fas fa-calendar"></i>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <div class="input-with-icon">
                            <i class="fas fa-venus-mars"></i>
                            <select id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone number">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address">Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-home"></i>
                        <textarea id="address" name="address" placeholder="Your address">{{ old('address') }}</textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="joined_at">Join Date</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar-check"></i>
                        <input type="date" id="joined_at" name="joined_at" value="{{ old('joined_at') }}">
                    </div>
                </div>
                
                <button type="submit" class="register-button">
                    Create Account
                </button>
                
                <p class="login-link">
                    Already have an account? 
                    <a href="{{ route('login') }}">Login here</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // Set today's date as default for joined_at if empty
        document.addEventListener('DOMContentLoaded', function() {
            const joinedAtField = document.getElementById('joined_at');
            if (joinedAtField && !joinedAtField.value) {
                const today = new Date().toISOString().split('T')[0];
                joinedAtField.value = today;
            }
        });
    </script>
</body>
</html>