<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Đăng nhập</title>

    <!-- Favicons -->
    <link href="{{ asset('template/admin/assets/img/logo.svg') }}" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('template/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('template/admin/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('template/admin/assets/img/logo.svg') }}" alt="">
                                    <span class="d-none d-lg-block">WorldSchools.Space</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-2 mb-3">Đăng nhập tài khoản
                                        </h5>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('admin.login') }}">
                                        @csrf
                                    
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                    id="yourUsername" value="{{ old('email') }}" required>
                                    
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                id="yourPassword" value="{{ old('password') }}" required>
                                    
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Nhớ mật khẩu</label>
                                            </div>
                                        </div>
                                    
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                                            <br>
                                            <p class="text-center text-danger">hoặc</p>
                                        </div>
                                    
                                        <div class="text-center d-flex justify-content-center">
                                            <a href="{{ route('auth.google') }}" class="btn btn-danger mx-2" style="width: 80%;">
                                                <i class="bi bi-google fs-3"></i>Google
                                            </a>
                                            <a href="{{ route('auth.facebook') }}" class="btn btn-primary mx-2" style="width: 80%;">
                                                <i class="bi bi-facebook fs-3"></i>Facebook
                                            </a>
                                            <a href="{{ route('auth.twitter') }}" class="btn btn-info mx-2" style="width: 80%;">
                                                <i class="bi bi-twitter-x fs-3"></i><br>Twitter
                                            </a>
                                        </div>
                                    
                                        <div class="col-12">
                                            <p class="small mb-0">Bạn chưa có tài khoản? <a href="{{ route('admin.register') }}">Đăng ký ngay</a></p>
                                        </div>
                                    </form>
                                    

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('template/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('template/admin/assets/js/main.js') }}"></script>

</body>

</html>
