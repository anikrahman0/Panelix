@php
    $inputID = str_replace('.', '_', $inputValidationID);
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
        <x-form-fields.advanced.select2-option.custom-single-category-option
            inputValue="{{$inputValue}}"
            :options="$options"
            optionValueKey="{{$optionValueKey}}"
            optionLabelKey="{{$optionLabelKey}}"
            parentID="0"
            level="0" />
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
            initializeSelect2Single('#{{$inputID}}', '{{$labelText}}', '{{$inputRequired}}', '{{$inputValue}}');
        }
    });
</script>
@endpush