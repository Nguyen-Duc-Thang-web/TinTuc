@extends('clients.layouts.app')

@section('title')
    Hồ Sơ
@endsection

@section('content')
    @if (Auth::check())
        <div class="pagetitle container">
            <h1>Hồ Sơ</h1>
        </div>
        {{-- @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif --}}

        <section class="section profile container">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            
                            <img src="@if ($user->avatar == null) {{ asset('template/assets/img/author/user.png') }} @else {{ $user->avatar }} @endif" alt="Hồ Sơ" width="200" height="200"
                                class="rounded-circle">
                            <h2>{{ $user->name }}</h2>
                            <h3>{{ !Auth::user()->admin() ? 'Độc giả' : 'Quản trị viên' }}</h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>@endif
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tổng
                                        Quan</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Chỉnh Sửa Hồ
                                        Sơ</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Đổi
                                        Mật Khẩu</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Giới Thiệu</h5>
                                    <p class="fs-5 fst-italic">Trang web không thu yêu cầu người dùng mô tả về bản thân, thông tin cá nhân được bảo mật tuyệt đối</p>


                                    <h5 class="card-title">Chi Tiết Hồ Sơ</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Họ Tên</div>
                                        <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Quốc Gia</div>
                                        <div class="col-lg-9 col-md-8">Việt Nam</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh Hồ Sơ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="@if ($user->avatar == null) {{ asset('template/assets/img/author/user.png') }} @else {{ $user->avatar }} @endif" width="100" alt="Hồ Sơ">
                                                <div class="pt-2">
                                                    <input type="file" name="avatar" class="form-control" id="avatar">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ Tên</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                    
                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                                        </div>
                                    </form>
                                    
                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <h5 class="card-title">Đổi Mật Khẩu</h5>

                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật Khẩu Hiện Tại</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="currentPassword" type="password" class="form-control" id="currentPassword" value="{{ old('currentPassword') }}" required>
                                                <!-- Hiển thị lỗi nếu có -->
                                                @if ($errors->has('currentPassword'))
                                                    <span class="text-danger">{{ $errors->first('currentPassword') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật Khẩu Mới</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newPassword" type="password" class="form-control" id="newPassword" value="{{ old('newPassword') }}" required>
                                                <!-- Hiển thị lỗi nếu có -->
                                                @if ($errors->has('newPassword'))
                                                    <span class="text-danger">{{ $errors->first('newPassword') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <label for="newPassword_confirmation" class="col-md-4 col-lg-3 col-form-label">Xác Nhận Mật Khẩu</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newPassword_confirmation" type="password" class="form-control" id="confirmPassword" value="{{ old('newPassword_confirmation') }}" required>
                                                <!-- Hiển thị lỗi nếu có -->
                                                @if ($errors->has('newPassword_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('newPassword_confirmation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Đổi Mật Khẩu</button>
                                        </div>
                                    </form>
                                    
                                    
                                    
                                </div>

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @else
        <div class="container mt-5">
            <div class="alert alert-danger text-center">
                Bạn cần đăng nhập để xem hồ sơ
            </div>
        </div>
    @endif
@endsection
