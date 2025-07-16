@extends('layouts.auth')

@section('content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header text-center">
                <h4>{{ __('Login') }}</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                            name="password" required autocomplete="current-password">

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

                <div class="text-center mb-3">
                    <a href="{{ route('auth.google') }}" class="btn btn-danger px-4">
                        {{ __('Continue with Google') }}
                    </a>
                </div>

                <div class="text-center">
                    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Fokus ke kolom error --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->has('email'))
        document.getElementById("email").focus();
        @elseif ($errors->has('password'))
        document.getElementById("password").focus();
        @endif
    });
</script>
@endsection
