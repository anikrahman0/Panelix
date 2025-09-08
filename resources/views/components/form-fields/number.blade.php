<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <input class="form-control @error($inputName) is-invalid @enderror" placeholder="{{isset($placeHolder) ? $placeHolder : $labelText}}" {{$inputRequired=='true' ? 'required' : ''}} name="{{$inputName}}" type="number" min="{{$minimumValue}}" max="{{$maximumValue}}" step="{{$steps}}" value="{{$inputValue}}" id="{{$inputName}}" aria-required="{{$inputRequired}}">
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>