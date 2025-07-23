@extends('layouts.auth')
@section('content')
<style>
    .login-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" style="stop-color:rgba(255,255,255,0.1)"/><stop offset="100%" style="stop-color:rgba(255,255,255,0)"/></radialGradient></defs><circle cx="200" cy="200" r="150" fill="url(%23a)"/><circle cx="800" cy="300" r="200" fill="url(%23a)"/><circle cx="400" cy="700" r="180" fill="url(%23a)"/></svg>') no-repeat center center;
        background-size: cover;
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
    }
    
    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s;
    }
    
    .glass-card:hover::before {
        left: 100%;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .card-header {
        background: transparent;
        border: none;
        padding: 2rem 2rem 1rem;
    }
    
    .card-header h4 {
        color: white;
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        to {
            text-shadow: 0 2px 20px rgba(255, 255, 255, 0.5);
        }
    }
    
    .card-body {
        padding: 1rem 2rem 2rem;
    }
    
    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 15px;
        color: white;
        padding: 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .form-control:focus {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .form-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        border: none;
        border-radius: 50px;
        padding: 1rem 3rem;
        font-weight: 600;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(238, 90, 36, 0.3);
    }
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(238, 90, 36, 0.4);
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }
    
    .btn-primary:active {
        transform: translateY(-1px);
    }
    
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .form-check-input {
        width: 20px;
        height: 20px;
        margin-right: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 4px;
    }
    
    .form-check-input:checked {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        border-color: #ee5a24;
    }
    
    .form-check-label {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    
    .form-check-label:hover {
        color: white;
    }
    
    .text-decoration-none {
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .text-decoration-none::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        transition: width 0.3s ease;
    }
    
    .text-decoration-none:hover {
        color: white;
        text-decoration: none;
    }
    
    .text-decoration-none:hover::after {
        width: 100%;
    }
    
    .register-link {
        color: rgba(255, 255, 255, 0.8);
    }
    
    .register-link a {
        color: #ff6b6b;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .register-link a:hover {
        color: #ee5a24;
        text-decoration: none;
    }
    
    .invalid-feedback {
        color: #ff4757;
        background: rgba(255, 71, 87, 0.1);
        padding: 0.5rem;
        border-radius: 8px;
        margin-top: 0.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 71, 87, 0.3);
    }
    
    .is-invalid {
        border-color: #ff4757 !important;
        box-shadow: 0 0 15px rgba(255, 71, 87, 0.3) !important;
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .shape {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: floatShapes 15s infinite linear;
    }
    
    .shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .shape:nth-child(2) {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 10%;
        animation-delay: -5s;
    }
    
    .shape:nth-child(3) {
        width: 60px;
        height: 60px;
        bottom: 20%;
        left: 20%;
        animation-delay: -10s;
    }
    
    @keyframes floatShapes {
        0% {
            transform: translateY(0px) rotate(0deg);
            opacity: 1;
        }
        50% {
            transform: translateY(-100px) rotate(180deg);
            opacity: 0.8;
        }
        100% {
            transform: translateY(0px) rotate(360deg);
            opacity: 1;
        }
    }
    
    @media (max-width: 768px) {
        .card-header h4 {
            font-size: 1.5rem;
        }
        
        .glass-card {
            margin: 1rem;
        }
        
        .btn-primary {
            padding: 0.8rem 2rem;
            font-size: 1rem;
        }
    }
</style>

<div class="login-container d-flex justify-content-center align-items-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="col-md-6 col-lg-4 position-relative" style="z-index: 2;">
        <div class="glass-card">
            <div class="card-header text-center">
                <h4>{{ __('Welcome Back') }}</h4>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Enter your email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password"
                            placeholder="Enter your password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary px-5">
                            {{ __('Login') }}
                        </button>
                    </div>
                    @if (Route::has('password.request'))
                    <div class="text-center mb-3">
                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                    @endif
                </form>
               
                <div class="text-center register-link">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced JavaScript --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Focus on error fields
        @if ($errors->has('email'))
        const emailField = document.getElementById("email");
        emailField.focus();
        emailField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        @elseif ($errors->has('password'))
        const passwordField = document.getElementById("password");
        passwordField.focus();
        passwordField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        @endif
        
        // Add interactive effects
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
        
        // Button ripple effect
        const button = document.querySelector('.btn-primary');
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
        
        // Add ripple CSS
        const style = document.createElement('style');
        style.textContent = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: rippleAnimation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes rippleAnimation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection