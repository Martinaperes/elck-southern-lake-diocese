<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - ELCK Southern-Lake</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #197b3b;
    --primary-dark: #145f2e;
    --primary-light: #e9f5ee;
    --text-dark: #2f3e34;
    --text-muted: #6b7c72;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--primary-light), #f7faf8);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* CONTAINER */
.register-container {
    display: flex;
    max-width: 1100px;
    width: 100%;
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

/* LEFT PANEL WITH IMAGE */
.register-left {
    flex: 1;
    background:
        url('/images/register-church.jpg');
    background-size: cover;
    background-position: center;
    color: var(--white);
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* LOGO */
.logo {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.logo-icon {
    font-size: 30px;
    margin-right: 10px;
    color: #c9e9d4;
}

.logo-text {
    font-size: 24px;
    font-weight: 700;
}

/* TEXT */
.welcome-text {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 10px;
}

.subtitle {
    opacity: 0.9;
    margin-bottom: 30px;
}

/* FEATURES */
.feature {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.feature i {
    margin-right: 10px;
    color: #c9e9d4;
}

/* RIGHT PANEL */
.register-right {
    flex: 1;
    padding: 40px;
    max-height: 90vh;
    overflow-y: auto;
}

h2 {
    color: var(--text-dark);
    margin-bottom: 20px;
}

/* FORM */
.form-group {
    margin-bottom: 18px;
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
    color: var(--text-dark);
}

.input-with-icon {
    position: relative;
}

.input-with-icon i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
}

input,
select,
textarea {
    width: 100%;
    padding: 14px 15px 14px 45px;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    font-size: 15px;
}

textarea {
    padding: 14px;
    min-height: 80px;
}

input:focus,
select:focus,
textarea:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 2px rgba(25,123,59,0.15);
}

/* BUTTON */
.register-button {
    width: 100%;
    padding: 15px;
    background: var(--primary);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}

.register-button:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* LINKS */
.login-link {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: var(--text-muted);
}

.login-link a {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
}

/* ERRORS */
.error-message {
    color: #c0392b;
    font-size: 13px;
    margin-top: 5px;
}

/* MOBILE */
@media (max-width: 768px) {
    .register-container {
        flex-direction: column;
    }

    .register-left {
        padding: 30px;
        text-align: center;
    }

    .register-right {
        padding: 30px 25px;
        max-height: none;
    }

    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
</style>
</head>

<body>

<div class="register-container">

    <!-- LEFT -->
    <div class="register-left">
        <div class="logo">
            <i class="fas fa-church logo-icon"></i>
            <span class="logo-text">ELCK Southern-Lake</span>
        </div>

        <h1 class="welcome-text">Join Our Community</h1>
        <p class="subtitle">Create your ELCK Southern-Lake account</p>

        <div class="feature"><i class="fas fa-check-circle"></i> Member resources</div>
        <div class="feature"><i class="fas fa-check-circle"></i> Church community</div>
        <div class="feature"><i class="fas fa-check-circle"></i> Events & updates</div>
        <div class="feature"><i class="fas fa-check-circle"></i> Profile management</div>
    </div>

    <!-- RIGHT -->
    <div class="register-right">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h2>Account Information</h2>

            <div class="form-group">
                <label>Username *</label>
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>
                @error('name')<div class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email *</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')<div class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Password *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation" required>
                    </div>
                </div>
            </div>

            @error('password')<div class="error-message">{{ $message }}</div>@enderror

            <h2 style="margin-top:30px;">Personal Information</h2>

            <div class="form-row">
                <div class="form-group">
                    <label>First Name *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name *</label>
                    <div class="input-with-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="input-with-icon">
                        <i class="fas fa-venus-mars"></i>
                        <select name="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <div class="input-with-icon">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="phone" value="{{ old('phone') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <div class="input-with-icon">
                    <i class="fas fa-home"></i>
                    <textarea name="address">{{ old('address') }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label>Join Date</label>
                <div class="input-with-icon">
                    <i class="fas fa-calendar-check"></i>
                    <input type="date" name="joined_at" value="{{ old('joined_at') }}">
                </div>
            </div>

            <button class="register-button">Create Account</button>

            <p class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Login here</a>
            </p>

        </form>
    </div>

</div>
</body>
</html>
