<!-- resources/views/components/menu-item.blade.php -->
@props(['icon', 'label', 'href', 'subItems' => [], 'isSuper' => false, 'notification' => null])
<li>
    <x-sidebar-menu class="sidebar-header" :icon="$icon" :label="$label" :href="$href" :showArrow="count($subItems) > 0" :notification="$notification"/>
    @if(count($subItems) > 0 && !$isSuper)
        <ul class="sidebar-submenu">
            @foreach($subItems as $subItem)
                @if(auth()->guard('admin')->user()->hasPermission($subItem['permission']))
                    <li>
                        <x-sidebar-menu class="" icon="" :label="$subItem['label']" :href="$subItem['href']" :showArrow="false" />
                    </li>
                @endif
            @endforeach
        </ul>
    @elseif(count($subItems) > 0 && $isSuper)
    {{-- @dd('here') --}}
        <ul class="sidebar-submenu">
            @foreach($subItems as $subItem)
                <li>
                    <x-sidebar-menu class="" icon="" :label="$subItem['label']" :href="$subItem['href']" :showArrow="false" />
                </li>
            @endforeach
        </ul>
    @endif
</li>