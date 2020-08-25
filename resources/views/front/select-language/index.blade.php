@extends('front.select-language.layouts.default')

@section('content')

<div class="language-selection-box-mobile-languages-box">
    <h2>
        @if($restaurant->setting->language_dutch)
        Kies een taal
        @endif

        @if($restaurant->setting->language_french)
        / Choisissez une langue
        @endif

        @if($restaurant->setting->language_english)
        / Choose a language
        @endif
    </h2>

    @if($restaurant->setting->language_dutch)
    <a href="javascript:void(0);" data-toggle="modal" data-target="#visitorModalNl" class="lang-btn">
        {{-- <a href="{{ route('menu-nl',['slug' => $restaurant->slug]) }}" class="lang-btn"> --}}
        Nederlands
    </a>
    @endif

    @if($restaurant->setting->language_french)
    <a href="javascript:void(0);" data-toggle="modal" data-target="#visitorModalFr" class="lang-btn">
        {{-- <a href="{{route('menu-fr',['slug' => $restaurant->slug])}}" class="lang-btn"> --}}
        Français
    </a>
    @endif

    @if($restaurant->setting->language_english)
    <a href="javascript:void(0);" data-toggle="modal" data-target="#visitorModalEn" class="lang-btn">
        {{-- <a href="{{route('menu-en',['slug' => $restaurant->slug])}}" data-toggle="modal"
        data-target="#visitorModalEn"> --}}
        English
    </a>
    @endif
</div>

<!-- Visitor Modal en-->
<div class="modal fade" id="visitorModalEn" tabindex="-1" role="dialog" aria-labelledby="visitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    Have you registered your table?
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary shadow-none btn-restomenu-primary register-en yes-btn">No,
                            Register</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('menu-en',['slug' => $restaurant->slug])}}" class="btn btn-block btn-primary shadow-none btn-restomenu-primary">Yes, Go to
                            menu</a>
                    </div>
                </div>
            </div>

            <form action="{{route('menu-visitor-save',['slug' => $restaurant->slug])}}" method="post" id="visitorFormEn" class="d-none">
                <div class="modal-body visitor-form-block">
                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="first_name" id="first_name" placeholder="First name">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="last_name" id="last_name" placeholder="Last name">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control rm-text-input shadow-none" name="email" id="email" placeholder="Enter your email (optional)">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people" id="number_of_people" placeholder="Number of people" min="1">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone" placeholder="Phone number">
                    </div>

                    @if($restaurant->restaurantTime && ($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time) || $restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                    <div class="mb-2 text-center timing-text">
                        @if($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time)
                        <div>
                            Morning Time: {{$restaurant->restaurantTime->morning_start_time}} To {{$restaurant->restaurantTime->morning_end_time}}
                        </div>
                        @endif

                        @if($restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                        <div>
                            Evening Time: {{$restaurant->restaurantTime->evening_start_time}} To {{$restaurant->restaurantTime->evening_end_time}}
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        {{-- <input type="text" class="form-control rm-text-input shadow-none" name="appointment_time"
                            id="appointment_time" placeholder="Select Your Time" data-toggle="datetimepicker"
                            data-target="#appointment_time"> --}}

                        <div class="input-group date" id="appointment_time_en" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input rm-text-input shadow-none" name="appointment_time" data-target="#appointment_time_en" placeholder="Select Your Time" />
                            <div class="input-group-append" data-target="#appointment_time_en" data-toggle="datetimepicker">
                                <div class="input-group-text input-group-text-no-border"><i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_terms_checked" value="1">
                            <a href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">I agree to
                                the terms of service.</a>
                        </label>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_agreed" value="1">
                            Agree with submitting your information to our customers record.
                        </label>
                    </div>

                </div>
                <div class="modal-footer visitor-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary shadow-none btn-restomenu-primary visitor-submit-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Visitor Modal fr-->
<div class="modal fade" id="visitorModalFr" tabindex="-1" role="dialog" aria-labelledby="visitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{-- Enregistrez votre table --}}
                    Avez-vous enregistré votre table?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body que-block">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary shadow-none btn-restomenu-primary register-fr yes-btn">Non,
                            S'inscrire</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('menu-fr',['slug' => $restaurant->slug])}}" class="btn btn-block btn-primary shadow-none btn-restomenu-primary">Oui, aller au menu
                        </a>
                    </div>
                </div>
            </div>

            <form action="{{route('menu-visitor-save',['slug' => $restaurant->slug])}}" method="post" id="visitorFormFr" class="d-none">
                <div class="modal-body visitor-form-block">
                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="first_name" id="first_name" placeholder="Prénom">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="last_name" id="last_name" placeholder="Nom de famille">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control rm-text-input shadow-none" name="email" id="email" placeholder="Votre e-mail (optionnel)">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people" id="number_of_people" placeholder="Nombre de personnes (table)" min="1">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone" placeholder="Numéro de téléphone">
                    </div>

                    @if($restaurant->restaurantTime && ($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time) || $restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                    <div class="mb-2 text-center timing-text">
                        @if($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time)
                        <div>
                            Heure du matin: {{$restaurant->restaurantTime->morning_start_time}} à {{$restaurant->restaurantTime->morning_end_time}}
                        </div>
                        @endif

                        @if($restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                        <div>
                            soirée: {{$restaurant->restaurantTime->evening_start_time}} à {{$restaurant->restaurantTime->evening_end_time}}
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group date" id="appointment_time_fr" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input rm-text-input shadow-none" name="appointment_time" data-target="#appointment_time_fr" placeholder="Sélectionnez votre temps" />
                            <div class="input-group-append" data-target="#appointment_time_fr" data-toggle="datetimepicker">
                                <div class="input-group-text input-group-text-no-border"><i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_terms_checked" value="1">
                            <a href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">Je suis d'accord
                                avec les conditions.</a>
                        </label>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_agreed" value="1">
                            Êtes-vous d’accord d’enregistrer vos données dans notre base clientèle
                        </label>
                    </div>

                </div>
                <div class="modal-footer visitor-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Clôturer</button>
                    <button type="submit" class="btn btn-primary shadow-none btn-restomenu-primary visitor-submit-btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Visitor Modal nl-->
<div class="modal fade" id="visitorModalNl" tabindex="-1" role="dialog" aria-labelledby="visitorModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    {{-- Registreer jouw tafel --}}
                    Heeft u uw tafel aangemeld?
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body que-block">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-block btn-primary shadow-none btn-restomenu-primary register-nl yes-btn">Nee,
                            Registreren</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('menu-nl',['slug' => $restaurant->slug])}}" class="btn btn-block btn-primary shadow-none btn-restomenu-primary">Ja, ga naar menu
                        </a>
                    </div>
                </div>
            </div>

            <form action="{{route('menu-visitor-save',['slug' => $restaurant->slug])}}" method="post" id="visitorFormNl" class="d-none">
                <div class="modal-body visitor-form-block">
                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="first_name" id="first_name" placeholder="Voornaam">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="last_name" id="last_name" placeholder="Achternaam">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control rm-text-input shadow-none" name="email" id="email" placeholder="Jouw e-mail (optioneel)">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control rm-text-input shadow-none" name="number_of_people" id="number_of_people" placeholder="Hoeveel personen tafelen mee?" min="1">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control rm-text-input shadow-none" name="phone" id="phone" placeholder="Telefoonnummer">
                    </div>

                    @if($restaurant->restaurantTime && ($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time) || $restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                    <div class="mb-2 text-center timing-text">
                        @if($restaurant->restaurantTime->morning_start_time && $restaurant->restaurantTime->morning_end_time)
                        <div>
                            Ochtend tijd: {{$restaurant->restaurantTime->morning_start_time}} tot {{$restaurant->restaurantTime->morning_end_time}}
                        </div>
                        @endif

                        @if($restaurant->restaurantTime->evening_start_time && $restaurant->restaurantTime->evening_end_time)
                        <div>
                            Avond tijd: {{$restaurant->restaurantTime->evening_start_time}} tot {{$restaurant->restaurantTime->evening_end_time}}
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group date" id="appointment_time_nl" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input rm-text-input shadow-none" name="appointment_time" data-target="#appointment_time_nl" placeholder="Selecteer uw tijd" />
                            <div class="input-group-append" data-target="#appointment_time_nl" data-toggle="datetimepicker">
                                <div class="input-group-text input-group-text-no-border"><i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_terms_checked" value="1">
                            <a href="{{env('TERMS_CONDITIONS_URL')}}" class="t-c-link" target="_blank">Ik ga akkoord met
                                de service voorwaarden.</a>
                        </label>
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_agreed" value="1">
                            Bent u akkoord dat uw gegevens opgeslagen worden in ons klantenbestand
                        </label>
                    </div>

                </div>
                <div class="modal-footer visitor-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Afsluiten</button>
                    <button type="submit" class="btn btn-primary shadow-none btn-restomenu-primary visitor-submit-btn">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push("scripts")

<script>
    var visitorFormValidation = $("#visitorFormEn").validate({
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
            appointment_time: {
                required: true,
            },
            phone: {
                required: true,
                number: true
            },
            is_terms_checked: {
                required: true,
            }
        },
        messages: {
            first_name: {
                required: "This field is required.",
            },
            last_name: {
                required: "This field is required.",
            },
            email: {
                email: "Please enter a valid email address.",
            },
            number_of_people: {
                required: "This field is required.",
            },
            appointment_time: {
                required: "This field is required.",
            },
            phone: {
                required: "This field is required.",
                number: "Please enter a valid phone number.",
            },
            is_terms_checked: {
                required: "Please accept terms of service.",
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "is_terms_checked") {
                error.insertAfter($(element).closest('.form-check'));
            } else if (element.attr("name") == "appointment_time") {
                error.insertAfter($(element).closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            registerVisitor();
        },

    });

    var visitorFormValidationFr = $("#visitorFormFr").validate({
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
            appointment_time: {
                required: true,
            },
            phone: {
                required: true,
                number: true
            },
            is_terms_checked: {
                required: true,
            }
        },
        messages: {
            first_name: {
                required: "Ce champ est obligatoire.",
            },
            last_name: {
                required: "Ce champ est obligatoire.",
            },
            email: {
                email: "Veuillez introduire un e-mail valide.",
            },
            number_of_people: {
                required: "Ce champ est obligatoire.",
            },
            appointment_time: {
                required: "Ce champ est obligatoire.",
            },
            phone: {
                required: "Ce champ est obligatoire.",
                number: "Veuillez introduire un numéro de téléphone valide.",
            },
            is_terms_checked: {
                required: "Veuillez accepter les conditions.",
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "is_terms_checked") {
                error.insertAfter($(element).closest('.form-check'));
            } else if (element.attr("name") == "appointment_time") {
                error.insertAfter($(element).closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            registerVisitorFr();
        },

    });

    var visitorFormValidationNl = $("#visitorFormNl").validate({
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
            appointment_time: {
                required: true,
            },
            phone: {
                required: true,
                number: true
            },
            is_terms_checked: {
                required: true,
            }
        },
        messages: {
            first_name: {
                required: "Dit veld is verplicht.",
            },
            last_name: {
                required: "Dit veld is verplicht.",
            },
            email: {
                email: "Gelieve een geldig e-mail adres in te geven.",
            },
            number_of_people: {
                required: "Dit veld is verplicht.",
            },
            appointment_time: {
                required: "Dit veld is verplicht.",
            },
            phone: {
                required: "Dit veld is verplicht.",
                number: "Gelieve een geldig telefoonnummer in te geven.",
            },
            is_terms_checked: {
                required: "Gelieve de voorwaarden te accepteren.",
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "is_terms_checked") {
                error.insertAfter($(element).closest('.form-check'));
            } else if (element.attr("name") == "appointment_time") {
                error.insertAfter($(element).closest('.input-group'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            registerVisitorNl();
        },

    });

    function registerVisitor() {
        var visitorFormData = $('#visitorFormEn').serialize();

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
                $('.visitor-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...`);
            },
            success: function(data, status, xhr) {
                $('#visitorModalEn').modal('hide');
                fnToastSuccess('Registration successful.');

                let menuUrl = '{{ route("menu-en", ":slug") }}';
                menuUrl = menuUrl.replace(':slug', "{{$restaurant->slug}}");
                window.location = menuUrl;
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
                $('.visitor-submit-btn').html(`Save`);
            }
        });
    }

    function registerVisitorFr() {
        var visitorFormData = $('#visitorFormFr').serialize();

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
                $('.visitor-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...`);
            },
            success: function(data, status, xhr) {
                $('#visitorModalFr').modal('hide');
                fnToastSuccess('L\'enregistrement a été effectué avec succès.');

                let menuUrl = '{{ route("menu-fr", ":slug") }}';
                menuUrl = menuUrl.replace(':slug', "{{$restaurant->slug}}");
                window.location = menuUrl;
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
                $('.visitor-submit-btn').html(`Enregistrer`);
            }
        });
    }

    function registerVisitorNl() {
        var visitorFormData = $('#visitorFormNl').serialize();

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
                $('.visitor-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Laden...`);
            },
            success: function(data, status, xhr) {
                $('#visitorModalNl').modal('hide');
                fnToastSuccess('De registratie is compleet.');

                let menuUrl = '{{ route("menu-nl", ":slug") }}';
                menuUrl = menuUrl.replace(':slug', "{{$restaurant->slug}}");
                window.location = menuUrl;
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
                $('.visitor-submit-btn').html(`Opslaan`);
            }
        });
    }

    $('#visitorModalEn').on('hidden.bs.modal', function() {
        $('#visitorFormEn').trigger("reset");
        visitorFormValidation.resetForm();
        $('#visitorFormEn').find('.error').removeClass('error');
        $('#visitorFormEn').addClass('d-none');
    });

    var dateNow = new Date();
    var nowHour = moment().format('HH');
    var nowMinute = moment().format('mm');
    $('#visitorModalEn,#visitorModalFr,#visitorModalNl').on('show.bs.modal', function() {
        $("#appointment_time_en").data("datetimepicker").date(new Date());
        $("#appointment_time_fr").data("datetimepicker").date(new Date());
        $("#appointment_time_nl").data("datetimepicker").date(new Date());
    });

    $('#appointment_time_en,#appointment_time_fr,#appointment_time_nl').datetimepicker({
        format: 'HH:mm',
        defaultDate: dateNow,
        minDate: moment({
            h: nowHour,
            minute: nowMinute
        }),
        // maxDate: moment({h:24}),
    });

    $('#visitorModalFr').on('hidden.bs.modal', function() {
        $('#visitorFormFr').trigger("reset");
        visitorFormValidationFr.resetForm();
        $('#visitorFormFr').find('.error').removeClass('error');
        $('#visitorFormFr').addClass('d-none');
    });

    $('#visitorModalNl').on('hidden.bs.modal', function() {
        $('#visitorFormNl').trigger("reset");
        visitorFormValidationNl.resetForm();
        $('#visitorFormNl').find('.error').removeClass('error');
        $('#visitorFormNl').addClass('d-none');
    });

    $(".register-en").on('click', function() {
        $('#visitorFormEn').removeClass('d-none');
    });

    $(".register-fr").on('click', function() {
        $('#visitorFormFr').removeClass('d-none');
    });

    $(".register-nl").on('click', function() {
        $('#visitorFormNl').removeClass('d-none');
    });
</script>

@endpush