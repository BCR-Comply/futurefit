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
</style>
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

                        <h3 class="my-3 _text-primary text-center">{{ __('Reset Password') }}</h3>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                                <div class="form-group">
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

                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn _btn-primary btn-block">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
