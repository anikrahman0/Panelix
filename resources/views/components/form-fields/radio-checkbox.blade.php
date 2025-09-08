<div class="form-group">
    <div class="form-check">
        <input name="{{$inputName}}" class="{{ $inputClass }} @error($inputName) is-invalid @enderror"  {{ $isChecked ?? '' }} type="{{$inputType}}" value="{{$inputValue}}" id="{{ $inputID }}" {{$inputRequired=='true' ? 'required' : ''}} aria-required="{{$inputRequired}}">
        <label for="{{$inputID}}" class="{{$labelClass}} {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    </div>
    @error($inputName)
        <span class="text-danger" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>