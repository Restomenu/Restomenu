<script src="{{ asset('reservation/js/app.js') }}"></script>
<script src="{{ asset('reservation/js/vendor.js') }}" type="text/javascript"></script>
<script src="{{ asset('reservation/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/echo.js') }}" type="text/javascript"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 5000
    };

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
        toastr.error('{!! str_replace("'", '"', \Session::get('error')) !!}', "@lang('Error')");
    @endif
    @if(\Session::has('success'))
        toastr.success('{!! \Session::get('success') !!}', "@lang('Success')");
    @endif

    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>

    function deleteRecordByAjax(deleteUrl, moduleName, dataTablesName, callback, deleteMessage = null) {
        
        var deleteAlertStr = "You want to delete " + moduleName + "?";
        if(deleteMessage){
            deleteAlertStr = deleteMessage;
        }

        swal({
            title: "@lang('Are you sure?')",
            text: deleteAlertStr,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "@lang('Yes, Remove it!')",
            cancelButtonText: "@lang('No, cancel!')",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
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
                                swal("@lang('success!')", result.message, "success");
                                fnToastSuccess(result.message);

                                if (callback && typeof callback == 'function') {
                                    callback();
                                }
                            },
                            error: function(xhr, status, error) {
                                if (xhr.responseJSON && xhr.responseJSON.message != "") {
                                    swal("@lang('ohh snap!')", xhr.responseJSON.message, "error");
                                } else {
                                    swal("@lang('ohh snap!')", "@lang('Something went wrong, please try again later.')", "error");
                                }
                                ajaxError(xhr, status, error);
                            }
                        });
                    }, 0)
                })
            },
        }).catch(swal.noop);
    }

    function fnToastSuccess(message) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.success(message,"@lang('Success')");
    }

    function fnToastError(message) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.error(message,"@lang('Error')");
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


</script>