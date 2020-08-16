@extends('front.menu.layouts.default')

@section('content')

{{-- <div class="clickable-categories scroller" id="categories-top-box">

	@foreach ($result as $category)

	@if (count($category->dishes))
	<p class="menu-category-jump Food_{{$category->id}}" id="{{$category->id}}">{{$category->name}}</p>
@endif
@endforeach

@if(count($comboDishes))
<p class="menu-category-jump Food_combo_menu" id="combo_menu">@lang('messages.menu_name_for_combo')</p>
@endif

</div> --}}

<div class="container main-content-wrapper">
	<div class="accordion" id="accordionExample">
		<div class="card category-card">
			<div class="card-header category-collapse-header" id="headingOne" data-toggle="collapse"
				data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
				<img src="https://menulingua.s3.amazonaws.com/uploads/food/image/313972/menu_fries-and-sauce-s.jpg"
					alt="">
				<div class="category-text">
					<div class="mb-0 category-heading">
						Appetizers
					</div>
					<div class="category-right-icon">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>

			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				<div class="card-body">

				</div>
			</div>
		</div>


		<div class="card category-card">
			<div class="card-header category-collapse-header" id="headingTwo" data-toggle="collapse"
				data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				<img src="https://menulingua.s3.amazonaws.com/uploads/food/image/313972/menu_fries-and-sauce-s.jpg"
					alt="">
				<div class="category-text">
					<div class="mb-0 category-heading">
						Desserts
					</div>
					<div class="category-right-icon">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>

			<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
				<div class="card-body">

				</div>
			</div>
		</div>

		<div class="card category-card">
			<div class="card-header category-collapse-header" id="headingThree" data-toggle="collapse"
				data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				<img src="https://menulingua.s3.amazonaws.com/uploads/food/image/313972/menu_fries-and-sauce-s.jpg"
					alt="">
				<div class="category-text">
					<div class="mb-0 category-heading">
						Aperitif
					</div>
					<div class="category-right-icon">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
				</div>
			</div>
			<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				<div class="card-body">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="sortable">

	@foreach ($result as $category)

	@if (count($category->dishes))

	<div class="item-box-enhanced major-category-header-block" id="Food_{{$category->id}}">

		@if ($category->image)
		<img class="food-image-enhanced" src="{{$category->category_image_full_path}}" />
		@endif

		<div class="item-text-enhanced">
			<h4>{{$category->name}}</h4>
			<h5></h5>
		</div>
	</div>

	@foreach ($category->dishes as $key => $dish)

	<div class="item-box-enhanced menu-block " id="">

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
							{{config("restomenu.constants.currencySign")}}</span> &nbsp;{{$dish->price ?? ''}}&nbsp;
						@endif
					</h3>
				</div>
			</div>
			<h5></h5>
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
	</div>

	<div class="order-quantity">
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
	</div>

	<!-- @if ($key < count($category->dishes)-1)
		<div class="order-quantity">
		</div>
		@endif -->

	@endforeach

	@endif
	@endforeach


	{{-- combo --}}
	<div class="item-box-enhanced major-category-header-block" id="Food_combo_menu">
		<div class="item-text-enhanced">
			<h4>Menu</h4>
		</div>
	</div>

	@foreach ($comboDishes as $key => $comboDish)

	@if (array_key_exists($comboDish->name,$comboDishesDetails) && count($comboDishesDetails[$comboDish->name]))
	<div class="item-box-enhanced major-category-header-block" id="Food_combo_{{$comboDish->id}}">

		@if ($comboDish->image)
		<img class="food-image-enhanced" src="{{$comboDish->combo_dish_image_full_path}}" />
		@endif

		<div class="item-text-enhanced">
			<h4>{{$comboDish->name}}</h4>
			@if($comboDish->sub_title)
			<h5 class="subtitle-text">{{ '('.$comboDish->sub_title.')' }}</h5>
			@endif
			<h5></h5>
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

	<div class="order-quantity">
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

	@endif

	@endforeach
</div>
@endsection

@push("scripts")

@include('front.menu.layouts.includes.customjs')

@endpush