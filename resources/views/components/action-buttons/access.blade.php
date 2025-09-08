@if($isSuper || auth()->guard('admin')->user()->hasPermission($permission))
    <a href="{{ $url }}">
        <i class="fa-solid fa-lock-open bg-info p-2 rounded" title="Access"></i>
    </a>
@endif