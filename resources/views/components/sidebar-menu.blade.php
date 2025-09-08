<a class="{{$class}}" href="{{ $href }}">
    @if($icon)
        <i data-feather="{{ $icon }}"></i>
    @else
        <i class="fa fa-circle"></i>
    @endif
    <span>{{ $label }} @if(isset($notification)) <span class="badge badge-blue">{{ $notification }}</span> @endif</span>
    @if($showArrow)
        <i class="fa fa-angle-right pull-right"></i>
    @endif
</a>
