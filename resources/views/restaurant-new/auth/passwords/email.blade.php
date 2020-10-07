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
                            <h5 class="text-muted font-weight-normal mb-4">Enter Your Email Address </h5>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form class="form-horizontal" role="form" method="POST"
                            action="{{ route('restaurant.send-password-reset-link') }}">
                            {{ csrf_field() }}

                                <div  class="form-group">
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

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0"> Send Password Reset Link</button>
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