<div class="form-group">
    <label for="{{$inputName}}" class="form-label {{$inputRequired=='true' ? 'required' : ''}}">{{$labelText}} {!!$inputRequired=='true' ? '<span>*</span>' : ''!!}</label>
    <textarea class="form-control @error($inputName) is-invalid @enderror" placeholder="{{isset($placeHolder) ? $placeHolder : $labelText}}" {{$inputRequired=='true' ? 'required' : ''}} name="{{$inputName}}" id="{{$inputName}}" rows="{{$rows}}" cols="{{$cols}}" aria-required="{{$inputRequired}}">{{$inputValue}}</textarea>
    @error($inputName)
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector("#{{$inputName}}"))
            .catch(error => {
                console.error(error);
        });
    });
</script>
@endpush