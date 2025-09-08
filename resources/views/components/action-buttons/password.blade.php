@if($isSuper || auth()->guard('admin')->user()->hasPermission($permission))
    <a href="{{ $url }}">
        <i class="fa-solid fa-key bg-warning p-2 rounded" title="Change Password"></i>
    </a>
@endif