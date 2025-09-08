@php
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
@endphp
<div class="form-group">
    <label class="form-label {{$inputRequired=='true' ? 'required' : ''}}" for="{{$inputName}}">{!!$labelText!!} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    {{-- @if(!empty($inputValue))
    <div class="img-container">
    <img src="{{$inputValue}}" class="img-fluid rounded my-2" width="150" height="150" />
    </div>
    @endif --}}
    <input type="file" class="form-control-file @error($inputName) is-invalid @enderror {{$inputName}} dropify" id="{{$inputName}}" name="{{$inputName.$nameSuffix}}" {{$inputRequired=='true' ? 'required' : ''}}
        data-max-file-size-preview="{{$maxSize}}" data-height="{{$height}}" data-allowed-file-extensions="{{$extentions}}" data-max-file-size="{{$maxSize}}"
        data-errors-position="outside" accept="{{$accepts}}" {{$multiple=='true' ? 'multiple' : ''}} data-default-file="{{ !empty($inputValue) ? $inputValue : '' }}">
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>