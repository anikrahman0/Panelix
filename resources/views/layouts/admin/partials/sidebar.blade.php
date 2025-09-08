<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                <img class="d-none d-lg-block blur-up lazyloaded img-fluid"
                    src="{{ asset('assets/admin/common/logo.png') }}" width="50" alt="logo">
                <h3 class="text-light mb-0">ঝিঙেফুল</h3>
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

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('authors')) 
            <x-menu-item 
                icon="user" 
                label="Authors" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'List', 'href' => route('admin.author.index'), 'permission' => 'authors'],
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('publishers')) 
            <x-menu-item 
                icon="users" 
                label="Publishers" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'List', 'href' => route('admin.publisher.index'), 'permission' => 'publishers'],
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif

            {{-- @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('sliders') || auth()->guard('admin')->user()->hasPermission('coupon') || auth()->guard('admin')->user()->hasPermission('flash-sale')) --}}
            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('sliders') || auth()->guard('admin')->user()->hasPermission('flash-sale') || auth()->guard('admin')->user()->hasPermission('coupon'))
                <x-menu-item 
                    icon="award" 
                    label="Marketing" 
                    href="javascript:void(0)" 
                    :subItems="[
                        ['label' => 'Sliders', 'href' => route('admin.sliders.index'), 'permission' => 'sliders'],
                        ['label' => 'Flash Sale', 'href' => route('admin.flash-sale.index'), 'permission' => 'flash-sale'],
                        ['label' => 'Coupons', 'href' => route('admin.coupon.index'), 'permission' => 'coupon'],
                        ['label' => 'Book Bundles', 'href' => route('admin.book.bundles.index'), 'permission' => 'sliders'],
                    ]" 
                    :isSuper="auth()->guard('admin')->user()->is_super == 1"
                />
            @endif

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('social-platform')) 
            <x-menu-item 
                icon="facebook" 
                label="Social Media" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'Social Icons', 'href' => route('admin.social-icon.index'), 'permission' => 'social-platform'],
                    {{-- ['label' => 'Blogs', 'href' => route('admin.blogs.index'), 'permission' => 'blogs'],
                    ['label' => 'Pages', 'href' => route('admin.pages.index'), 'permission' => 'pages'], --}}
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('book') || auth()->guard('admin')->user()->hasPermission('category') || auth()->guard('admin')->user()->hasPermission('book-tag') || auth()->guard('admin')->user()->hasPermission('book-rating-review')) 
                <x-menu-item 
                    icon="box" 
                    label="Book Listing" 
                    href="javascript:void(0)" 
                    :subItems="[
                        ['label' => 'Parent Categories', 'href' => route('admin.categories.index'), 'permission' => 'category'],
                        ['label' => 'Sub Categories', 'href' => route('admin.subcategories.index'), 'permission' => 'category'],
                        ['label' => 'Books', 'href' => route('admin.books.index'), 'permission' => 'book'],
                        ['label' => 'Tags', 'href' => route('admin.tag.index'), 'permission' => 'book-tag'],
                        ['label' => 'Book Reviews', 'href' => route('admin.review.index'), 'permission' => 'book-rating-review']

                    ]" 
                    :isSuper="auth()->guard('admin')->user()->is_super == 1"
                />
            @endif

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('order') || auth()->guard('admin')->user()->hasPermission('view-order') || auth()->guard('admin')->user()->hasPermission('view-orders')) 
            <x-menu-item 
                :notification="pendingOrderCount()"
                icon="archive" 
                label="Orders" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'All Orders', 'href' => route('admin.orders.index'), 'permission' => 'order'],
                ]" 
                :isSuper="auth()->guard('admin')->user()->is_super == 1"
            />
            @endif

            @if(auth()->guard('admin')->user()->is_super == 1 || auth()->guard('admin')->user()->hasPermission('payment')) 
            <x-menu-item 
                icon="credit-card" 
                label="Payments" 
                href="javascript:void(0)" 
                :subItems="[
                    ['label' => 'Payment Methods', 'href' => route('admin.payments.index'), 'permission' => 'payment'],
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