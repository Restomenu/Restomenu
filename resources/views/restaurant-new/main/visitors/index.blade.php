@extends('restaurant-new.layouts.default')

@section('title', isset($module_name) ? __(Str::plural($module_name)) : '')

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
                            <a href="{{ $module_route."/create" }}"
                                class="btn btn-sm btn-primary pull-right">{{__('Add')}}</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="text-center">
                        <div class="btn-group mb-3 select-visitor-type" role="group">
                            <button type="button" class="btn btn-secondary"
                                data-type="checkIn">{{__('Check In')}}</button>
                            <button type="button" class="btn btn-outline-secondary"
                                data-type="checkOut">{{__('Check Out')}}</button>
                            <button type="button" class="btn btn-outline-secondary"
                                data-type="all">{{__('All')}}</button>
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
    var visitorsFilterValue = null;
    var visitorTable = $("#visitors-table").DataTable({
        // "dom": '<"row" <"col-sm-12 mb-3"<"html5buttons"B>>> <"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        buttons: [
            {
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
                    doc.content[1].table.widths = ["16%", "16%","9%","13%","16%","15%","15%"];
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
            "sEmptyTable":     "{{__('No data available in table')}}",
            "sInfo":           "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
            "sInfoEmpty":      "{{__('Showing')}} 0 {{__('to')}} 0 {{__('of')}} 0 {{__('entries')}}",
            "sInfoFiltered":   "({{__('filtered from')}} _MAX_ {{__('total')}} {{__('entries')}})",
            "sInfoPostFix":    "",
            "sInfoThousands":  ",",
            "sLengthMenu":     "{{__('Show')}} _MENU_ {{__('entries')}}",
            "sLoadingRecords": "{{__('Loading...')}})",
            "sProcessing":     "{{__('Processing...')}}",
            "sSearch":         "{{__('Search')}}:",
            "sZeroRecords":    "{{__('No matching records found')}}",
            "oPaginate": {
                "sFirst":    "{{__('First')}}",
                "sLast":     "{{__('Last')}}",
                "sNext":     "{{__('Next')}}",
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
                data: 'checkin_at',
                name: "checkin_at",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'checkout_at',
                name: 'checkout_at',
                orderable: false,
                "render": function(data, type, full, meta) {
                    var resultStr = '';
                    if (!full.checkout_at) {
                        resultStr += "&nbsp;<a href='javascript:void(0);' class='checkOut btn btn-xs btn-danger ml-1' val='" + full.id + "'>@lang('Check Out')</a> ";

                        return resultStr;
                    } else if (full.checkout_at) {
                        return full.checkout_at;
                    }
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

    //delete Record
    $(document).on('click', '.deleteRecord', function(event) {
        var id = $(this).attr('val');
        var deleteUrl = "{!!  $module_route  !!}/" + id;
        var deleteMessage = "{{ __('You want to delete customer?') }}";
        var isDelete = deleteRecordByAjax(deleteUrl, "{{$module_name}}", visitorTable, null, deleteMessage);
    });

    $('.select-visitor-type button').click( function() {
        $(this).removeClass('btn-outline-secondary').addClass('btn-secondary').siblings().removeClass('btn-secondary').addClass('btn-outline-secondary');

        visitorsFilterValue = $(this).data('type');
        
        visitorTable.draw(true);
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
                            visitorTable.draw();
                            swalWithBootstrapButtons.fire("@lang('success!')", data.message, "success");
                        },
                        error: function(xhr, status, error) {
                            ajaxError(xhr, status, error);
                        },
                    });
                }
            }
        });
    });

</script>
@endpush