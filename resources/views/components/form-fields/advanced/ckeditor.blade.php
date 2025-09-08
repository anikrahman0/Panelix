@php
    $inputID = str_replace('.', '_', $inputValidationID);
    $imageUploadPath = $imageUploadPath ?? 'media/uploads/ckeditor_images';
    $uploadUrl = route('ckeditor.upload', ['_token' => csrf_token(), 'uploadDirectory' => $imageUploadPath]);
    // echo $uploadUrl;
@endphp
<div class="form-group">
    {{ $slot }}
    <textarea {{ $attributes->whereStartsWith('data') }}
        class="{{$inputClass}} @error($inputValidationID) is-invalid @enderror"
        placeholder="{{$labelText}}"
        {{$inputRequired}}
        name="{{$inputName}}"
        id="{{$inputID}}"
        maxlength="{{$maxlength}}">{!!$inputValue!!}</textarea>
    @error($inputValidationID)
    <span class="text-danger error-text-area" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

@push('script')
<script>
    $(document).ready(function() {
        let uploadUrl = "{{$uploadUrl}}";
        uploadUrl = uploadUrl.replace(/&amp;/g, "&");
        console.log(uploadUrl);
        
        if(!"{{$inputID}}".includes("$")){
            ClassicEditor
                .create(document.querySelector("#{{$inputID}}"), {
                    ckfinder:{
                        uploadUrl: uploadUrl
                    },
                })
                .catch(error => {
                    console.error(error);
            });
        }
    });
</script>
@endpush