<?php

function setActiveMenu($route)
{
    return (Route::currentRouteName() == $route ? 'current' : '');
}
?>

<div class="menu-header">
    <div class="logo-wrapper">
        <img class="restaurant-logo"
            src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath($restaurant->id).$restaurant->setting->site_logo)}}" />
    </div>

    @if($restaurant->setting->language_english + $restaurant->setting->language_dutch +
    $restaurant->setting->language_french > 1)
    <div class="container-fluid language-container mt-4">
        @if($restaurant->setting->language_dutch)
        <a href="{{route('menu-nl',['slug' => $restaurant->slug])}}"
            class="language-item {{ setActiveMenu('menu-nl') }}">Nederlands</a>
        @endif

        @if($restaurant->setting->language_french)
        <a href="{{route('menu-fr',['slug' => $restaurant->slug])}}"
            class="language-item {{ setActiveMenu('menu-fr') }}">Français</a>
        @endif

        @if($restaurant->setting->language_english)
        <a href="{{route('menu-en',['slug' => $restaurant->slug])}}"
            class="language-item {{ setActiveMenu('menu-en') }}">English</a>
        @endif
    </div>
    @endif

    <!-- Button trigger modal -->
    <div class="text-center">
        <button type="button" class="btn btn-primary mt-4 visitor-modal-btn btn-restomenu-primary shadow-none"
            data-toggle="modal" data-target="#visitorModal">
            <img src="{{asset('front/images/table.svg')}}" alt="table" class="menu-table-img">
            @lang('Register your table')
        </button>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="visitorModal" tabindex="-1" role="dialog" aria-labelledby="visitorModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    @lang('Register your table')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('menu-visitor-save',['slug' => $restaurant->slug])}}" method="post" id="visitorForm">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="first_name"
                            id="first_name" placeholder="@lang('First name')">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="last_name"
                            id="last_name" placeholder="@lang('Last name')">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control rm-text-input shadow-none" name="email" id="email"
                            placeholder="@lang('Enter your email (optional)')">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people"
                            id="number_of_people" placeholder="@lang('Number of people')" min="1">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone"
                            placeholder="@lang('Phone number')">
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_terms_checked" value="1">
                            <a href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">@lang('I agree to the terms of service.')</a>
                        </label>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_agreed" value="1">
                            @lang('Agree with submitting your information to our customers record.')
                        </label>
                    </div>

                </div>
                <div class="modal-footer visitor-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"
                        class="btn btn-primary shadow-none btn-restomenu-primary visitor-submit-btn">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push("scripts")

<script>
    var visitorFormValidation = $("#visitorForm").validate({
        normalizer: function(value) {
            return $.trim(value);
        },
        ignore: [],
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: false,
                email: true
            },
            number_of_people: {
                required: true,
            },
            phone: {
                required: true,
                number: true
            },
            is_terms_checked:{
                required: true,
            }
        },
        messages: {
            first_name: {
                required: "@lang('This field is required.')",
            },
            last_name: {
                required: "@lang('This field is required.')",
            },
            email: {
                email: "@lang('Please enter a valid email address.')",
            },
            number_of_people: {
                required: "@lang('This field is required.')",
            },
            phone: {
                required: "@lang('This field is required.')",
                number: "@lang('Please enter a valid phone number.')",
            },
            is_terms_checked:{
                required: "@lang('Please accept terms of service.')",
            }
        },
        errorPlacement: function(error, element) {
			if (element.attr("name") == "is_terms_checked") {
				error.insertAfter($(element).closest('.form-check'));
			} else {
				error.insertAfter(element);
			}
		},
        submitHandler: function() {
            registerVisitor();
        },

    });

    function registerVisitor() {
        var visitorFormData = $('#visitorForm').serialize();

        var url = '{{ route("menu-visitor-save", ":slug") }}';
        url = url.replace(':slug', "{{$restaurant->slug}}");

        $.ajax({
            url: url,
            method: 'POST',
            data: visitorFormData,
            processData: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('.visitor-submit-btn').prop("disabled", true);
                $('.visitor-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> @lang('Loading')...`);
            },
            success: function(data, status, xhr) {
                $('#visitorModal').modal('hide');
                fnToastSuccess(data.message);
            },
            error: function(xhr, status, error) {
                if (xhr.status == 422) {
                    var errorObj = Object.values(xhr.responseJSON.errors)
                    for (var key in errorObj) {
                        var value = errorObj[key];
                        fnToastError(value.pop());
                    }
                } else {
                    ajaxError(xhr, status, error);
                }
            },
            complete: function() {
                $('.visitor-submit-btn').attr("disabled", false);
                $('.visitor-submit-btn').html(`@lang('Save')`);
            }
        });
    }

    $('#visitorModal').on('hidden.bs.modal', function() {
        $('#visitorForm').trigger("reset");
        visitorFormValidation.resetForm();
        $('#visitorForm').find('.error').removeClass('error');
    });
</script>

@endpush