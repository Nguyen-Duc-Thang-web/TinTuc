@extends('admin.layouts.app')

@section('title')
    Sửa Role
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Sửa Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Home</a></li>
                <li class="breadcrumb-item">Role Management</li>
                <li class="breadcrumb-item active">Sửa Role</li>
            </ol>
        </nav>
    </div>

    <section class="section role-edit">
        <div class="row">
            <div class="col">
                <div class="card p-4">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label">Tên Role</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $role->name) }}" placeholder="Nhập tên Role" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Cập nhật Role</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Quay lại</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
