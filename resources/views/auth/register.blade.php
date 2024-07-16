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
                            <h1>{{ __('Registrasi') }}</h1>
                            <p class="account-subtitle">Lengkapi untuk membuat akun!</p>

                            @if ($errors->any())
                                <div class="mb-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Nama Lengkap <span class="login-danger">*</span></label>
                                    <input id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" type="text" autofocus required autocomplete="name">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" type="email" required autocomplete="email">
                                    <span class="profile-views"><i class="fas fa-envelope"></i></span>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input id="password" name="password" class="form-control @error('password') @enderror"
                                        name="password" type="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="profile-views feather-eye toggle-password"></span>


                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi password <span class="login-danger">*</span></label>
                                    <input id="password-confirm" name="password_confirmation"
                                        class="form-control pass-confirm" type="password" required
                                        autocomplete="new-password">
                                    <span class="profile-views feather-eye reg-toggle-password"></span>
                                </div>
                                <div class=" dont-have">Sudah Terdaftar? <a href="{{ route('login') }}">Login</a></div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block"
                                        type="submit">{{ __('Registrasi') }}</button>
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
