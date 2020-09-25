@extends('restaurant-new.layouts.auth')

@section('title','Register')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">
    <div class="row w-100 mx-0 auth-page">
        <div class="col-md-11 col-xl-10 mx-auto">
            <div class="card">
                <div class="row">
                    <div class="col-lg-4 pr-lg-0">
                        <div class="auth-left-wrapper"
                            style="background-image: url({{ url('restaurant-new/images/food_219x452.jpg') }})">
                        </div>
                    </div>
                    <div class="col-lg-8 pl-lg-0 ">
                        <div class="auth-form-wrapper px-4 py-5">
                            <a href="#" class="noble-ui-logo d-block mb-2">Resto<span>Menu</span></a>

                            <form class="forms-sample" role="form" method="POST"
                                action="{{ route('restaurant.register') }}" id="registerForm"
                                enctype="multipart/form-data">

                                <div class="card-body">

                                    @csrf

                                    <h3>{{__('Registration')}}</h3>

                                    <section class="px-0">

                                        <h5 class="text-muted font-weight-normal mb-4">
                                            {{__('Let\'s get to know your restaurant a little better, that way we can optimize our platform to your needs.')}}
                                        </h5>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="site_name">{{__('Restaurant name')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('site_name') is-invalid @enderror"
                                                        name="site_name" autofocus autocomplete="site_name"
                                                        value="{{ old('site_name') }}">

                                                    @error('site_name')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">

                                                    <label for="phone">{{__('Restaurant contact number')}}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="">+32</span>
                                                        </div>
                                                        <input type="text" id="restaurantPhone"
                                                            class="form-control  @error('phone') is-invalid @enderror"
                                                            name="phone" autofocus autocomplete="phone"
                                                            value="{{ old('phone') }}">
                                                    </div>
                                                    @error('phone')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="slug">{{__('Restaurant website')}}</label>
                                                    <input type="text"
                                                        class="form-control  @error('slug') is-invalid @enderror"
                                                        name="slug" autofocus autocomplete="slug"
                                                        value="{{ old('slug') }}">

                                                    @error('slug')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="restaurant_type_id">{{__('Restaurant type')}}</label>

                                                    {{ Form::select('restaurant_type_id', ['1'=>'one','2'=>'two'], null, ['id'=>'restaurant_type_id',"class"=>"form-control". ($errors->first('restaurant_type_id') ? ' is-invalid':''),"placeholder"=>__('Select Restaurant Type')]) }}

                                                    @error('restaurant_type_id')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="number_of_employees">{{__('Employees')}}</label>
                                                    <input type="number" id="number_of_employees"
                                                        class="form-control  @error('number_of_employees') is-invalid @enderror"
                                                        min="0" name="number_of_employees" autofocus
                                                        autocomplete="number_of_employees"
                                                        value="{{ old('number_of_employees') }}">

                                                    @error('number_of_employees')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fb_url">{{__('Facebook link')}}</label>

                                                    <input type="text"
                                                        class="form-control  @error('fb_url') is-invalid @enderror"
                                                        name="fb_url" autofocus autocomplete="fb_url"
                                                        value="{{ old('fb_url') }}">

                                                    @error('fb_url')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="ig_url">{{__('Instagram link')}}</label>

                                                    <input type="text"
                                                        class="form-control  @error('ig_url') is-invalid @enderror"
                                                        name="ig_url" autofocus autocomplete="ig_url"
                                                        value="{{ old('ig_url') }}">

                                                    @error('ig_url')
                                                    <span class="invalid-feedback text-left" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="site_logo">{{__('Restaurant logo')}}</label>

                                        <input type="file" class="form-control @error('site_logo') is-invalid @enderror"
                                            placeholder="{{__('Restaurant logo')}}" name="site_logo" autofocus
                                            autocomplete="ig_url" value="{{ old('site_logo') }}">

                                        @error('site_logo')
                                        <span class="invalid-feedback text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                        </div>
                    </div> --}}

                    </section>

                    <h3>{{__('Billing')}}</h3>
                    <section class="px-0">

                        <h5 class="text-muted font-weight-normal mb-4">
                            {{__("we're not going to let you wait in excitement for much longer, you're nearly there!")}}
                        </h5>

                        {{-- firstname --}}
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">{{__('First name')}}</label>

                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        name="first_name" autofocus autocomplete="first_name"
                                        value="{{ old('first_name') }}">

                                    @error('first_name')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">{{__('Last name')}}</label>

                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                        name="last_name" autofocus autocomplete="last_name"
                                        value="{{ old('last_name') }}">

                                    @error('last_name')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="VAT_number">{{__('VAT number')}}</label>

                                    <input type="text" class="form-control @error('VAT_number') is-invalid @enderror"
                                        name="VAT_number" autofocus autocomplete="VAT_number"
                                        value="{{ old('VAT_number') }}">

                                    @error('VAT_number')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="street_and_house_number">{{__('Street and number')}}</label>

                                    <input type="text"
                                        class="form-control @error('street_and_house_number') is-invalid @enderror"
                                        name="street_and_house_number" autofocus autocomplete="street_and_house_number"
                                        value="{{ old('street_and_house_number') }}">

                                    @error('street_and_house_number')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="country">{{__('City')}}</label>

                                    {{ Form::select('city_id', $cities ?? ['1'=>'one','2'=>'two'], null, ['id'=>'city_id',"class"=>"form-control". ($errors->first('city_id') ? ' is-invalid':''),"placeholder"=>__('Select city')]) }}

                                    @error('city_id')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="province">{{__('Province')}}</label>

                                    <input type="text" class="form-control @error('province') is-invalid @enderror"
                                        name="province" autofocus autocomplete="province" value="{{ old('province') }}">

                                    @error('province')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="email">{{__('Restaurant email')}}</label>
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror"
                                        name="email" autofocus autocomplete="email" value="{{ old('email') }}">

                                    @error('email')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="phone_billing">{{__('Telephone number')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">+32</span>
                                        </div>
                                        <input type="text"
                                            class="form-control  @error('phone_billing') is-invalid @enderror"
                                            name="phone_billing" autofocus autocomplete="phone_billing"
                                            value="{{ old('phone_billing') }}">
                                    </div>

                                    @error('phone_billing')
                                    <span class="invalid-feedback text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </section>

                    <h3>{{__('confirmation')}}</h3>
                    <section class="px-0">
                        <div>Confirm!</div>
                    </section>

                </div>
                </form>
                <div class="mt-3">
                    <a href="{{route('restaurant.login')}}" class="d-block mt-3 text-muted">{{__('Already a user?')}}
                        {{__('Sign in')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection


@push("scripts")

<script>
    jQuery.validator.addMethod("exactlength", function(value, element, param) {
        return this.optional(element) || value.length == param;
    }, $.validator.format("@lang('Please enter a valid phone number.')"));
    
    var form = $("#registerForm");
    form.validate({
        normalizer: function(value) {
            return $.trim(value);
        },
        rules: {
            site_name: {
                required: true,
                maxlength: 191
            },
            phone:{
                required: true,
                digits: true,
                exactlength: 10,
                maxlength: 191,
            },
            email: {
                required: true,
                maxlength: 191,
                remote: function() {
                    return "{{ route('restaurant.restaurantsCheckUniqueEmail') }}";
                }
            },
            slug:{
                required: true,
                maxlength: 191,
                pattern: /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/,
                remote: function() {
                    return "{{ route('restaurant.restaurantsCheckUniqueSlug') }}";
                }
            },
            restaurant_type_id:{
                required: true,
            },
            number_of_employees:{
                required: true,
                digits: true
            },
            fb_url:{
                required: false,
                url: true,
                maxlength: 191,
            },
            ig_url:{
                required: false,
                url: true,
                maxlength: 191,
            },
            first_name:{
                required: true,
                maxlength: 191,
            },
            last_name:{
                required: true,
                maxlength: 191,
            },
            province: {
                required: true,
                maxlength: 191,
            },
            city_id:{
                required: true,
            },
            VAT_number:{
                required: true,
                maxlength: 191,
            },
            street_and_house_number: {
                required: true,
            },
            phone_billing:{
                required: true,
                digits: true,
                exactlength: 10,
                maxlength: 191,
            }
        },
        messages: {
            site_name: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            phone:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')",
                digits: "@lang('Please enter a valid phone number.')",
                number: "@lang('Please enter a valid phone number.')",	
            },
            email: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')",
                remote: "@lang('Email already exists.')"
            },
            slug:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')",
                remote: "@lang('Website already exists.')",
                pattern: "@lang('The website may only contain letters, numbers and dashes.')",
            },
            restaurant_type_id:{
                required: "@lang('This field is required.')",
            },
            number_of_employees:{
                required: "@lang('This field is required.')",
                digits: "@lang('Please enter only digits.')",
            },
            fb_url:{
                required: "@lang('This field is required.')",
                url: "@lang('Please enter valid facebook link.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            ig_url:{
                required: "@lang('This field is required.')",
                url: "@lang('Please enter valid instagram link.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            first_name:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            last_name:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            province: {
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            city_id:{
                required: "@lang('This field is required.')",
            },
            VAT_number:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')"
            },
            street_and_house_number: {
                required: "@lang('This field is required.')",
            },
            phone_billing:{
                required: "@lang('This field is required.')",
                maxlength: "@lang('Please enter no more than 191 characters.')",
                digits: "@lang('Please enter a valid phone number.')",
                number: "@lang('Please enter a valid phone number.')",	
            }
        },
        errorPlacement: function(error, element) {
            if(element.attr("name") == "phone" || element.attr("name") == "phone_billing"){
                error.insertAfter($(element).closest('.input-group'));
            } else {
				error.insertAfter(element);
			}
        },
        errorElement: 'p',
        errorClass: 'text-danger',
        // highlight: function(element) {
        //     $(element).addClass('is-invalid').removeClass('is-valid');
        // },
        // unhighlight: function(element) {
        //     $(element).removeClass('is-invalid').addClass('is-valid');
        // },
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        enableAllSteps: true,
        // transitionEffect: "slideLeft",
        labels: 
        {
            finish: "@lang('Registration')",
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
            console.log(currentIndex);
            console.log(newIndex);
            
            form.validate().settings.ignore = ":disabled,:hidden";
            if(newIndex == 2 && form.valid()){
                form.submit();
                return false
            }

            if(newIndex == 1){
                $(".actions a:eq(1)").text("@lang('Register')");
            }

            if(currentIndex < newIndex){
                return form.valid();
            }
            return true;

        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();

        },
        onFinished: function (event, currentIndex)
        {
            form.submit();
        }
    });

    // $("#restaurantPhone,#number_of_employees").bind("keypress", function (e) {
    //         var keyCode = e.which ? e.which : e.keyCode
    //         if (!(keyCode >= 48 && keyCode <= 57)) {   
    //         return false;
    //     }
    // });

</script>

@endpush