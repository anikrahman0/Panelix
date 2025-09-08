@php
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
    $inputArray = explode(',' , $inputValue);
@endphp
<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <select style="width: 100%" multiple name="{{$inputName.$nameSuffix}}" id="{{$inputName}}" class="form-control @error($inputName) is-invalid @enderror {{$inputName}}" {{$inputRequired=='true' ? 'required' : ''}} aria-required="{{$inputRequired}}">
        @foreach($options as $option)
        <option value="{{ $option[$optionValueKey] }}"  
            {{ is_array($inputArray) && in_array($option[$optionValueKey], $inputArray) ? 'selected': '' }}>
            <span class="boldCat">{{$option[$optionLabelKey]}}</span>
        </option>
        @endforeach
    </select>
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

{{-- @push('script')
<script>
    $(document).ready(function() {
        $("#{{$inputName}}").select2({
            placeholder: "Select {{$labelText}}",
            allowClear: true,
            maximumSelectionLength: {{$maxItemSelect}}
        });
    });
</script>
@endpush --}}