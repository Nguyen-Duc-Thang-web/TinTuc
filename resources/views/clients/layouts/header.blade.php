<div class="navbar-area">
    <div class="adbar-area bg-black d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-5 align-self-center">
                    <div class="logo text-md-left text-center">
                        <a class="main-logo" href="{{ route('home') }}">
                            <img src="{{ asset('template/admin/assets/img/logo.svg') }}" alt="img">
                            <span class="text-white align-middle px-2">WorldSchools.Space</span>
                        </a>
                    </div>
                </div>
                @isset($advertisement)
                    <div class="col-xl-6 col-lg-7 text-md-right text-center">
                        @foreach ($advertisement as $ads)
                            @if ($ads->position == 'header' && $ads->pages == 'home')
                                @php
                                    $image = $ads->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <a href="{{ $ads->link }}" class="adbar-right">
                                    <img src="{{ $image }}" alt="img" width="555" height="65"
                                        class="object-fit-cover">
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </div>
    <!-- adbar end-->

    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo d-lg-none d-block">
                    <a class="main-logo" href="{{ route('home') }}"><img
                            src="{{ asset('template/admin/assets/img/logo.svg') }}" alt="img"></a>
                </div>
                <button class="menu toggle-btn d-block d-lg-none" data-target="#nextpage_main_menu"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <a class="search header-search" href="#"><i class="fa fa-search"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="nextpage_main_menu">
                <ul class="navbar-nav menu-open">
                    <!-- Link đến Trang Chủ -->
                    <li class="current-menu-item">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    @foreach ($categories as $category)
                        @if ($category->posts->count() > 0)
                            <li class="current-menu-item">
                                <a href="{{ route('category.posts', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- <div class="nav-right-part nav-right-part-desktop d-flex align-items-center">
                <form action="{{ route('search') }}" method="GET">
                    <div class="menu-search-inner me-2 d-flex">
                        <input type="text" name="search" placeholder="Tìm kiếm">
                        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <div class="auth-buttons d-flex align-items-center">
                    @if (Auth::check())
                    <div class="notification-icon">
                        <button class="btn btn-link" id="notification-btn" data-toggle="dropdown">
                            <i class="bi bi-megaphone" style="font-size: 30px; color: #000000;"></i>
                            <span class="badge badge-danger" id="notification-count">0</span>
                        </button>
                        <div class="dropdown-menu" id="notification-list">
                    
                            <!-- Các thông báo mới sẽ được hiển thị ở đây -->
                            <a class="dropdown-item" href="#">Không có thông báo mới</a>
                        </div>
                    </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center mr-5 ml-5"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- SVG icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">

                                <li>
                                    <a class="dropdown-item" href="{{ route('home/profile') }}">Quản lý hồ sơ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="auth-buttons d-flex align-items-center ms-1">
                            <a href="{{ route('admin.login') }}" class="btn btn-primary me-1">Đăng nhập</a>
                            <a href="{{ route('admin.register') }}" class="btn btn-primary">Đăng ký</a>
                        </div>
                    @endif
                </div>
            </div> --}}
            <div class="nav-right-part nav-right-part-desktop d-flex align-items-center">
                <div class="menu-search-inner me-2 d-flex mr-5">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="search" placeholder="Tìm kiếm">
                        <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
                    </form>
                </div>
{{-- aa --}}

                <div class="auth-buttons d-flex align-items-center">
                    @if (Auth::check())
                        <div class="notification-icon">
                            <button class="btn btn-link" id="notification-btn" data-toggle="dropdown">
                                <i class="bi bi-megaphone" style="font-size: 30px; color: #000000;"></i>
                                <span class="badge badge-danger" id="notification-count">0</span>
                            </button>
                            <div class="dropdown-menu" id="notification-list">

                                <!-- Các thông báo mới sẽ được hiển thị ở đây -->
                                <a class="dropdown-item" href="#">Không có thông báo mới</a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center mr-5 ml-5"
                                type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- SVG icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                                    fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                    <path
                                        d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="{{ route('home/profile') }}">Quản lý hồ sơ</a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="auth-buttons d-flex align-items-center ms-1">
                            <a href="{{ route('admin.login') }}" class="btn btn-primary me-1">Đăng nhập</a>
                            <a href="{{ route('admin.register') }}" class="btn btn-primary">Đăng ký</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>


</div>
