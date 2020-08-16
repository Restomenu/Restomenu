@extends('admin.layouts.auth')

@section('title','Password Reset')

@section('content')

<div class="passwordBox animated fadeInDown">
    <div class="ibox-content">
        <h3>Reset Password</h3>

        <form class="form-horizontal m-t" role="form" method="POST" action="{{ url('/password/reset') }}"
            id="passResetForm">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="E-Mail Address" name="email" autofocus autocomplete="email"
                    value="{{ $email ?? old('email') }}">

                @error('email')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" id="password">

                @error('password')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    placeholder="Confirm Password" name="password_confirmation">

                @error('password_confirmation')
                <span class="invalid-feedback text-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Reset Password</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $("#passResetForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
                minlength: 6,
            }
        },
        messages: {
            email: {
                required: "Email address is required.",
                email: "please enter a valid email address."
            },
            password: {
                required: "Password is required.",
                minlength: "Password must be 6 characters long.",
            },
            password_confirmation: {
                required: "Please enter confirm password.",
                minlength: "Password must be 6 characters long.",
                equalTo: "Confirm password doesn't match."
            }
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback text-left',
    });
</script>
@endpush