<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel=icon href="{{ asset('template/admin/assets/img/logo.svg') }}" sizes="20x20" type="image/svg">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/responsive.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <!-- search popup start-->
    <div class="td-search-popup" id="td-search-popup">
        <form action="https://solverwp.com/demo/html/nextpage/index.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- search popup end-->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- header start -->
    @include('clients.layouts.header')
    <!-- navbar end -->

    <!-- banner area start -->
    @if (request()->is('/'))
        @include('clients.layouts.banner')
    @endif
    <!-- banner area end -->

    <div style="min-height: 75vh;">
        @yield('content')
    </div>

    @include('clients.layouts.footer')

    <!-- back to top area start -->
    <div class="back-to-top">
        <span class="back-top"><i class="fa fa-angle-up"></i></span>
    </div>
    <!-- back to top area end -->

    <!-- all plugins here -->
    <script src="{{ asset('template/assets/js/vendor.js') }}"></script>
    <!-- main js  -->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


    @yield('scripts')
</body>

</html>
