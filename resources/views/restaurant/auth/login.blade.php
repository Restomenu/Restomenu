@extends('restaurant.layouts.auth')

@section('title','Login')

@section('content')
<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">

            {{-- <div class="ibox-title">
                <h3 class="font-bold">Sign in</h3>
            </div> --}}
            <div class="text-center ">
                <h1 class="logo-name"><img src="{{asset("admin/images/Logo.png")}}" width="150"
                        style="margin-right: 30px;"></h1>
            </div>
            <h3 class="text-center ">Welcome to the Restomenu Admin</h3>
            <p class="text-center ">Login in. To see it in action.</p>
            <div class="ibox-content text-left">
                <form class="form-horizontal m-t" role="form" method="POST" action="{{ route('restaurant.login') }}"
                    id="loginForm">

                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control  @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" autofocus autocomplete="email" value="{{ old('email') }}">

                        @error('email')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" name="password">

                        @error('password')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                    {{-- <div class="form-group row">
                        <div class="col-md-6">
                            <a href="{{ url('/password/reset') }}" class="">Forgot password?</a>
            </div>
        </div> --}}

        </form>
    </div>

</div>
</div>
</div>
@endsection