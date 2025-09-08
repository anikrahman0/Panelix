@php
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
@endphp
<div class="form-check mb-2">
    <input {{ $attributes->whereStartsWith('data') }}  name="{{$name.$nameSuffix}}" class="form-check-input {{ $checkboxClass }}"  {{ $isChecked ?? '' }} type="checkbox" value="{{$checkValue}}" id="{{ $id }}">
    <label class="badge {{ $labelClass }}" for="{{ $id }}">{{ $labelText }}</label>
</div>
