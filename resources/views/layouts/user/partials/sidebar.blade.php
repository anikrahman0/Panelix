<div class="sidebar-wrap">
    <div class="sdbar-profile-ph">
        <img class="img-fluid" src="media/imgAll/bg/profile-photo.png" alt="" title="">
        <h5>{{ auth()->user()->name }}</h5>
    </div>
    <ul class="sidebar">
        <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <a href="{{ route('user.dashboard') }}"><i class="fa-solid fa-layer-group me-3"></i> Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('user.orders') ? 'active' : '' }}">
            <a href="{{ route('user.orders') }}"><i class="fa-solid fa-cart-arrow-down me-3"></i> My Order</a>
        </li>
        <li class="{{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
            <a href="{{ route('user.wishlist') }}"><i class="fa-regular fa-heart me-3"></i> Wishlist</a>
        </li>
        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <a href="{{ route('user.profile') }}"><i class="fa-regular fa-user me-3"></i> Profile</a>
        </li>
        <li class="{{ request()->routeIs('user.change.password') ? 'active' : '' }}">
            <a href="{{ route('user.change.password') }}"><i class="fa-solid fa-lock me-3"></i> Password</a>
        </li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket me-3"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

</div>