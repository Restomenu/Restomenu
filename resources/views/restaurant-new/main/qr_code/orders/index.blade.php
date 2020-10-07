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

                <!-- <div class="text-center">
                    <div class="btn-group mb-3 select-visitor-type" role="group">
                        <button type="button" class="btn btn-secondary" data-type="all">{{__('All')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="accept">{{__('Accept')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="pending">{{__('Pending')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="schedule">{{__('Schedule')}}</button>
                        <button type="button" class="btn btn-outline-secondary" data-type="cancel">{{__('Cancel')}}</button>
                    </div>
                </div> -->

                <div class="table-responsive">
                    <table id="visitors-table" class="table table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                {{-- <th>{{__('No.')}}</th> --}}
                                <th>{{__('Quantity')}}</th>
                                <th>{{__('Sticker Cost')}}</th>
                                <th>{{__('Shipping Cost')}}</th>
                                <th>{{__('Total Cost')}}</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('Postcode')}}</th>
                                <th>{{__('City')}}</th>
                                <th>{{__('Country')}}</th>
                                {{-- <th>{{__('Action')}}</th> --}}
                            </tr>
                        </thead>
                    </table>
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
            "sLengthMenu": "{{__('Show')}} _qr_ {{__('entries')}}",
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
                data: 'quantity',
                name: "quantity",
                defaultContent: "N/A",
                width: '20%'
            },
          
            {
                data: 'sticker_cost',
                name: "sticker_cost",
                defaultContent: "N/A",
                searchable: true,
                orderable: true,
                width: '20%'
            },
            {
                data: 'shipping_cost',
                name: "shipping_cost",
                defaultContent: "N/A",
                width: '20%'
            },
            {
                data: 'total_cost',
                name: "total_cost",
                searchable: false,
                defaultContent: "N/A",
                width: '20%'
            },
            {
                data: 'address',
                name: "address",
                defaultContent: "N/A",
                searchable: false,
                width: '20%'
            },
            {
                data: 'postcode',
                name: "postcode",
                defaultContent: "N/A",
                searchable: false,
                width: '20%'
            },
            {
                data: 'city',
                name: "city",
                defaultContent: "N/A",
                searchable: false,
                width: '20%'
            },
            {
                data: 'country',
                name: "country",
                defaultContent: "N/A",
                searchable: false,
                width: '20%'
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

   

   
</script>
@endpush