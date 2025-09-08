@props(['field'=>$field])
@if ($errors->has($field))
    @foreach ($errors->get($field) as $error)
        <span class="text-danger" role="alert">
            <strong>{{ $error }}</strong>
        </span>
    @endforeach
@endif