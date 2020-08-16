@push("styles")
<style>
    .col-form-label {
        padding-left: 15px;
        padding-right: 15px;
        font-weight: bold;
    }
</style>
@endpush


<div class="form-group row">
    <label class="col-form-label col-sm-2">{{__('Icon')}}</label>
    <div class="col-sm-6">
        {{ Form::file("icon[]", ["class"=>"form-control", "id" => "icon","multiple" => "multiple"]) }}

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- @if($errors->has('icon.*'))
            <p class="text-danger">{{ $errors->first('icon') }}</p>
        @endif --}}
    </div>
</div>


@push("scripts")
<script type="text/javascript">
    $(document).ready(function() {
        $("#form_validate").validate({
            ignore: [],
            errorElement: 'p',
            errorClass: 'text-danger',
            normalizer: function(value) {
                return $.trim(value);
            },
            rules: {
                "icon[]": {
                    required: true
                }
            },
            messages: {
			    "icon[]": {
				    required: "@lang('This field is required.')",
			    },
		    },
        });
    });
</script>

@endpush