@extends('restaurant-new.layouts.auth')

@section('title','Login')

@section('content')

<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-8 col-xl-6 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-md-4 pr-md-0">
                        <div class="auth-left-wrapper"
                            style="background-image: url({{ url('restaurant-new/images/food_219x452.jpg') }})">
                        </div>
                    </div>
                    <div class="col-md-8 pl-md-0">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Resto<span>Menu</span></a>
                            <h5 class="text-muted font-weight-normal mb-4">Welcome back! Log in to your account.</h5>
                            <form class="forms-sample" role="form" method="POST"
                                action="{{ route('restaurant.login') }}" id="loginForm">

                                @csrf

                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        placeholder="Email" name="email" autofocus autocomplete="email"
                                        value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password">

                                    @error('password')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        Remember me
                                    </label>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</button>
                                  <a href="{{ route('restaurant.password-reset-form') }}"><small>Forgot password?</small></a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection