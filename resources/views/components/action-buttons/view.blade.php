@if($isSuper || auth()->guard('admin')->user()->hasPermission($permission))
    <a href="{{ $url }}">
        <i class="fa fa-eye bg-success p-2 rounded" title="View"></i>
    </a>
@endif