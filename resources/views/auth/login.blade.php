<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - ELCK Southern-Lake</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
    --primary: #197b3b;
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

/* MAIN CONTAINER */
.login-container {
    display: flex;
    max-width: 900px;
    width: 100%;
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.12);
}

/* LEFT PANEL */
.login-left {
    flex: 1;
    background: 
        url('/images/login-church.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #ffffff;
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}


.logo {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.logo-icon {
    font-size: 30px;
    margin-right: 10px;
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
    opacity: 0.9;
    margin-bottom: 30px;
}

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
.login-right {
    flex: 1;
    padding: 50px 40px;
}

.form-group {
    margin-bottom: 20px;
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

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 14px 15px 14px 45px;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    font-size: 16px;
}

input:focus {
    border-color: var(--primary);
    outline: none;
    box-shadow: 0 0 0 2px rgba(25,123,59,0.15);
}

.options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 10px;
}

.remember {
    display: flex;
    align-items: center;
    font-size: 14px;
}

.remember input {
    margin-right: 6px;
}

.forgot-password {
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
}

.forgot-password:hover {
    text-decoration: underline;
}

/* BUTTON */
.login-button {
    width: 100%;
    padding: 15px;
    background: var(--primary);
    color: var(--white);
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.login-button:hover {
    background: #145f2e;
    transform: translateY(-2px);
}

/* DIVIDER */
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
    font-size: 14px;
    color: var(--text-muted);
}

/* SOCIAL */
.social-login {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    transition: 0.3s;
}

.social-btn:hover {
    background: var(--primary);
    color: var(--white);
}

/* REGISTER */
.register-link {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: var(--text-muted);
}

.register-link a {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}

/* MOBILE RESPONSIVENESS */
@media (max-width: 768px) {
    .login-container {
        flex-direction: column;
    }

    .login-left {
        padding: 30px;
        text-align: center;
    }

    .welcome-text {
        font-size: 26px;
    }

    .login-right {
        padding: 30px 25px;
    }
}

@media (max-width: 480px) {
    body {
        padding: 10px;
    }

    .login-right {
        padding: 25px 20px;
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
        <p class="subtitle">Sign in to your account</p>

        <div class="feature"><i class="fas fa-check-circle"></i> Member resources</div>
        <div class="feature"><i class="fas fa-check-circle"></i> Church community</div>
        <div class="feature"><i class="fas fa-check-circle"></i> Events & updates</div>
    </div>

    <div class="login-right">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" required placeholder="Enter your email">
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" required placeholder="Enter your password">
                </div>
            </div>

            <div class="options">
                <label class="remember">
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a class="forgot-password" href="{{ route('password.request') }}">Forgot password?</a>
            </div>

            <button class="login-button">Login</button>

            

            <p class="register-link">
                Don’t have an account?
                <a href="{{ route('register') }}">Create an account</a>
            </p>
        </form>
    </div>

</div>
</body>
</html>
