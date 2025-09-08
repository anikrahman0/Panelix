@if($isSuper || auth()->guard('admin')->user()->hasPermission($permission))
    <a href="{{ $url }}">
        <i class="fa fa-edit bg-success p-2 rounded" title="Edit"></i>
    </a>
@endif