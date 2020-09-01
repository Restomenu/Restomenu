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

    // Echo.private("reservation").listen("ReservationEvent", e => {
    //     // console.log(e.action);
    //     console.log(e);
        
    //     console.log('here');
    //     fnToastSuccess(e.message);
    // });
</script>