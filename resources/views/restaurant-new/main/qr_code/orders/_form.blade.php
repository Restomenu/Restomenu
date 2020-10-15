<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Quantity')}}</label>
            <div class="col-sm-6">
                <!-- {{ Form::text('quantity', null, ['id' => 'quantity', 'class'=>"form-control"]) }}
                @if($errors->has('quantity'))
                <p class="text-danger">{{ $errors->first('quantity') }}</p>
                @endif -->
                <input type="text" id="quantity" value="25" readonly style="border:0; font-size:20px; color:#007bff; font-weight:bold;">
                <input type="range" class="custom-range" name="quantity" value="25" min="25" max="100" oninput="updateTextInput(this.value);">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Delivery Street & nbr')}}</label>
            <div class="col-sm-6">
                {{ Form::text('address', null, ['id' => 'address', 'class'=>"form-control"]) }}
                @if($errors->has('address'))
                <p class="text-danger">{{ $errors->first('address') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Delivery Postcode')}}</label>
            <div class="col-sm-6">
                {{ Form::text('postcode', null, ['id' => 'postcode', 'class'=>"form-control"]) }}
                @if($errors->has('postcode'))
                <p class="text-danger">{{ $errors->first('postcode') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('City')}}</label>
            <div class="col-sm-6">
                {{ Form::text('city', null, ['id' => 'city', 'class'=>"form-control"]) }}
                @if($errors->has('city'))
                <p class="text-danger">{{ $errors->first('city') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Country')}}</label>
            <div class="col-sm-6">
                {{ Form::text('country', null, ['id' => 'country', 'class'=>"form-control"]) }}
                @if($errors->has('country'))
                <p class="text-danger">{{ $errors->first('country') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Sticker Cost')}}</label>
            <div class="col-sm-6 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                {{ Form::text('sticker_cost', config('restomenu.price.sticker_price'), ['id' => 'sticker_cost', 'class'=>"form-control" ,"readonly"]) }}
                @if($errors->has('sticker_cost'))
                <p class="text-danger">{{ $errors->first('sticker_cost') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Shipping Cost')}}</label>
            <div class="col-sm-6 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                {{ Form::text('shipping_cost',config('restomenu.price.shipping_price'), ['id' => 'shipping_cost', 'class'=>"form-control" ,"readonly"]) }}
                @if($errors->has('shipping_cost'))
                <p class="text-danger">{{ $errors->first('shipping_cost') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="form-group row">
            <label class="col-sm-3">{{__('Total Cost')}}</label>
            <div class="col-sm-6 input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                </div>
                {{ Form::text('total_cost', null, ['id' => 'total_cost', 'class'=>"form-control" ,"readonly"]) }}
                @if($errors->has('total_cost'))
                <p class="text-danger">{{ $errors->first('total_cost') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>



@push("scripts")

<script type="text/javascript">
    $(document).ready(function() {

        updateTextInput($('#quantity').val());



        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                quantity: {
                    required: true,
                    number: true

                },
                address: {
                    required: true,
                },
                postcode: {
                    required: false,
                },
                Country: {
                    required: true,
                },
                city: {
                    required: true,
                }

            },
            messages: {
                quantity: {
                    required: "@lang('This field is required.')",
                },
                address: {
                    required: "@lang('This field is required.')",
                },
                postcode: {
                    required: "@lang('This field is required.')",
                },
                Country: {
                    required: "@lang('This field is required.')",
                },
                city: {
                    required: "@lang('This field is required.')",
                },
            },
            submitHandler: function(form) {

                // const checkin_date = $('#checkin_date').val();
                // const checkin_time = $('#checkin_time').val();

                // var checkInAt = checkin_date +' '+ checkin_time;
                // $('.checkin-at-input').val(checkInAt);

                form.submit();
            }
        });
    });
</script>
<script>
    function updateTextInput(val) {
        $('#quantity').val(val);
        var total_cost = (Number(($('#quantity').val()) * Number($('#sticker_cost').val())) + Number($('#shipping_cost').val()));
        $('#total_cost').val(total_cost);
    }

    $(document).ready(function() {

        $("#slider-range-min").slider({
            range: "min",
            value: 37,
            min: 1,
            max: 700,
            slide: function(event, ui) {
                $("#amount").val("$" + ui.value);
            }
        });
        $("#amount").val("$" + $("#slider-range-min").slider("value"));
    });
</script>
@endpush