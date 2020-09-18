@php
$totalNotificationCount = auth()->guard('restaurant')->user()->totalNotificationCount();
$notificationsData = auth()->guard('restaurant')->user()->getAllNotificationData();
@endphp

<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-notifications">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    
                    <div class="indicator notification-indicator {{$totalNotificationCount === 0 ? 'd-none' : ''}}">
                        <div class="circle"></div>
                    </div>
                    
                </a>
                <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                    <div class="dropdown-header d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium">
                            <span id="notification-count">{{$totalNotificationCount}}</span>
                            New
                            {{$totalNotificationCount > 1 ? 'Notifications' : 'Notification'}}
                        </p>
                        {{-- <a href="javascript:;" class="text-muted">Clear all</a> --}}
                    </div>
                    <div class="dropdown-body header-notification-dropdown">
                    
                        <a href="javascript:;" class="dropdown-item no-notification-section {{$totalNotificationCount === 0 ? '' : 'd-none'}}">
                            {{-- <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div> --}}
                            <div class="content">
                                <p>No new notification</p>
                            </div>
                        </a>                    

                        <div class="notifications-list">
                            @if ($totalNotificationCount)
                            @foreach ($notificationsData as $notificationData)
                            @php
                            $notification = json_decode($notificationData->notification_data, true);

                            $message = $notification['first_name'] .' '.$notification['last_name'] . ' made reservation for '.$notification['number_of_people'] . ($notification['number_of_people'] == 1 ? ' person' :' persons').' for date '.Carbon\Carbon::createFromFormat('Y-m-d',$notification['appointment_date'])->format('d-m-Y').' '.$notification['appointment_time'].'.';

                            @endphp
                            <div>
                                <a href="{{route('restaurant.reservations.index')}}" class="dropdown-item">
                                    <div class="icon">
                                        <i data-feather="user-plus"></i>
                                    </div>
                                    <div class="content">
                                        <p>{{$message}}</p>
                                        {{-- <p><button class="btn btn-primary btn-xs">{{__('Accept')}}</button></p> --}}
                                        {{-- <p class="sub-text text-muted">2 sec ago</p> --}}
                                    </div>
                                </a>
                                {{-- <button class="btn btn-primary btn-xs"><i class='fa fa-edit'></i></button> --}}
                            </div>

                            @endforeach
                            @endif
                        </div>
                        {{-- <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="user-plus"></i>
                            </div>
                            <div class="content">
                                <p>New customer registered</p>
                                <p class="sub-text text-muted">2 sec ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="gift"></i>
                            </div>
                            <div class="content">
                                <p>New Order Recieved</p>
                                <p class="sub-text text-muted">30 min ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="alert-circle"></i>
                            </div>
                            <div class="content">
                                <p>Server Limit Reached!</p>
                                <p class="sub-text text-muted">1 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="layers"></i>
                            </div>
                            <div class="content">
                                <p>Apps are ready for update</p>
                                <p class="sub-text text-muted">5 hrs ago</p>
                            </div>
                        </a>
                        <a href="javascript:;" class="dropdown-item">
                            <div class="icon">
                                <i data-feather="download"></i>
                            </div>
                            <div class="content">
                                <p>Download completed</p>
                                <p class="sub-text text-muted">6 hrs ago</p>
                            </div>
                        </a> --}}
                    </div>
                    <div class="dropdown-footer d-flex align-items-center justify-content-center">
                        <a href="{{route('restaurant.reservations.index')}}">View all</a>
                    </div>
                </div>
            </li>


            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if (app()->getLocale() == 'en')
                    <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span
                        class="font-weight-medium ml-1 mr-1">English</span>

                    @elseif (app()->getLocale() == 'fr')
                    <i class="flag-icon flag-icon-fr" title="fr"></i> <span class="ml-1"> Français </span></a>

                @elseif (app()->getLocale() == 'nl')
                <i class="flag-icon flag-icon-be" title="nl"></i> <span class="ml-1"> Nederlands </span></a>
                @endif
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_dutch==1)
                    <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-nl">
                        <i class="flag-icon flag-icon-be" title="us"></i>
                        <span class="ml-1"> Nederlands </span>
                    </a>
                    @endif

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_french==1)
                    <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-fr">
                        <i class="flag-icon flag-icon-fr" title="us"></i>
                        <span class="ml-1"> Français </span>
                    </a>
                    @endif

                    @if (auth()->guard('restaurant')->user()->setting->admin_language_english==1)
                    <a href="javascript:;" class="dropdown-item py-2" id="lang-btn-en">
                        <i class="flag-icon flag-icon-us" title="us"></i>
                        <span class="ml-1"> English </span>
                    </a>

                    @endif
                </div>
            </li>

            <li class="nav-item">
                <a class="btn btn-light" href="{{ env('APP_URL').'/'.auth()->guard('restaurant')->user()->slug }}"
                    target="_blank">
                    {{ __('See Live Menu') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link send-feedback-btn" href="#" data-toggle="modal" data-target="#feedbackModal">
                    <i class="link-icon" data-feather="message-square"></i>
                </a>
            </li>

            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath(auth()->guard('restaurant')->user()->id).auth()->guard('restaurant')->user()->setting->site_logo)}}"
                        alt="profile">
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            <img src="{{asset('storage/'.app('App\Repositories\RestaurantRepository')->getImagePath(auth()->guard('restaurant')->user()->id).auth()->guard('restaurant')->user()->setting->site_logo)}}"
                                alt="">
                        </div>
                        <div class="info text-center">
                            <p class="name font-weight-bold mb-0">{{auth()->guard('restaurant')->user()->name}}</p>
                            <p class="email text-muted mb-3">{{auth()->guard('restaurant')->user()->email}}</p>
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <!-- <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{route('restaurant.restaurant-setting-edit')}}" class="nav-link">
                                    <i data-feather="coffee"></i>
                                    <span>My Restaurant</span>
                                </a>
                            </li>

                            @impersonate
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('restaurant.impersonate.destroy') }}">
                                    <i data-feather="log-out"></i>
                                    {{ __('Log out') }}
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('restaurant.logout') }}"
                                    onclick="event.preventDefault();          document.getElementById('logout-form4').submit();">
                                    <i data-feather="log-out"></i>
                                    {{ __('Log out') }}
                                </a>
                                <form id="logout-form4" action="{{ route('restaurant.logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endimpersonate
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    @lang('Leave a Comment')
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" id="feedbackForm">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control rm-text-input" name="comment" id="" rows="5"
                            placeholder="@lang('Comment (required)')"></textarea>
                    </div>

                    <input type="hidden" class="form-control" name="ratings" id="ratings">
                    <div class="form-group text-center">
                        <div class="feedback-ratings" data-rating="0"> </div>
                    </div>
                </div>
                <div class="modal-footer feedback-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit"
                        class="btn btn-primary shadow-none btn-restomenu-primary feedback-submit-btn">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $("#lang-btn-en").click(function() {
        window.location = "{{ route('restaurant.lang',['locale' => 'en']) }}";
    });
    $("#lang-btn-nl").click(function() {
        window.location = "{{ route('restaurant.lang',['locale' => 'nl']) }}";
    });
    $("#lang-btn-fr").click(function() {
        window.location = "{{ route('restaurant.lang',['locale' => 'fr']) }}";
    });

    $(".feedback-ratings").starRating({
        totalStars: 5,
        initialRating: 0,
        starShape: 'rounded',
        starSize: 40,
        emptyColor: 'lightgray',
        hoverColor: "#727cf5",
        activeColor: "#727cf5",
        ratedColor: "#727cf5",
        disableAfterRate: false,
        useGradient: false,
        callback: function(currentRating, $el) {
            $('#ratings').val(currentRating);
        }
    });

    var feedbackFormValidation = $("#feedbackForm").validate({
        normalizer: function(value) {
            return $.trim(value);
        },
        ignore: [],
        rules: {
            ratings: {
                required: false,
            },
            comment: {
                required: true,
            }
        },
        messages: {
            ratings: {
                required: "@lang('Ratings are required.')",
            },
            comment: {
                required: "@lang('This field is required.')",
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "ratings") {
                error.insertAfter($('.feedback-ratings'));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function() {
            sendFeedback();
        },
    });


    function sendFeedback() {
        var feedbackFormData = $('#feedbackForm').serialize();

        $.ajax({
            url: '{{ route("restaurant.restaurant-feedbacks.store") }}',
            method: 'POST',
            data: feedbackFormData,
            processData: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            beforeSend: function() {
                $('.feedback-submit-btn').prop("disabled", true);
                $('.feedback-submit-btn').html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> @lang('Loading')...`);
            },
            success: function(data, status, xhr) {
                $('#feedbackModal').modal('hide');
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
                $('.feedback-submit-btn').attr("disabled", false);
                $('.feedback-submit-btn').html(`@lang('Save')`);
            }
        });
    }

    $('#feedbackModal').on('hidden.bs.modal', function() {
        $('#feedbackForm').trigger("reset");
        feedbackFormValidation.resetForm();
        $('#feedbackForm').find('.error').removeClass('error');

        $('.feedback-ratings').starRating('setRating', 0);
    });
</script>
@endpush