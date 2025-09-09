<div class="page-main-header">
    <div class="main-header-right row">
        <div class="main-header-left d-lg-none w-auto">
            <div class="logo-wrapper">
                <a href="{{ route('admin.dashboard') }}">
                    <img class="blur-up lazyloaded d-block d-lg-none"
                        src="{{ asset('assets/admin/common/logo-light.png') }}" alt="">
                </a>
            </div>
        </div>
        <div class="mobile-sidebar w-auto">
            <div class="media-body text-end switch-sm">
                <label class="switch">
                    <a href="javascript:void(0)">
                        <i id="sidebar-toggle" data-feather="align-left"></i>
                    </a>
                </label>
            </div>
        </div>
        <div class="nav-right col">
            <ul class="nav-menus">
                <li>
                    <a href="{{ route('clear-cache') }}" title="Clear Cache">
                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-bolt"></i>  Clear Cache </button>                        
                    </a>
                </li>
                <li>
                    <a href="{{ route('frontend.index') }}" target="_blank" title="Go To Website">
                        <button class="btn btn-sm btn-primary"><i class="fa-solid fa-globe"></i>  Go To Website </button>                        
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    <span class="badge badge-pill badge-notify pull-right notification-badge">0</span>
                    <span class="dot"></span>
                    <ul class="notification-dropdown onhover-show-div p-0">
                        <li>Notification <span class="badge badge-pill badge-primary pull-right">0</span></li>

                        <li class="txt-dark"><a href="javascript:void(0)">No Notification</li>
                        
                    </ul>
                </li>
                <li>
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize-2"></i>
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <div class="media align-items-center">
                        @if(auth()->guard('admin')->user() && auth()->guard('admin')->user()->image_path)
                            <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                src="{{ asset($cdn_url.'/'.auth()->guard('admin')->user()->image_path) }}" alt="header-user">
                        @else
                            <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                                src="{{ asset('assets/admin/common/default-avatar.jpg') }}" alt="header-user">
                        @endif
                    </div>
                    <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                        <li>
                            <a href="{{ route('admin.users.edit.admin-profile', auth()->guard('admin')->user()->id) }}">
                                <i data-feather="user"></i>Edit Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.general-setting.edit') }}">
                                <i data-feather="settings"></i>Settings
                            </a>
                        </li>
                        <li>
                            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="javascript:void(0)">
                                <i data-feather="log-out"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right">
                <i data-feather="more-horizontal"></i>
            </div>
        </div>
    </div>
</div>