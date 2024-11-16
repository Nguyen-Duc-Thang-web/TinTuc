@extends('admin.layouts.app')

@section('title')
    Thêm Role
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Thêm Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Role Management</li>
                <li class="breadcrumb-item active">Thêm Role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section role-create">
        <div class="row">
            <div class="col">
                <div class="card p-4">
                    <!-- Thông báo thành công -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form tạo mới role -->
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <!-- Nhập tên role -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Tên Role</label>
                                <input type="text" name="name" class="form-control" placeholder="Nhập tên Role"
                                    value="{{ old('name') }}" required>

                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Thêm Role</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
