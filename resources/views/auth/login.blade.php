@extends('layouts.app')

@section('content')
<style>
    .card-header{
        background-color: #EAF1FF !important;
    }
    .navbar.navbar-expand-md.navbar-light.shadow-sm.bg-navy,button.btn._btn-primary.btn-block{
        background-color: #1A47A3 !important;
    }
    .btn.btn-link.text-center.text-decoration-none{
        color: #1A47A3 !important;
    }
    .w-55{
        width: 55% !important;
    }
    .eye-toggle {
        position: absolute;
    bottom: 10px;
    cursor: pointer;
    right: 20px;
    height: 15px;
    width: 15px;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card _shadow-1 border-0">
                    <div class="card-header text-center bg-navy p-4">

                        <div class="p-1">
                            <img src="{{asset('assets/images/new_logo.svg')}}" class="img-fluid w-55">
                        </div>

                    </div>

                    <div class="card-body">

                        <h3 class="my-3 _text-primary text-center">{{ __('Sign In') }}</h3>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-1">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                                <div class="">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                <div class="form-group" style="position: relative;">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password" >
                                           <svg class="eye-toggle" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 18 18" fill="none">
                                            <path d="M11.8125 9C11.8125 9.74592 11.5162 10.4613 10.9887 10.9887C10.4613 11.5162 9.74592 11.8125 9 11.8125C8.25408 11.8125 7.53871 11.5162 7.01126 10.9887C6.48382 10.4613 6.1875 9.74592 6.1875 9C6.1875 8.25408 6.48382 7.53871 7.01126 7.01126C7.53871 6.48382 8.25408 6.1875 9 6.1875C9.74592 6.1875 10.4613 6.48382 10.9887 7.01126C11.5162 7.53871 11.8125 8.25408 11.8125 9Z" fill="#2A2D34"></path>
                                            <path d="M0 9C0 9 3.375 2.8125 9 2.8125C14.625 2.8125 18 9 18 9C18 9 14.625 15.1875 9 15.1875C3.375 15.1875 0 9 0 9ZM9 12.9375C10.0443 12.9375 11.0458 12.5227 11.7842 11.7842C12.5227 11.0458 12.9375 10.0443 12.9375 9C12.9375 7.95571 12.5227 6.95419 11.7842 6.21577C11.0458 5.47734 10.0443 5.0625 9 5.0625C7.95571 5.0625 6.95419 5.47734 6.21577 6.21577C5.47734 6.95419 5.0625 7.95571 5.0625 9C5.0625 10.0443 5.47734 11.0458 6.21577 11.7842C6.95419 12.5227 7.95571 12.9375 9 12.9375Z" fill="#2A2D34"></path>
                                        </svg>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn _btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))

                                        <div class="text-center mt-2">
                                            <a class="btn btn-link text-center text-decoration-none"
                                               href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>

                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".eye-toggle").click(function() {
                // $(this).toggleClass("fa-eye fa-eye-slash");
                input = $('#password');
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
    </script>
@endsection
