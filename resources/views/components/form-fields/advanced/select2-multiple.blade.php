@php
    $inputID = str_replace('.', '_', $inputValidationID);
    $route = !empty($ajaxRouteName) ? route($ajaxRouteName) : '';
    $tag = isset($inputTags) && $inputTags=='true' ? 'true' : '';
@endphp
<div class="form-group @error($inputValidationID) is-invalid @enderror">
    {{$slot}}
    <select style="width: 100%" multiple {{ $attributes->whereStartsWith('data') }}
        name="{{$inputName}}"
        id="{{$inputID}}"
        class="{{$inputClass}}"
        {{$inputRequired}}
        >
        @if(!empty($hideValue))
            @if($hasChildren=='true' && isset($childname))
                <x-form-fields.advanced.select2-option.multiple-option-loop-hidevalue-withchild
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
                <x-form-fields.advanced.select2-option.multiple-option-loop-hidevalue
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}"
                    hideValue="{{$hideValue}}" />
            @endif
        @else
            @if($hasChildren=='true' && isset($childname))
                <x-form-fields.advanced.select2-option.multiple-option-loop-withchild
                    :options="$options"
                    optionValueKey="{{$optionValueKey}}"
                    optionLabelKey="{{$optionLabelKey}}"
                    hasChildren="{{$hasChildren}}"
                    level="0"
                    childname="{{$childname}}"
                    childValueKey="{{$childValueKey}}"
                    childLabelKey="{{$childLabelKey}}" />
            @else
                <x-form-fields.advanced.select2-option.multiple-option-loop
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
                initializeSelect2AjaxMultiple('#{{$inputID}}', '{{ $route }}', '{{$labelText}}', '{{$ajaxInputLength}}', '{{$inputValue}}', '{{$tag}}');
            }else{
                initializeSelect2Multiple('#{{$inputID}}', '{{$labelText}}', '{{$inputValue}}', '{{$tag}}');
            }
        }
    });
</script>
@endpush