<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.admin.partials.meta')
    @if(request()->routeIs('admin.dashboard'))
        <title>{{ $settings->site_title ?? config('app.name') }} - Admin</title>
    @else
        <title>{{ $settings->site_title ?? config('app.name') }} - @yield('title')</title>
    @endif
    @include('layouts.admin.partials.styles')
    @stack('css')
</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div id="success-message"></div>
        <!-- Page Header Start-->
        @include('layouts.admin.partials.navbar')
        <!-- Page Header Ends -->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('layouts.admin.partials.sidebar')
            <!-- Page Sidebar Ends-->

            <div class="page-body">
                <!-- Container-fluid starts-->
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>

            <!-- footer start-->
            @include('layouts.admin.partials.footer')
            <!-- footer end-->
        </div>
    </div>

    @include('layouts.admin.partials.scripts')
    @stack('script')
</body>

</html>