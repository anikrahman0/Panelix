@if($isSuper || auth()->guard('admin')->user()->hasPermission($permission))
    <a href="{{ $url }}" onclick="return confirm('{{ $confirmationMessage }}');">
        <i class="fa fa-trash bg-primary p-2 rounded" title="Delete"></i>
    </a>
@endif