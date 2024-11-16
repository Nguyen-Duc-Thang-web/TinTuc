<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Đăng Ký</title>

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
                                        <h5 class="card-title text-center pb-0 fs-4">Tạo Tài Khoản</h5>
                                    </div>

                                    <form action="{{ route('admin.register') }}" method="POST"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Tên Của Bạn</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Vui lòng nhập tên của bạn!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email Của Bạn</label>
                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                required>
                                            <div class="invalid-feedback">Vui lòng nhập địa chỉ Email hợp lệ!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Mật khẩu</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Vui lòng nhập mật khẩu của bạn!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPasswordConfirmation" class="form-label">Nhập Lại Mật khẩu</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="yourPasswordConfirmation" required>
                                            <div class="invalid-feedback">Vui lòng nhập lại mật khẩu của bạn!</div>
                                        </div>
                                        

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Tạo Tài Khoản</button>
                                            <p class="text-center text-danger m-3">Đăng nhập bằng</p>
                                        </div>
                                        <div class="text-center d-flex justify-content-center">
                                            <a href="{{ route('auth.google') }}" class="btn btn-danger mx-2"
                                                style="width: 80%;">
                                                <i class="bi bi-google fs-3"></i>Google
                                            </a>


                                            <a href="{{ route('auth.facebook') }}" class="btn btn-primary mx-2"
                                                style="width: 80%;">
                                                <i class="bi bi-facebook fs-3"></i>Facebook
                                            </a>

                                            <a href="{{ route('auth.twitter') }}" class="btn btn-info mx-2"
                                                style="width: 80%;">
                                                <i class="bi bi-twitter-x fs-3"></i><br>Twitter
                                            </a>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="small mb-0">Bạn đã có tài khoản? <a
                                                    href="{{ route('admin.login') }}">Đăng nhập</a></p>
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
