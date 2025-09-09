
<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
{{-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"> --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Panelix @unless (Request::routeIs('frontend.index')) - @yield('title') @endunless</title>

@stack('meta')

<link type="image/x-icon" rel="shortcut icon" href="{{ $cdn_url.'/'.$settings->favicon ?? config('app.default_favicon') }}">
<link type="image/x-icon" rel="icon" href="{{ $cdn_url.'/'.$settings->favicon ?? config('app.default_favicon') }}">

@include('layouts.frontend.partials.css.styles')

@stack('css')

</head>


<body>
    <div id="success-msg"></div>
    {{-- @include('layouts.frontend.partials.navbar') --}}
    <!-- Back to top button -->
    {{-- <a id="button"><i class="fa-solid fa-arrow-turn-up"></i></a> --}}

    <main>
        @yield('content')
    </main>

    {{-- @include('layouts.frontend.partials.footer') --}}

    @include('layouts.frontend.partials.js.scripts')
    
    @stack('js')
</body>

</body>

</html>
