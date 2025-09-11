<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="googlebot-news" content="noindex, nofollow">
    <meta name="msnbot" content="noindex, nofollow">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link type="image/x-icon" rel="shortcut icon" href="{{ $cdn_url.'/'.($settings->favicon ?? config('app.default_favicon')) }}">
    <link type="image/x-icon" rel="icon" href="{{ $cdn_url.'/'.($settings->favicon ?? config('app.default_favicon')) }}">

    
    <title>Panelix - Admin Login</title>

    <!-- Google font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"> 

    <!-- Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/font-awesome.css')}}">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/themify-icons.css')}}">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/slick-theme.css')}}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/custom.css')}}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- App css-->

</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="authentication-box">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12 p-0 card-left">
                        @if (session('warning'))
                            <div class="warning-msg">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-exclamation"></i> <strong>{{ session('warning') }}</strong>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7 mx-auto">    
                        <div class="single-item">
                            <div>
                                <div class="d-flex justify-content-center mb-3 mt-3">
                                    @if(!empty($settings->logo))
                                        <img class="img-fluid" src="{{ $cdn_url . '/' . $settings->logo }}" alt="Site Logo" title="Site Logo" width="200">
                                    @else
                                        <img class="img-fluid" src="{{ $cdn_url . '/' . config('app.default_logo') }}" alt="Site Logo" title="Site Logo" width="200">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-7 mx-auto">
                        <div class="card tab2-card card-login">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab"
                                            href="#top-profile" role="tab" aria-controls="top-profile"
                                            aria-selected="true"><span class="icon-user me-2"></span>Login</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel"
                                        aria-labelledby="top-profile-tab">
                                        <form class="form-horizontal auth-form" method="POST" action="{{route('admin.login')}}">
                                            @csrf
                                            <div class="form-group mb-5 mt-5">
                                                <input required="" value="{{ old('email') ?? 'panelix@rootadmin.com' }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email">
                                                @error('email')
                                                    <span class="invalid-feedback ml-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-5">
                                                <input required="" name="password" id="password"  type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" value="adm@Panelix238">
                                                @error('password')
                                                    <span class="invalid-feedback ml-2" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-button">
                                                <button class="btn btn-primary w-100" type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{asset('assets/admin/js/jquery-3.3.1.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('assets/admin/js/bootstrap.bundle.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('assets/admin/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/icons/feather-icon/feather-icon.js')}}"></script>

    <!-- Sidebar jquery-->
    <script src="{{asset('assets/admin/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/admin/js/slick.js')}}"></script>

    <!-- lazyload js-->
    <script src="{{asset('assets/admin/js/lazysizes.min.js')}}"></script>

    <!--script admin-->
    <script src="{{asset('assets/admin/js/admin-script.js')}}"></script>
    <script>
        $('.single-item').slick({
            arrows: false,
            dots: true
        });
    </script>

</body>

</html>
