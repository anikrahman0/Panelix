<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <textarea class="form-control @error($inputName) is-invalid @enderror" placeholder="{{isset($placeHolder) ? $placeHolder : $labelText}}" {{$inputRequired=='true' ? 'required' : ''}} name="{{$inputName}}" id="{{$inputName}}" rows="{{$rows}}" cols="{{$cols}}" maxlength="{{$maxlength ?? ''}}" aria-required="{{$inputRequired}}">{{$inputValue}}</textarea>
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>