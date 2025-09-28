@extends('layouts.auth')
@section('content')
<div class="login-container d-flex justify-content-center align-items-center">
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div id="auth-errors" data-errors='@json($errors->getMessages())' class="d-none"></div>
    
    <div class="col-md-6 col-lg-4 position-relative" style="z-index: 2;">
        <div class="glass-card">
            <div class="card-header text-center">
                <h4>Login</h4>
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
                        <label for="email" class="form-label">Alamat Email</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" autofocus
                            placeholder="Enter your email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message == 'The email field is required.' ? 'Alamat email tidak boleh kosong.' : $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" 
                            placeholder="Enter your password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message == 'The password field is required.' ? 'Password tidak boleh kosong.' : $message }}
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
               
                
            </div>
        </div>
    </div>
</div>

@endsection