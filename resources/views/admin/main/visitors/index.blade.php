@extends('admin.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{ isset($module_name) ? __(Str::plural($module_name)) : '' }}</h3>

                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover nowrap" id="visitors-table"
                            width="100%">
                            <thead>
                                <tr>
                                    {{-- <th>{{__('No.')}}</th> --}}
                                    <th>{{__('Restaurant Name')}}</th>
                                    <th>{{__('Last Name')}}</th>
                                    <th>{{__('First Name')}}</th>
                                    <th>{{__('Number Of People')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Check In')}}</th>
                                    <th>{{__('Check Out')}}</th>
                                    {{-- <th>{{__('Action')}}</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    var visitorTable = $("#visitors-table").DataTable({
        "dom": '<"row" <"col-sm-12 mb-3"<"html5buttons"B>>> <"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        // "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        buttons: [{
                extend: 'csv',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excel',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                title: 'Customers',
                orientation: 'landscape',
                pageSize: 'legal',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                },
                customize: function(doc) {
                    doc.content[1].table.widths = ["14%", "14%", "14%","7%","13%","14%","12%","12%"];
                },
            },
            {
                extend: 'print',
                title: 'Customers',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        processing: true,
        serverSide: true,
        responsive: true,
        stateSave: true,
        ajax: "{!! $module_route.'/datatable' !!}",
        columns: [
            // {
            //     data: 'DT_RowIndex',
            //     searchable: false,
            //     orderable: false,
            //     width: '10%'
            // },
            {
                data: 'restaurant_name',
                name: "settings.site_name",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'last_name',
                name: "last_name",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'first_name',
                name: "first_name",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'number_of_people',
                name: "number_of_people",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'phone',
                name: "phone",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'email',
                name: "email",
                defaultContent: "N/A",
            },
            {
                data: 'checkin_at',
                name: "checkin_at",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'checkout_at',
                name: "checkout_at",
                defaultContent: "N/A",
                width: '10%'
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

    //delete Record
    $(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var deleteMessage = "{{ __('You want to delete customer?') }}";
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", visitorTable, null, deleteMessage);
    });


    $(document).on('click', ".checkOut", function(e) {
        e.preventDefault();
        var id = $(this).attr('val');

        var updateUrl = "{!!  url($module_route)  !!}/checkout/" + id;
        var updateMessage = "{{ __('You want to checkout customer?') }}";

        swalWithBootstrapButtons.fire({
            title: "@lang('Are you sure?')",
            text: updateMessage,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'ml-2',
            confirmButtonText: "@lang('Yes, Checkout it!')",
            cancelButtonText: "@lang('No, cancel!')",
            reverseButtons: true,

            preConfirm: function(result) {
                if (result) {
                    $.ajax({
                        url: updateUrl,
                        method: "POST",
                        type: "JSON",

                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        success: function(data, status, xhr) {
                            $('#visitors-table').DataTable().draw();
                        },
                        error: function(xhr, status, error) {
                            displayError(xhr);
                        },
                    });
                }
            }
        });
    });

    setInterval(function() {
        visitorTable.draw(true);
    }, 300000);
</script>
@endpush