<header class="header-area">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-flex align-items-center">
                    <a class="" href="{{ route('frontend.index') }}">
                        <div class="logo">
                            @if(!empty($settings->logo))
                                <img class="img-fluid" src="{{ $cdn_url . '/' . $settings->logo }}" alt="Site Logo" title="Site Logo">
                            @else
                                <img class="img-fluid" src="{{ $cdn_url . '/' . config('app.default_logo') }}" alt="Site Logo" title="Site Logo">
                            @endif
                            <p>{{ $settings->site_title ?? config('app.default_title') }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="wrap">
                        <form action="{{ route('frontend.search') }}" method="GET">
                            <div class="search">
                                <input type="text" name="q" class="searchTerm" value="{{ request('q') }}"
                                    placeholder="বই অথবা লেখকের নাম দিয়ে অনুসন্ধান করুন">
                                <button type="submit" class="searchButton"> <i class="fa fa-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-end">
                    <div class="cart-login-wrap">
                        <ul>
                            <li class="shopping-cart">
                                @auth
                                    <a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart"></i></a>
                                    <span class="wishlist_count">{{ $wishlistCount }}</span>
                                @else
                                    <a href="{{ route('user.login') }}"><i class="fa-regular fa-heart"></i></a>
                                @endauth
                            </li>
                            <li class="shopping-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight"><a href="javascript:void(0)"><i
                                        class="fa-solid fa-cart-shopping"></i></a><span class="cart_count">{{ $cartDataCount }}</span></li>
                            <li>
                                @auth
                                    <a class="user-btn" aria-expanded="true" aria-controls="nav-content"> <i class="fa-regular fa-user"></i> </a>
                                    <div class="user-logininfo">
                                        <div class="user-profile" id="user-hide">
                                            <div class="user-name">
                                                <div class="user-login-img">
                                                    @if(auth()->user()->account_type == 1)
                                                        <x-frontend.common.image.user-image 
                                                            class="img-fluid"
                                                            :src="$cdn_url.'/'.auth()->user()->image_path" 
                                                            :alt="auth()->user()->name" 
                                                            :title="auth()->user()->name"
                                                        />
                                                    @else
                                                        <x-frontend.common.image.user-image 
                                                            class="img-fluid"
                                                            :src="auth()->user()->image_path" 
                                                            :alt="auth()->user()->name" 
                                                            :title="auth()->user()->name"
                                                        />
                                                    @endif
                                                </div>
                                                <h5>{{ auth()->user()->name }}</h5>
                                            </div>
                                            <div class="user-iteme-wrapper">
                                                <ul>
                                                    <li><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-house"></i>Dashboard</a></li>
                                                    <li><a href="{{ route('user.orders') }}"><i class="fa-regular fa-file-lines"></i>Your orders</a> </li>
                                                    <li><a href="{{ route('user.profile') }}"><i class="fa-regular fa-user"></i>Your profile</a></li>
                                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 me-2">
                                                            <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                                                            <circle cx="16" cy="12" r="3"></circle>
                                                        </svg>Logout</a>
                                                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="header-meta-wrap">
                                        <a href="{{ route('user.login') }}" class="header-login"> লগইন </a>
                                        <span>/</span>
                                        <a href="{{ route('user.register') }}" class="header-regi"> রেজিস্টার </a>
                                    </div>
                                @endauth
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-wrap">
        <div id="myHeader">
            <div class="DHeaderNav main-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <div class="container-fluid">
                                    <a class="navbar-brand" href="">
                                        <div class="logo">
                                            <img class="img-fluid"
                                                src="{{ asset('assets/frontend/media/common/logo.png') }}"
                                                alt="" title="">
                                        </div>
                                    </a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                                        aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i
                                                class="fa-solid fa-bars"></i></span> </button>
                                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                                        <ul class="navbar-nav">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="{{ route('frontend.index') }}">হোম </a>
                                            </li>
                                            <li class="nav-item dropdown has-megamenu">
                                                <a class="nav-link dropdown-toggle" href="{{ route('frontend.authors') }}"
                                                    >লেখক</a>
                                                <div class="dropdown-menu megamenu" role="menu">
                                                    <div class="row w-100 ">
                                                        <div class="col-md-12">
                                                            <ul class="megamenu-wrapper">
                                                                <x-frontend.common.navbar.author :authors="$authors" class="dropdown-item" />
                                                                <li><a class="dropdown-item color-cng"
                                                                        href="{{ route('frontend.authors') }}"> আরও দেখুন </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown has-megamenu">
                                                <a class="nav-link dropdown-toggle" href="{{ route('frontend.categories') }}">বিষয়</a>
                                                <div class="dropdown-menu megamenu" role="menu">
                                                    <div class="row w-100 ">
                                                        <div class="col-md-12">
                                                            <ul class="megamenu-wrapper">
                                                            <x-frontend.common.navbar.category :categories="$categories" class="dropdown-item" />
                                                            <li><a class="dropdown-item color-cng" href="{{ route('frontend.categories') }}"> আরও দেখুন </a> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item active"> <a class="nav-link"
                                                    href="{{ route('frontend.flash.sale') }}">ফ্লাশ</a> </li>
                                            <li class="nav-item active"> <a class="nav-link"
                                                    href="{{ route('frontend.collection') }}">কালেকশন</a> </li>
                                            {{-- <li class="nav-item active"> <a class="nav-link" href="">অফার </a> --}}
                                            </li>
                                            <li class="nav-item active"> <a class="nav-link" href="https://jhingephul.com/category/boimela-2025">বইমেলা ২০২৫</a></li>
                                            <li class="nav-item active"> <a class="nav-link" href="{{ route('frontend.corporate')}}">প্রাতিষ্ঠানিক অর্ডার </a></li>
                                            <li class="nav-item active"> <a class="nav-link" href="{{ route('frontend.contact') }}">যোগাযোগ </a> </li>
                                            
                                        </ul>
                                        <div class="cart-login-wrap sticky-cart">
                                            <ul>
                                                <li class="shopping-cart">
                                                    @auth
                                                        <a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart"></i></a>
                                                        <span class="wishlist_count">{{ $wishlistCount }}</span>
                                                    @else
                                                        <a href="{{ route('user.login') }}"><i class="fa-regular fa-heart"></i></a>
                                                    @endauth
                                                </li>
                                                <li class="shopping-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><a href="javascript:void(0)"><i class="fa-solid fa-cart-shopping"></i></a><span class="cart_count">{{ $cartDataCount }}</span></li>
                                                <li>
                                                    @auth
                                                        <a class="user-btn" aria-expanded="true" aria-controls="nav-content"> <i class="fa-regular fa-user"></i> </a>
                                                        <div class="user-logininfo">
                                                            <div class="user-profile" id="user-hide">
                                                                <div class="user-name">
                                                                    <div class="user-login-img">
                                                                        @if(auth()->user()->account_type == 1)
                                                                            <x-frontend.common.image.user-image 
                                                                                class="img-fluid"
                                                                                :src="$cdn_url.'/'.auth()->user()->image_path" 
                                                                                :alt="auth()->user()->name" 
                                                                                :title="auth()->user()->name"
                                                                            />
                                                                        @else
                                                                            <x-frontend.common.image.user-image 
                                                                                class="img-fluid"
                                                                                :src="auth()->user()->image_path" 
                                                                                :alt="auth()->user()->name" 
                                                                                :title="auth()->user()->name"
                                                                            />
                                                                        @endif
                                                                    </div>
                                                                    <h5>{{ auth()->user()->name }}</h5>
                                                                </div>
                                                                <div class="user-iteme-wrapper">
                                                                    <ul>
                                                                        <li><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-house"></i>Dashboard</a></li>
                                                                        <li><a href="{{ route('user.orders') }}"><i class="fa-regular fa-file-lines"></i>Your orders</a> </li>
                                                                        <li><a href="{{ route('user.profile') }}"><i class="fa-regular fa-user"></i>Your profile</a></li>
                                                                        <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 me-2">
                                                                                <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                                                                                <circle cx="16" cy="12" r="3"></circle>
                                                                            </svg>Logout</a>
                                                                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                                                                @csrf
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="header-meta-wrap">
                                                            <a href="{{ route('user.login') }}" class="header-login"> লগইন </a>
                                                            <span>/</span>
                                                            <a href="{{ route('user.register') }}" class="header-regi"> রেজিস্টার </a>
                                                        </div>
                                                    @endauth
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myHeader2">
            <div id="mobile-nav" class="MobileMenu MobileShow">
                <div class="row">
                    <div class="col-4 d-flex align-items-center justify-content-start">
                        <div class="mobLogo">
                            <a href="{{ route('frontend.index') }}">
                                @if(!empty($settings->logo))
                                    <img class="img-fluid img100" src="{{ $cdn_url . '/' . $settings->logo }}" alt="Site Logo" title="Site Logo">
                                @else
                                    <img class="img-fluid img100" src="{{ $cdn_url . '/' . config('app.default_logo') }}" alt="Site Logo" title="Site Logo">
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="col-8 d-flex align-items-center justify-content-end">
                        <div class="mb-wish-cart cart-login-wrap">
                            <div class="mb-wish-cart-items">
                                <p>
                                    @auth
                                        <a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart"></i></a>
                                        <span class="wishlist_count">{{ $wishlistCount }}</span>
                                    @else
                                        <a href="{{ route('user.login') }}"><i class="fa-regular fa-heart"></i></a>
                                    @endauth
                                </p>
                                <p class="shopping-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                    <a href="javascript:void(0)">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </a>
                                    <span class="cart_count">{{ $cartDataCount }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="mb-menu-toggle-btn">
                            <span id="menuBTN" class="menu-button fas fa-bars Hide"></span>
                            <span onclick="myMenuBtnChng()" id="menu-button" class="menu-button fas fa-bars"></span>
                        </div>
                    </div>
                </div>
                <ul>
                    <li><a href="{{ route('frontend.index') }}">হোম</a></li>
                    <li class="parent">
                        <a href="{{ route('frontend.authors') }}">লেখক </a>
                        <ul class="SubMenuM">
                            <x-frontend.common.navbar.author :authors="$authors"/>
                        </ul>
                    </li>
                    <li class="parent">
                        <a href="{{ route('frontend.categories') }}">বিষয় </a>
                        <ul class="SubMenuM">
                            <x-frontend.common.navbar.category :categories="$categories" />
                        </ul>
                    </li>
                    <li><a href="{{ route('frontend.flash.sale') }}">ফ্লাশ</a></li>
                    <li><a href="{{ route('frontend.collection') }}">কালেকশন</a></li>
                    {{-- <li><a href="economy-trade">অফার</a></li> --}}
                    <li><a href="https://jhingephul.com/category/boimela-2025">বইমেলা ২০২৫</a></li>
                    <li><a href="{{ route('frontend.corporate') }}">প্রাতিষ্ঠানিক অর্ডার</a></li>
                    <li><a href="{{ route('frontend.contact') }}">যোগাযোগ</a></li>
                    @auth
                        <li><a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-user"></i> ড্যাশবোর্ড</a></li>
                    @else
                        <li><a href="{{ route('user.login') }}"><i class="fa-solid fa-right-to-bracket"></i> লগইন</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="wrap">
                <form action="{{ route('frontend.search') }}" method="GET">
                    <div class="search">
                        <input type="text" name="q" class="searchTerm" value="{{ request('q') }}" placeholder="বই অথবা লেখকের নাম দিয়ে অনুসন্ধান করুন">
                        <button type="submit" class="searchButton"> <i class="fa fa-search"></i> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="mini-cart-area">
        @include('layouts.frontend.partials.mini-cart')
    </div>
</header>
