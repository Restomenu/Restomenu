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
                                    <th>{{__('Comment')}}</th>
                                    <th>{{__('Ratings')}}</th>
                                    <th>{{__('Date')}}</th>
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
        // "dom": '<"row" <"col-sm-12 mb-3"<"html5buttons"B>>> <"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        "dom": '<"row" <"col-sm-4"l> <"col-sm-4"r> <"col-sm-4"f>> <"row"  <"col-sm-12"t>> <"row" <"col-sm-5"i> <"col-sm-7"p>>',
        // buttons: [{
        //         extend: 'csv',
        //         title: 'Customers',
        //         exportOptions: {
        //             columns: [0, 1, 2, 3, 4, 5, 6, 7]
        //         }
        //     },
        //     {
        //         extend: 'excel',
        //         title: 'Customers',
        //         exportOptions: {
        //             columns: [0, 1, 2, 3, 4, 5, 6, 7]
        //         }
        //     },
        //     {
        //         extend: 'pdf',
        //         title: 'Customers',
        //         orientation: 'landscape',
        //         pageSize: 'legal',
        //         exportOptions: {
        //             columns: [0, 1, 2, 3, 4, 5, 6, 7]
        //         },
        //         customize: function(doc) {
        //             doc.content[1].table.widths = ["14%", "14%", "14%","7%","13%","14%","12%","12%"];
        //         },
        //     },
        //     {
        //         extend: 'print',
        //         title: 'Customers',
        //         exportOptions: {
        //             columns: [0, 1, 2, 3, 4, 5, 6, 7]
        //         },
        //         customize: function(win) {
        //             $(win.document.body).find('h1').css('text-align', 'center');
        //             $(win.document.body).find('table')
        //                 .addClass('compact')
        //                 .css('font-size', 'inherit')
        //                 .css('border-spacing', '0px').find('.td').css('padding', '0px');
        //         }
        //     },
        // ],
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
                name: "restaurant_name",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'comment',
                name: "comment",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'ratings',
                name: "ratings",
                defaultContent: "N/A",
                width: '10%'
            },
            {
                data: 'created_at',
                name: "created_at",
                defaultContent: "N/A",
                width: '10%'
            },
        ],
        order: [
            [0, 'desc']
        ],
    });


    
</script>
@endpush