@extends('auth.layouts.main')

@push('title')
    Login
@endpush

@push('css')
@endpush
@section('content')
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ asset('admin/assets/img/login.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Selamat Datang di Website Repository KP & TGA</h1>
                            <p class="account-subtitle">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
                            <h2>{{ __('Login') }}</h2>

                            @if ($errors->any())
                                <div class="mb-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mt-4">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input id="email" type="email" class="form-control  @error('email')  @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input id="password" type="password" class="form-control pass-input " name="password"
                                        required autocomplete="current-password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me">
                                            {{ __('Remember Me') }}
                                            <input id="remember" type="checkbox" name="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                        {{-- <a href="forgot-password.html">Forgot Password?</a> --}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">{{ __('Login') }}</button>

                                </div>
                            </form>

                            {{-- <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>

                            <div class="social-login">
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
