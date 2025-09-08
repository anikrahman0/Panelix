@php
    $inputID = str_replace('.', '_', $inputValidationID);
    $route = !empty($ajaxRouteName) ? route($ajaxRouteName) : '';
@endphp
<div class="form-group @error($inputValidationID) is-invalid @enderror">
    {{$slot}}
    <select style="width: 100%" {{ $attributes->whereStartsWith('data') }}
        name="{{$inputName}}"
        id="{{$inputID}}"
        class="{{$inputClass}}"
        {{$inputRequired}}
        >
        <option value="">{{$labelText}}</option>
        @if(!empty($hideValue))
            @if($hasChildren=='true' && isset($childname))
                <x-form-fields.advanced.select2-option.single-option-loop-hidevalue-withchild
                    inputValue="{{$inputValue}}"
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}"
                    hasChildren="{{$hasChildren}}"
                    level="0"
                    childname="{{$childname}}"
                    childValueKey="{{$childValueKey}}"
                    childLabelKey="{{$childLabelKey}}"
                    hideValue="{{$hideValue}}" />
            @else
                <x-form-fields.advanced.select2-option.single-option-loop-hidevalue
                    inputValue="{{$inputValue}}"
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}"
                    hideValue="{{$hideValue}}" />
            @endif
        @else
            @if($hasChildren=='true' && isset($childname))
                <x-form-fields.advanced.select2-option.single-option-loop-withchild
                    inputValue="{{$inputValue}}"
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}"
                    hasChildren="{{$hasChildren}}"
                    level="0"
                    childname="{{$childname}}"
                    childValueKey="{{$childValueKey}}"
                    childLabelKey="{{$childLabelKey}}" />
            @else
                <x-form-fields.advanced.select2-option.single-option-loop
                    inputValue="{{$inputValue}}"
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}" />
            @endif
        @endif
    </select>
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        if(!"{{$inputID}}".includes("$")){
            var getAjaxData = "{{$getAjaxData ?? ''}}";
            if(getAjaxData=="true"){            
                initializeSelect2AjaxSingle('#{{$inputID}}', '{{ $route }}', '{{$labelText}}', '{{$inputRequired}}', '{{$ajaxInputLength}}', '{{$inputValue}}');
            }else{
                initializeSelect2Single('#{{$inputID}}', '{{$labelText}}', '{{$inputRequired}}', '{{$inputValue}}');
            }
        }
    });
</script>
{{-- <script>
    $(document).ready(function() {
        let attributes = {}
        attributes.placeholder = "{{$labelText}}"
        let required = "{{$inputRequired}}"
        if(required=='required'){
            attributes.allowClear = false
        }else{
            attributes.allowClear = true
        }
        
        if(!"{{$inputID}}".includes("$")){
            $("#{{$inputID}}").select2(attributes);
        }
    });
</script> --}}
@endpush