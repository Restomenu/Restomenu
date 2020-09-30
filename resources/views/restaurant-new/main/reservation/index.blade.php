@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@push("stylesheets")
<style>
    select {
        color: #000;
    }
</style>
@endpush

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="custom-header d-flex pt-1 row">
                    <div class="col-12 col-sm-6">
                        <h4 class="mt-1">{{isset($module_name) ? __(Str::plural($module_name)) : ''}}</h4>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="ml-auto">
                            <a href="{{ $module_route."/create" }}" class="btn btn-sm btn-primary pull-right">{{__('Add')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="text-center">
                    <div class="btn-group mb-3 select-visitor-type" role="group">
                        <button type="button" class="btn btn-secondary" data-type="all">{{__('All')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="accept">{{__('Accept')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="pending">{{__('Pending')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="schedule">{{__('Schedule')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="cancel">{{__('Cancel')}}</button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="visitors-table" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                {{-- <th>{{__('No.')}}</th> --}}
                                <th>{{__('Last Name')}}</th>
                                <th>{{__('First Name')}}</th>
                                <th>{{__('Number Of People')}}</th>
                                <th>{{__('Reservation Date')}}</th>
                                <th>{{__('Reservation Time')}}</th>
                                {{-- <th>{{__('Check Out')}}</th> --}}
                                <th>{{__('Status')}}</th>
                                {{-- <th>{{__('Action')}}</th> --}}
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="statusModal" role="dialog" aria-labelledby="feedbackModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    @lang('Change Reservation Status')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" id="customerStatusForm">
                <div class="modal-body p-4">
                    <div class="form-group row">
                        {{-- <div class="col-12 col-sm-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="panding_btn"
                                        value="0">
                                    @lang('Pending')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div> --}}
                        <div class="col-12 col-sm-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="accept_btn" value="1">
                                    @lang('Accept')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="reject_btn" value="-1">
                                    @lang('Cancel')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="schedule_btn" value="2">
                                    @lang('Schedule')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row appointment_cancel_block d-none">

                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                {{-- <label class="form-check-label"> --}}
                                <textarea rows="8" class="form-control" name="reservation_cancel_desc" id="reservation_cancel_desc"></textarea>

                                {{-- <i class="input-frame"></i></label> --}}
                            </div>
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="full_today_btn" value="1">
                                    @lang('Full today')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="full_on_given_day_btn" value="2">
                                    @lang('Full on given day')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="exceptionally_closed_today_btn" value="3">
                                    @lang('Exceptionally Closed today')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="exceptionally_closed_on_given_day_btn" value="4">
                                    @lang('Exceptionally Closed on
                                    given day')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="propose_other_time_btn" value="5">
                                    @lang('Propose other time')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reservation_cancel_reason" id="others_btn" value="6">
                                    @lang('Others')
                                    <i class="input-frame"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row appointment_time_block d-none">
                        <label for="appointment_time">@lang('Appointment Time')</label>
                        <input type="text" class="form-control" name="appointment_time" id="appointment_time" />
                    </div>

                    <input type="hidden" class="form-control" name="visitor_id" id="visitor_id">
                </div>
                <div class="modal-footer feedback-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="button" class="btn btn-primary shadow-none btn-restomenu-primary status-submit-btn">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@push('scripts')

<script>
    var visitorsFilterValue = null;
    var visitorTable = $("#visitors-table").DataTable({
        // "dom": '<"row" <"col-sm-12 mb-3"<"html5buttons"B>>> <"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        buttons: [{
                extend: 'csv',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                title: 'Customers',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                },
                customize: function(doc) {
                    doc.content[1].table.widths = ["16%", "16%", "9%", "13%", "16%", "15%", "15%"];
                },
            },
            {
                extend: 'print',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                },
                customize: function(win) {
                    $(win.document.body).find('h1').css('text-align', 'center');
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit')
                        .css('border-spacing', '0px').find('.td').css('padding', '0px');
                }
            },
        ],
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        stateSave: true,
        pageLength: 25,
        "oLanguage": {
            "sEmptyTable": "{{__('No data available in table')}}",
            "sInfo": "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
            "sInfoEmpty": "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
            "sInfoFiltered": "({{__('filtered from')}} _MAX_ {{__('total')}} {{__('entries')}})",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "{{__('Show')}} _MENU_ {{__('entries')}}",
            "sLoadingRecords": "{{__('Loading...')}})",
            "sProcessing": "{{__('Processing...')}}",
            "sSearch": "{{__('Search')}}:",
            "sZeroRecords": "{{__('No matching records found')}}",
            "oPaginate": {
                "sFirst": "{{__('First')}}",
                "sLast": "{{__('Last')}}",
                "sNext": "{{__('Next')}}",
                "sPrevious": "{{__('Previous')}}"
            },

        },
        ajax: {
            "url": "{!! $module_route.'/datatable' !!}",
            "data": function(d) {
                d.visitorsFilterValue = visitorsFilterValue;
            }
        },

        columns: [
            // {
            //     data: 'DT_RowIndex',
            //     searchable: false,
            //     orderable: false,
            //     width: '10%'
            // },
            {
                data: 'last_name',
                name: "last_name",
                defaultContent: "N/A",
                width: '20%'
            },
            {
                data: 'first_name',
                name: "first_name",
                defaultContent: "N/A",
                width: '20%'
            },
            {
                data: 'number_of_people',
                name: "number_of_people",
                searchable: false,
                defaultContent: "N/A",
                width: '20%'
            },
            {
                data: 'appointment_date',
                name: "appointment_date",
                defaultContent: "N/A",
                searchable: true,
                orderable: true,
                width: '20%'
            },
            {
                data: 'appointment_time',
                name: "appointment_time",
                defaultContent: "N/A",
                searchable: false,
                width: '20%'
            },
            {
                data: 'appointment_status',
                name: 'appointment_status',
                searchable: true,
                orderable: true,
                render: function(appointment_status, type, visitor, meta) {

                    var resultStr = '<div>';
                    if (appointment_status === 0) {
                        resultStr += `<a href="#" class="badge badge-primary">@lang('Pending')</a>`;
                    } else if (appointment_status === 1) {
                        resultStr += `<a href="#" class="badge badge-success">@lang('Accepted')</a>`;
                    } else if (appointment_status === -1) {
                        resultStr += `<a href="#" class="badge badge-danger">@lang('Canceled')</a>`;
                    } else if (appointment_status === 2) {
                        resultStr += `<a href="#" class="badge badge-warning">@lang('Scheduled')</a>`;
                    }

                    resultStr += `<a class="btn btn-primary change-status-btn ml-2" href="#"  data-visitor-id="${visitor.id}" data-current-status="${visitor.appointment_status}" data-appointment-time="${visitor.appointment_time}" data-reservation-cancel-reason="${visitor.reservation_cancel_reason}" data-reservation-cancel-desc="${visitor.reservation_cancel_desc}" data-visitor-first-name="${visitor.first_name}" data-number-of-people="${visitor.number_of_people}" data-appointment-date="${visitor.appointment_date}"  data-appointment-time="${visitor.appointment_time}" data-locale="${visitor.locale}" ><i class='fa fa-edit'></i></a>`;

                    resultStr += "</div>";

                    return resultStr;
                }
            },
            // {
            //     data: null,
            //     searchable: false,
            //     orderable: false,
            //     width: '10%',
            //     render: function(data) {
            //         var resultStr = '';

            //         // resultStr += "<a href='{{ $module_route }}/" + data.id + "/edit' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>";

            //         // resultStr += "&nbsp;<a href='javascript:void(0);' class='deleteRecord btn btn-xs btn-danger ml-1' val='" + data.id + "'><i class='fa fa-trash-o'></i></a> ";

            //         return resultStr;
            //     }
            // }
        ],
        order: [
            [0, 'desc']
        ],
    });

    $('.select-visitor-type button').click(function() {
        $(this).removeClass('btn-outline-secondary').addClass('btn-secondary').siblings().removeClass('btn-secondary').addClass('btn-outline-secondary');

        visitorsFilterValue = $(this).data('type');

        visitorTable.draw(true);
    });

    $(document).on('click', ".change-status-btn", function(e) {
        var visitorId = $(this).data('visitor-id');
        var currentStatus = $(this).data('current-status');
        var appointmentTime = $(this).data('appointment-time');
        var reservationCancelReason = $(this).data('reservation-cancel-reason');
        var reservationCancelDesc = $(this).data('reservation-cancel-desc');
        var visitor_first_name = $(this).data('visitor-first-name');
        var visitor_number_of_people = $(this).data('number-of-people');
        var visitor_appointment_date = $(this).data('appointment-date');
        var visitor_appointment_time = $(this).data('appointment-time');
        var locale = $(this).data('locale');

        $('input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_number_of_people', visitor_number_of_people);
        $('input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_first_name', visitor_first_name);
        $('input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_appointment_time', visitor_appointment_time);
        $('input[type=radio][name=reservation_cancel_reason]').attr('data-visitor_appointment_date', visitor_appointment_date);
        $('input[type=radio][name=reservation_cancel_reason]').attr('data-locale', locale);

        if (currentStatus === 0) {
            $('#panding_btn').prop("checked", true);
            $('.appointment_cancel_block').addClass('d-none');
            $('.appointment_time_block').addClass('d-none');

        } else if (currentStatus === 1) {
            $('#accept_btn').prop("checked", true);
            $('.appointment_time_block').addClass('d-none');
            $('.appointment_cancel_block').addClass('d-none');

        } else if (currentStatus === -1) {
            $('#reject_btn').prop("checked", true);
            $('.appointment_time_block').addClass('d-none');
            $('.appointment_cancel_block').removeClass('d-none');

        } else if (currentStatus === 2) {
            $('#schedule_btn').prop("checked", true);
            $('.appointment_time_block').removeClass('d-none');
            $('.appointment_cancel_block').addClass('d-none');

        }

        if (reservationCancelReason === 1) {
            $('#full_today_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);

        } else if (reservationCancelReason === 2) {
            $('#full_on_given_day_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);

        } else if (reservationCancelReason === 3) {
            $('#exceptionally_closed_today_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);

        } else if (reservationCancelReason === 4) {
            $('#exceptionally_closed_on_given_day_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);

        } else if (reservationCancelReason === 5) {
            $('#propose_other_time_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);

        } else {
            $('#others_btn').prop("checked", true);
            $('#reservation_cancel_desc').val(reservationCancelDesc);
        }

        $('#statusModal #visitor_id').val(visitorId);
        $('#appointment_time').val(appointmentTime);
        $('#statusModal').modal('show');

        $('#appointment_time').clockpicker({
            donetext: "@lang('Done')",
        });
    });

    $(document).on('change', "input[type=radio][name=status]", function(e) {
        if (this.value == '2') {
            $('.appointment_cancel_block').addClass('d-none');
            $('.appointment_time_block').removeClass('d-none');

        } else if (this.value == '-1') {
            $('.appointment_time_block').addClass('d-none');
            $('.appointment_cancel_block').removeClass('d-none');

        } else {
            $('.appointment_cancel_block').addClass('d-none');
            $('.appointment_time_block').addClass('d-none');
        }
    });

    $(document).on('change', "input[type=radio][name=reservation_cancel_reason]", function(e) {
        // data-visitor-first-name="${visitor.first_name}" data-number-of-people="${visitor.number_of_people}"  
        var visitor_first_name = $(this).data("visitor_first_name");
        var visitor_number_of_people = $(this).data("visitor_number_of_people");
        var appointmentTime = $(this).data("visitor_appointment_time");
        var appointmentDate = $(this).data("visitor_appointment_date");
        var locale = $(this).data("locale");
        var restaurant_name = "{{auth()->guard('restaurant')->user()->setting->site_name}}";
        var restaurant_phone = "{{auth()->guard('restaurant')->user()->phone}}";

        if (this.value == '1') {

            if (locale == 'en') {
                var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for  ${visitor_number_of_people} persons on ${appointmentDate} at ${appointmentTime} : We’re already fully booked. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

            } else if (locale == 'nl') {
                var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime}: wij zijn reeds volzet vandaag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

            } else if (locale == 'fr') {
                var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à  ${appointmentTime} : nous sommes déjà complet aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

            }
            $('#reservation_cancel_desc').val(message);

        } else if (this.value == '2') {

            if (locale == 'en') {
                var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} on ${appointmentDate}  at ${appointmentTime} : We’re already fully booked on the given day. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

            } else if (locale == 'nl') {
                var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate}  om ${appointmentTime} : Wij zijn reeds volzet die dag. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

            } else if (locale == 'fr') {
                var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate}  à ${appointmentTime} : nous sommes déjà complet ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

            }
            $('#reservation_cancel_desc').val(message);

        } else if (this.value == '3') {

            if (locale == 'en') {
                var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} on ${appointmentDate} at ${appointmentTime} : We’re exceptionally closed today. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

            } else if (locale == 'nl') {
                var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime} : Wij zijn vandaag exceptioneel gesloten. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

            } else if (locale == 'fr') {
                var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à ${appointmentTime} : nous sommes exceptionnellement fermé aujourd’hui. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

            }
            $('#reservation_cancel_desc').val(message);

        } else if (this.value == '4') {

            if (locale == 'en') {
                var message = `Hello ${visitor_first_name}, \nWe’re not able to confirm your reservation for ${visitor_number_of_people} persons on ${appointmentDate} at ${appointmentTime} : We’re exceptionally closed on the given date. \n\nOur sincere apologies, \nKind regards, \n${restaurant_name}`;

            } else if (locale == 'nl') {
                var message = `Dag ${visitor_first_name}, \nWij zijn helaas niet in de mogelijkheid om de reservering te bevestigen voor ${visitor_number_of_people} personen op ${appointmentDate} om ${appointmentTime} : Wij zijn uitzonderlijk gesloten op ${appointmentDate}. \n\nOnze oprechte excuses voor het ongemak, \nVriendelijke groet \n${restaurant_name}`;

            } else if (locale == 'fr') {
                var message = `Bonjour ${visitor_first_name}, \nNous ne pouvons malheureusement pas confirmer votre réservation pour ${visitor_number_of_people} personnes le ${appointmentDate} à ${appointmentTime} : nous sommes exceptionnellement fermé ce jour-là. \n\nToutes nos excuses pour le désagrément, \nCordialement, \n${restaurant_name}`;

            }
            $('#reservation_cancel_desc').val(message);

        } else if (this.value == '5') {

            if (locale == 'en') {
                var message = `Hello ${visitor_first_name}, \nWe’re already fully booked on ${appointmentDate} at ${appointmentTime}. Although, we could propose other time for ${visitor_number_of_people} persons. If this hour fits your schedule, could you perhaps call us (${restaurant_phone}) as soon as possible to confirm the reservation. \n\nThanks in advance,\n${restaurant_name}`;

            } else if (locale == 'nl') {
                var message = `Dag ${visitor_first_name}, \nWij zijn reeds vol geboekt op ${appointmentDate} om ${appointmentTime}. Wij kunnen jou wel een tafel voor ${visitor_number_of_people} personen voorstellen om other time.Als dit uur jou ook past, kun je ons zo snel mogelijk opbellen en bevestigen op ${restaurant_phone}. \n\nBedankt op voorhand, \n${restaurant_name}`;
            } else if (locale == 'fr') {
                var message = `Bonjour ${visitor_first_name}, \nNous sommes déjà complet le ${appointmentDate} à ${appointmentTime}. mais pouvons vous proposer une table pour ${visitor_number_of_people} personnes à other time. Si cette heure vous convient, veuillez nous contacter au plus vite au ${restaurant_phone}. \n\nD’avance merci,\n${restaurant_name}`;
            }
            $('#reservation_cancel_desc').val(message);

        } else {
            $('#reservation_cancel_desc').val('');
        }

    });

    $(document).on('click', ".status-submit-btn", function(e) {
        $('#customerStatusForm').submit();
    });

    var statusFormValidation = $("#customerStatusForm").validate({
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
            changeStatus();
        },
    });

    $('#statusModal').on('hidden.bs.modal', function() {
        $('#customerStatusForm').trigger("reset");
        statusFormValidation.resetForm();
        $('#customerStatusForm').find('.error').removeClass('error');
    });

    function changeStatus() {
        var statusFormData = $('#customerStatusForm').serialize();

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
                $('.status-submit-btn').prop("disabled", true);
                $('.status-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> @lang('Loading')...`);
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

                $('#statusModal').modal('hide');
                visitorTable.draw();
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
                $('.status-submit-btn').attr("disabled", false);
                $('.status-submit-btn').html(`@lang('Save')`);
            }
        });
    }

    function socketEvent_NewReservationNotification() {
        visitorTable.draw(true);
    }
</script>
@endpush