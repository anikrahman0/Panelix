<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                @if(!empty($settings->logo))
                    <img class="d-none d-lg-block blur-up lazyloaded img-fluid" src="{{ $cdn_url . '/' . $settings->logo }}" width="50" alt="logo">
                @else
                    <img class="d-none d-lg-block blur-up lazyloaded img-fluid" src="{{ asset('assets/admin/common/logo-light.png') }}" width="50" alt="logo">
                @endif
                @if(!empty($settings->site_title))
                    <h3 class="text-light mb-0">{{ $settings->site_title }}</h3>
                @else
                    <h3 class="text-light mb-0">{{config('app.name')}}</h3>
                @endif
            </a>
        </div>

    </div>
    <div class="sidebar custom-scrollbar">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times" aria-hidden="true"></i></a>
        <ul class="sidebar-menu">
            <x-menu-item 
                icon="home" 
                label="Dashboard" 
                href="{{ route('admin.dashboard') }}" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
            />

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('country') ||  auth()->guard('admin')->user()->hasPermission('state') || auth()->guard('admin')->user()->hasPermission('city'))
            <x-menu-item 
                icon="map-pin" 
                label="Location" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'Country', 'href' => route('admin.countries.index'), 'permission' => 'country'],
                    ['label' => 'State', 'href' => route('admin.states.index'), 'permission' => 'state'],
                    ['label' => 'City', 'href' => route('admin.cities.index'), 'permission' => 'city']
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif

            {{-- <x-menu-item 
                icon="key" 
                label="Permissions" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'List', 'href' => route('admin.permissions.index')],
                    ['label' => 'Create', 'href' => route('admin.permissions.add')],
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1" 
            /> --}}
            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('users') || auth()->guard('admin')->user()->hasPermission('roles')) 
            <x-menu-item 
                icon="user-plus" 
                label="Administrator" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'Roles', 'href' => route('admin.roles.index'), 'permission' => 'roles'],
                    ['label' => 'Users', 'href' => route('admin.users.index-user'), 'permission' => 'users'],
                    ['label' => 'Admin Users', 'href' => route('admin.users.index-admin'), 'permission' => 'users'],
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif
            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('general-setting'))
            <x-menu-item 
                icon="tool" 
                label="General Settings" 
                href="{{ route('admin.general-setting.edit') }}"
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif
        </ul>
    </div>
</div>