@extends('admin.layouts.auth')

@section('title','Password Reset')

<!-- Main Content -->
@section('content')

<div class="passwordBox animated fadeInDown">
    <div class="row">
        <div class="col-md-12">

            <div class="ibox-title">
                <h3 class="font-bold">Forgot password</h3>
            </div>
            <div class="ibox-content text-left">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <p>
                    Enter your email address, Reset password link will be emailed to you.
                </p>
                <form class="m-t" role="form" method="POST" action="{{ url('/password/email') }}"
                    id="forgotPassForm">

                    @csrf

                    <div class="form-group">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="E-Mail Address" name="email" autofocus autocomplete="email"
                            value="{{ old('email') }}">

                        @error('email')
                        <span class="invalid-feedback text-left" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <button type="submit" class="btn btn-primary block full-width m-b">Send Reset Password Link</button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $("#forgotPassForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        },
        messages: {
            email: {
                required: "Email address is required.",
                email: "please enter a valid email address."
            },
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