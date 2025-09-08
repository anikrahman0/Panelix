@php
    $inputNameSuffix = $inputNameSuffix ?? false;
    $nameSuffix = $inputNameSuffix ? '[]' : '';
    $errName = '';
    $index='';
    if(isset($inputIndex)) {
        $index = $inputIndex;
        $errName = str_replace(array( '[', ']' ), '', $inputName).'.'.$inputIndex;
    }else{
        $errName = $inputName;
    }
@endphp
<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$commonClass ?? ''}} {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <select style="width: 100%" name="{{$inputName.$nameSuffix}}" id="{{$inputName.$index}}" class="form-control @error($errName) is-invalid @enderror {{$inputName}}" {{$inputRequired=='true' ? 'required' : ''}} aria-required="{{$inputRequired}}">
        <option value="">Select {{$labelText}}</option>
        @foreach($options as $option)
            <option value="{{$option[$optionValueKey]}}" @selected($inputValue==$option[$optionValueKey])><span class="boldCat">{{$option[$optionLabelKey]}}</span></option>
        @endforeach
    </select>
    @error($errName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        if("{{$index}}"=='' || !isNaN("{{$index}}")){
            $("#{{$inputName.$index}}").select2({
                placeholder: "Select {{$labelText}}",
            });
        }
    });
</script>
@endpush