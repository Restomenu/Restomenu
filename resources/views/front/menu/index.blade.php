@extends('front.menu.layouts.default')

@section('content')

<div class="container main-content-wrapper">
	<div class="accordion" id="accordionExample">
		@foreach ($result as $categoryKey => $category)
		@if (count($category->dishes))
		<div class="card category-card">
			<div class="card-header category-collapse-header" id="headingOne" data-toggle="collapse"
				data-target="#category_{{$categoryKey}}" aria-expanded="false"
				aria-controls="category_{{$categoryKey}}">
				@if ($category->image)
				<img src="{{$category->category_image_full_path}}" alt="">
				@endif
				<div class="category-text">
					<div class="mb-0 category-heading">
						{{$category->name}}
					</div>
					<div class="category-right-icon">
						<i class="fa fa-chevron-right fa-arrow-down-animated" aria-hidden="true"></i>
					</div>
				</div>
			</div>

			<div id="category_{{$categoryKey}}" class="collapse" aria-labelledby="headingOne"
				data-parent="#accordionExample">
				<div class="card-body dish-main-block">

					@foreach ($category->dishes as $key => $dish)

					<div class="item-box-enhanced menu-block {{request()->getHost() != env('TAKEAWAY_DOMAIN') ? 'menu-block-bordered' : '' }}"
						id="">
						@if ($dish->image)
						<img class="food-image-enhanced" src="{{$dish->dish_image_full_path}}" />
						@endif
						<div class="item-text-enhanced">
							<div class="d-flex justify-content-between">
								<div class="dish-name">
									<h4>{{$dish->name ?? ''}}</h4>
								</div>
								<div class="price-block ml-1">
									<h3><span class="price-sign">
											@if($dish->price)
											{{config("restomenu.constants.currencySign")}}</span>
										&nbsp;{{$dish->price ?? ''}}&nbsp;
										@endif
									</h3>
								</div>
							</div>
							<h5></h5>

							@if ($dish->description)
							<div class="dish-desc-block">
								<div class="circle-divider-enhanced-gray">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</div>
								<h6>{{$dish->description ?? ''}}</h6>
								<div class="circle-divider-enhanced">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</div>
							</div>
							@endif

							<div class="allergen-image-block">
								@foreach ($dish['dishAllergens'] as $allergen)
								<img src="{{asset($allergen['allergens']->icons_full_path)}}" class="allergen-image" />
								@endforeach
							</div>

						</div>
						{{-- <div class="order-quantity">
							<!-- <a style="display:none;" class="remove-from-cart-button" data-remote="true" rel="nofollow" data-method="delete" href="">-</a> -->
							<a style="display:none;" class="remove-from-cart-button" href="javascript:void(0);">-</a>
							<p class="order-quantity-number">0</p>
							<form class="new_order_row" id="new_order_row" action="javascript:void(0);" method="post">
								<input name="utf8" type="hidden" value="&#x2713;" />

								<input value="313972" type="hidden" name="order_row[food_id]" id="order_row_food_id" />
								<input value="313972" type="hidden" name="order_row[food_id]" id="order_row_food_id" />
								<input value="562877" type="hidden" name="order_row[menu_id]" id="order_row_menu_id" />

								<input type="submit" name="commit" value="+" class="add-to-cart-button" />
							</form>
						</div> --}}
					</div>

					@if(request()->getHost() == env('TAKEAWAY_DOMAIN'))
					<div class="order-quantity">
						<!-- <a style="display:none;" class="remove-from-cart-button" data-remote="true" rel="nofollow" data-method="delete" href="">-</a> -->
						<a style="display:none;" class="remove-from-cart-button" href="javascript:void(0);">-</a>
						<p class="order-quantity-number">0</p>
						<form class="new_order_row" id="new_order_row" action="javascript:void(0);" method="post">
							{{-- <input name="utf8" type="hidden" value="&#x2713;" /> --}}

							<input value="313972" type="hidden" name="order_row[food_id]" id="order_row_food_id" />
							<input value="562877" type="hidden" name="order_row[menu_id]" id="order_row_menu_id" />

							<input type="submit" name="commit" value="+" class="add-to-cart-button" />
						</form>
					</div>
					@endif
					{{-- <div class="order-quantity">
						<!-- <a style="display:none;" class="remove-from-cart-button" data-remote="true" rel="nofollow" data-method="delete" href="">-</a> -->
						<a style="display:none;" class="remove-from-cart-button" href="javascript:void(0);">-</a>
						<p class="order-quantity-number">0</p>
						<form class="new_order_row" id="new_order_row" action="javascript:void(0);" method="post">
							<input name="utf8" type="hidden" value="&#x2713;" />

							<input value="313972" type="hidden" name="order_row[food_id]" id="order_row_food_id" />
							<input value="313972" type="hidden" name="order_row[food_id]" id="order_row_food_id" />
							<input value="562877" type="hidden" name="order_row[menu_id]" id="order_row_menu_id" />

							<input type="submit" name="commit" value="+" class="add-to-cart-button" />
						</form>
					</div> --}}
					@endforeach
				</div>
			</div>
		</div>

		@endif
		@endforeach

		{{-- combo --}}
		@if (count($comboDishes))

		<div class="card category-card">
			<div class="card-header category-collapse-header" id="headingOne" data-toggle="collapse"
				data-target="#category_menu" aria-expanded="false" aria-controls="category_menu">
				<div class="category-text">
					<div class="mb-0 category-heading">
						@lang('Menu')
					</div>
					<div class="category-right-icon">
						<i class="fa fa-chevron-right fa-arrow-down-animated" aria-hidden="true"></i>
					</div>
				</div>
			</div>

			<div id="category_menu" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body dish-main-block">

					@foreach ($comboDishes as $key => $comboDish)
					@if (array_key_exists($comboDish->name,$comboDishesDetails) &&
					count($comboDishesDetails[$comboDish->name]))
					<div class="item-box-enhanced menu-block {{request()->getHost() != env('TAKEAWAY_DOMAIN') ? 'menu-block-bordered' : '' }}"
						id="">

						<div class="item-text-enhanced">
							@if ($comboDish->image)
							<img class="food-image-enhanced combo-food-image"
								src="{{$comboDish->combo_dish_image_full_path}}" />
							@endif
							<div class="d-flex justify-content-center text-center">

								<div class="dish-name combo-dish-name">
									<h4>{{$comboDish->name}}</h4>
									@if($comboDish->sub_title)
									<h5 class="subtitle-text">{{ '('.$comboDish->sub_title.')' }}</h5>
									@endif
								</div>
							</div>

							@foreach ($comboDishesDetails[$comboDish->name] as $category => $comboDishesDetail)
							<div class="item-box-enhanced menu-block combo-menu-item-block" id="">
								<div class="item-text-enhanced">
									<h4 class="combo-category">{{$category ?? ''}}</h4>
									@foreach ($comboDishesDetail as $item)
									<h6 class="combo-dish-item-name">{!!$item['dish_name'] ?? '' !!}
										{{ $item['dish_quantity'] > 1 ? 'x'.$item['dish_quantity'] :'' }}</h6>
									@endforeach
								</div>
							</div>
							@endforeach

							@if($comboDish->price)
							<div class="item-box-enhanced menu-block combo-price-block" id="">
								<div class="item-text-enhanced">
									<div class="price-container-enhanced combo-price-container">
										<div class="price-box-enhanced">
											<h6>{{config("restomenu.constants.currencySign")}}</h6>
											<h3>&nbsp;{{$comboDish->price ?? ''}}&nbsp;</h3>
											<h6>&nbsp;</h6>
											<h6>
											</h6>
										</div>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
		@endif

	</div>

	<!-- Button trigger modal -->
	<div class="text-center">
		<button type="button" class="btn btn-primary btn-sm mt-3 feedback-modal-btn btn-restomenu-primary shadow-none"
			data-toggle="modal" data-target="#feedbackModal">
			@lang('Leave a Comment')
		</button>
	</div>


	<div class="text-center social-icon-block mt-3">

		@if($restaurant->setting->fb_url)
		<a href="{{$restaurant->setting->fb_url}}" target="_blank">
			<img src="{{asset('front/images/social/fb.svg')}}" alt="Facebook">
		</a>
		@endif

		@if($restaurant->setting->ig_url)
		<a href="{{$restaurant->setting->ig_url}}" target="_blank">
			<img src="{{asset('front/images/social/ig.svg')}}" alt="Instagram">
		</a>
		@endif

		@if($restaurant->setting->tw_url)
		<a href="{{$restaurant->setting->tw_url}}" target="_blank">
			<img src="{{asset('front/images/social/tw.svg')}}" alt="Twitter">
		</a>
		@endif
	</div>

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
				<form action="{{route('menu-feedbacks.store',['slug'=>$restaurant->slug])}}" method="post"
					id="feedbackForm">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control rm-text-input shadow-none" name="user_name"
								id="user_name" placeholder="@lang('Enter your name (optional)')">
						</div>

						<div class="form-group">
							<input type="email" class="form-control rm-text-input shadow-none" name="user_email"
								id="user_email" placeholder="@lang('Enter your email (optional)')">
						</div>

						<div class="form-group">
							<textarea class="form-control rm-text-input" name="comment" id="" rows="3"
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
</div>
@endsection

@push("scripts")

<script>
	$(".collapse").on('show.bs.collapse', function() {
		$(this).prev(".category-collapse-header").find(".fa").addClass("fa-arrow-up-animated");
		// $(this).prev('.category-collapse-header').addClass('active');

	}).on('hide.bs.collapse', function() {
		$(this).prev(".category-collapse-header").find(".fa").removeClass("fa-arrow-up-animated");
		// $(this).prev('.category-collapse-header').removeClass('active');
	});

	var primaryColor = '{{$restaurant->setting->menu_primary_color}}';
	$(".feedback-ratings").starRating({
		totalStars: 5,
		initialRating:0,
		starShape: 'rounded',
		starSize: 40,
		emptyColor: 'lightgray',
		hoverColor: primaryColor,
		activeColor: primaryColor,
		ratedColor:primaryColor,
		disableAfterRate: false,
		useGradient: false,
		callback: function(currentRating, $el){
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
				required: true,
			},
			comment:{
				required: true,
			}
		},
		messages: {
			ratings: {
				required: "@lang('Ratings are required.')",
			},
			comment:{
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

			var url = '{{ route("menu-feedbacks.store", ":slug") }}';
			url = url.replace(':slug', "{{$restaurant->slug}}");

            $.ajax({
                url: url,
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

@include('front.menu.layouts.includes.customjs')

@endpush