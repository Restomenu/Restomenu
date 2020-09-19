<script src="{{ url('restaurant-new/js/app.js') }}" type="text/javascript"></script>
<script src="{{ url('restaurant-new/js/vendor.js') }}" type="text/javascript"></script>
<script src="{{ url('restaurant-new/js/template.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/echo.js') }}" type="text/javascript"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 5000
    };

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Prevent alert message from being displayed
    try {
        $.fn.dataTable.ext.errMode = 'none';
    } catch (err) {
        // err.message;
    }

    $(document).ajaxError(function(event, jqxhr, settings, thrownError) {
        if (jqxhr.status == 401 && jqxhr.statusText == 'Unauthorized' && thrownError == 'Unauthorized') {
            window.location.reload();
        } else if (jqxhr.status == 419) {
            window.location.reload();
        }
    });

    @if(\Session::has('error'))
        // toastr.error('{!! str_replace("'", '"', \Session::get('error')) !!}', "@lang('Error')");

        fnToastError('{!! \Session::get('error') !!}');
        "{{\Session::forget('error')}}";
    @endif
    @if(\Session::has('success'))
        // toastr.success('{!! \Session::get('success') !!}', "@lang('Success')");

        fnToastSuccess('{!! \Session::get('success') !!}');
        "{{\Session::forget('success')}}";
    @endif

    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
    });

    function deleteRecordByAjax(deleteUrl, moduleName, dataTablesName, callback, deleteMessage = null) {
        
        var deleteAlertStr = "You want to delete " + moduleName + "?";
        if(deleteMessage){
            deleteAlertStr = deleteMessage;
        }

        swalWithBootstrapButtons.fire({
            title: "@lang('Are you sure?')",
            text: deleteAlertStr,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'ml-2',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true,
            preConfirm: function(email) {
                return new Promise(function(resolve, reject) {
                    setTimeout(function() {
                        jQuery.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            dataType: 'json',
                            data: {
                                "_token": window.Laravel.csrfToken
                            },
                            success: function(result) {
                                dataTablesName.draw();
                                swalWithBootstrapButtons.fire("@lang('success!')", result.message, "success");
                                // fnToastSuccess(result.message);

                                if (callback && typeof callback == 'function') {
                                    callback();
                                }
                            },
                            error: function(xhr, status, error) {
                                if (xhr.responseJSON && xhr.responseJSON.message != "") {
                                    swalWithBootstrapButtons.fire("@lang('ohh snap!')", xhr.responseJSON.message, "error");
                                } else {
                                    swalWithBootstrapButtons.fire("@lang('ohh snap!')", "@lang('Something went wrong, please try again later.')", "error");
                                }
                                ajaxError(xhr, status, error);
                            }
                        });
                    }, 0);
                })
            },
        });
    }

    function fnToastSuccess(message) {
        Toast.fire({
            icon: "success",
            title: message
        });

        // toastr.options = {
        //     closeButton: true,
        //     progressBar: true,
        //     showMethod: 'slideDown',
        //     timeOut: 4000
        // };
        // toastr.success(message,"@lang('Success')");
    }

    function fnToastError(message) {
        Toast.fire({
            icon: "error",
            title: message
        });

        // toastr.options = {
        //     closeButton: true,
        //     progressBar: true,
        //     showMethod: 'slideDown',
        //     timeOut: 4000
        // };
        // toastr.error(message,"@lang('Error')");
    }

    function ajaxError(xhr, status, error) {
        if (xhr.status == 401) {
            fnToastError("You are not logged in. please login and try again");
        } else if (xhr.status == 403) {
            fnToastError("You have not permission for perform this operations");
        } else if (xhr.responseJSON && xhr.responseJSON.message != "") {
            fnToastError(xhr.responseJSON.message);
        } else {
            fnToastError("@lang('Something went wrong, please try again later.')");
        }
    }

    var currentNotifBtn;
    function fnShowSuccessNotif(message, notificationData) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": 0,
            "extendedTimeOut": 0,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false
        }

        toastr.info(`${message} <br/> <div type="button" id="notif-change-status-btn" class="badge badge-warning mt-1 mr-2"><i class="fa fa-edit" aria-hidden="true"></i></div> <div type="button" class="badge badge-warning clear mt-1">{{__('Ok')}}</div> `,'', {iconClass:"reservation-notif-toast"});

        $(document).on('click','.clear',function() {
            $(this).closest('.toast').remove();
        });

        $(document).on('click','#notif-change-status-btn',function() {
            currentNotifBtn = this;
            
            var visitorId = notificationData.reservationId;
            var appointmentTime = notificationData.appointmentTime;
            var visitor_first_name = notificationData.firstName;
            var visitor_number_of_people = notificationData.numberOfPeople;
            var visitor_appointment_date = notificationData.appointmentDate;
            var visitor_appointment_time = notificationData.appointmentTime;
            var locale = notificationData.locale;

            $('#notifResStatusModal input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_number_of_people', visitor_number_of_people);

            $('#notifResStatusModal input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_first_name', visitor_first_name);

            $('#notifResStatusModal input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_appointment_time', visitor_appointment_time);

            $('#notifResStatusModal input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_appointment_date', visitor_appointment_date);

            $('#notifResStatusModal input[type=radio][name=reservation_cancel_reason]').attr('data-locale', locale);

            $('#notifResStatusModal #visitor_id').val(visitorId);
            $('#notifResStatusModal #appointment_time').val(appointmentTime);
            $('#notifResStatusModal').modal('show');

            $('#notifResStatusModal #appointment_time').clockpicker({
                donetext: "@lang('Done')",
            });
        });
    }

        $(document).on('change', "#notifResStatusModal input[type=radio][name=status]", function(e) {
            if (this.value == '2') {
                $('#notifResStatusModal .appointment_cancel_block').addClass('d-none');
                $('#notifResStatusModal .appointment_time_block').removeClass('d-none');

            } else if (this.value == '-1') {
                $('#notifResStatusModal .appointment_time_block').addClass('d-none');
                $('#notifResStatusModal .appointment_cancel_block').removeClass('d-none');

            } else {
                $('#notifResStatusModal .appointment_cancel_block').addClass('d-none');
                $('#notifResStatusModal .appointment_time_block').addClass('d-none');
            }
        });

        $(document).on('change', "#notifResStatusModal input[type=radio][name=reservation_cancel_reason]", function(e) {
            // data-visitor-first-name="${visitor.first_name}" data-number-of-people="${visitor.number_of_people}"  
            var visitor_first_name = $(this).data("visitor_first_name");
            var visitor_number_of_people = $(this).data("visitor_number_of_people");
            var appointmentTime = $(this).data("visitor_appointment_time");
            var appointmentDate = $(this).data("visitor_appointment_date");
            var locale = $(this).data("locale");
            var restaurant_name = "{{auth()->guard('restaurant')->user()->name}}";
            var restaurant_phone = "{{auth()->guard('restaurant')->user()->phone}}";

            if (this.value == '1') {

                if (locale == 'en') {
                    var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for  ${visitor_number_of_people} persons on ${appointmentDate} at ${appointmentTime} : We’re already fully booked. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

                } else if (locale == 'nl') {
                    var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime}: wij zijn reeds volzet vandaag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

                } else if (locale == 'fr') {
                    var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à  ${appointmentTime} : nous sommes déjà complet aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

                }
                $('#notifResStatusModal #reservation_cancel_desc').val(message);

            } else if (this.value == '2') {

                if (locale == 'en') {
                    var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} on ${appointmentDate}  at ${appointmentTime} : We’re already fully booked on the given day. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

                } else if (locale == 'nl') {
                    var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate}  om ${appointmentTime} : Wij zijn reeds volzet die dag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

                } else if (locale == 'fr') {
                    var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate}  à ${appointmentTime} : nous sommes déjà complet ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

                }
                $('#notifResStatusModal #reservation_cancel_desc').val(message);

            } else if (this.value == '3') {

                if (locale == 'en') {
                    var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} on ${appointmentDate} at ${appointmentTime} : We’re exceptionally closed today. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

                } else if (locale == 'nl') {
                    var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime} : Wij zijn vandaag exceptioneel gesloten. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

                } else if (locale == 'fr') {
                    var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à ${appointmentTime} : nous sommes exceptionnellement fermé aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

                }
                $('#notifResStatusModal #reservation_cancel_desc').val(message);

            } else if (this.value == '4') {

                if (locale == 'en') {
                    var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} persons on ${appointmentDate} at ${appointmentTime} : We’re exceptionally closed on the given date. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

                } else if (locale == 'nl') {
                    var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime} : Wij zijn uitzonderlijk gesloten op ${appointmentDate}. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

                } else if (locale == 'fr') {
                    var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à ${appointmentTime} : nous sommes exceptionnellement fermé ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

                }
                $('#notifResStatusModal #reservation_cancel_desc').val(message);

            } else if (this.value == '5') {

                if (locale == 'en') {
                    var message = `Hello ${visitor_first_name}, \nWe’re already fully booked on ${appointmentDate} at ${appointmentTime}. Although, we could propose other time for ${visitor_number_of_people} persons. If this hour fits your schedule, could you perhaps call us (${restaurant_phone}) as soon as possible to confirm the reservation. \n\nThanks in advance,\n${restaurant_name}`;

                } else if (locale == 'nl') {
                    var message = `Dag ${visitor_first_name}, \nWij zijn reeds vol geboekt op ${appointmentDate} om ${appointmentTime}. Wij kunnen jou wel een tafel voor ${visitor_number_of_people} personen voorstellen om other time.Als dit uur jou ook past, kun je ons zo snel mogelijk opbellen en bevestigen op ${restaurant_phone}. \n\nBedankt op voorhand, \n${restaurant_name}`;
                } else if (locale == 'fr') {
                    var message = `Bonjour ${visitor_first_name}, \nNous sommes déjà complet le ${appointmentDate} à ${appointmentTime}. mais pouvons vous proposer une table pour ${visitor_number_of_people} personnes à other time. Si cette heure vous convient, veuillez nous contacter au plus vite au ${restaurant_phone}. \n\nD’avance merci,\n${restaurant_name}`;
                }
                $('#notifResStatusModal #reservation_cancel_desc').val(message);

            } else {
                $('#notifResStatusModal #reservation_cancel_desc').val('');
            }

        });

        $(document).on('click', "#notifResStatusModal .status-submit-btn", function(e) {
            $('#notifResStatusModal #customerStatusForm').submit();
        });

        var notifResStatusFormValidation = $("#notifResStatusModal #customerStatusForm").validate({
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                status: {
                    required: true,
                },
                appointment_time: {
                    required: true,
                }
            },
            messages: {
                status: {
                    required: "@lang('Please select status.')",
                },
                appointment_time: {
                    required: "@lang('This field is required.')",
                }
            },
            errorPlacement: function(error, element) {
                error.insertAfter($(element).closest('.form-group'));
            },
            submitHandler: function() {
                notifResChangeStatus();
            },
        });

        $('#notifResStatusModal').on('hidden.bs.modal', function() {
            $('#notifResStatusModal #customerStatusForm').trigger("reset");
            notifResStatusFormValidation.resetForm();
            $('#notifResStatusModal #customerStatusForm').find('.error').removeClass('error');
        });

    function notifResChangeStatus() {
        let statusFormData = $('#notifResStatusModal #customerStatusForm').serialize();

        $.ajax({
            url: "{{route('restaurant.reservation-status-update')}}",
            method: 'POST',
            data: statusFormData,
            processData: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('#notifResStatusModal .status-submit-btn').prop("disabled", true);
                $('#notifResStatusModal .status-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> @lang('Loading')...`);
            },
            success: function(data, status, xhr) {

                if (data.notification_id) {

                    var notificationCount = parseInt($('#notification-count').text());
                    if (notificationCount) {
                        notificationCount = notificationCount - 1;
                        $('#notification-count').text(notificationCount);
                        $('.notification-' + data.notification_id).addClass('d-none');

                        if (notificationCount == 0) {
                            $('.notification-indicator').addClass('d-none');
                            $('.no-notification-section').removeClass('d-none');
                        }

                    }
                }

                $('#notifResStatusModal').modal('hide');
                $(currentNotifBtn).closest('.toast').remove();
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
                $('#notifResStatusModal .status-submit-btn').attr("disabled", false);
                $('#notifResStatusModal .status-submit-btn').html(`@lang('Save')`);
            }
        });
    }

    

    // @if(Auth::check())
        // var restaurantId = "{{auth()->guard('restaurant')->user()->id}}";
        
        // Echo.private(`reservation.${restaurantId}`).listen("ReservationEvent", e => {
        //     console.log(e);
        //     fnToastSuccess(e.message);
        // });
    // @endif
    
</script>