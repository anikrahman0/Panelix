@props([
    'url' => '#', // Default URL value
    'label' => '', // Default label value, it should be provided when calling the component
    'icon' => null, // Optional icon
    'active' => false, // Default value for active
])
<li class="breadcrumb-item {{ $active ? 'active' : '' }}">
    @if (!$active)
        <a href="{{ $url }}">
            @if (isset($icon))
                <i data-feather="{{ $icon }}"></i>
            @endif
            {{ $label }}
        </a>
    @else
        {{ $label }}
    @endif
</li>
