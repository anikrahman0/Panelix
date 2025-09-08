@php
    $disabled = $disabled ?? '';
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
    $errName = '';
    if(isset($inputIndex)) {
        $errName = str_replace(array( '[', ']' ), '', $inputName).'.'.$inputIndex;
    }else{
        $errName = $inputName;
    }
@endphp
<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <input class="form-control @error($errName) is-invalid @enderror" placeholder="{{isset($placeHolder) ? $placeHolder : $labelText}}" {{$inputRequired=='true' ? 'required' : ''}} 
    name="{{$inputName.$nameSuffix}}" {{$disabled}} type="{{$inputType}}" value="{{$inputValue}}" {{(isset($pattern) && !empty($pattern)) ? "pattern=$pattern" : ''}} maxlength="{{$maxlength ?? ''}}" id="{{$inputName}}" aria-required="{{$inputRequired}}">
    @error($errName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>