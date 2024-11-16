@extends('admin.layouts.app')

@section('title')
    Thêm mới người dùng
@endsection

@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name: <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email: <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password: <span class="text-danger">*</span></label>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Avatar: </label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>
   
        <div class="mb-3">
            <label class="form-label">Status: <span class="text-danger">*</span></label>
            <div>
                <input type="radio" class="form-check-input" name="is_active" value="1" {{ old('is_active') == '1' ? 'checked' : '' }}> Active
                <input type="radio" class="form-check-input" name="is_active" value="0" {{ old('is_active') == '0' ? 'checked' : '' }}> Inactive
            </div>
            @error('is_active')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-bookmark me-1"></i> Thêm mới </button>
            <button type="reset" class="btn btn-secondary me-2"> <i class="bi bi-clock-wise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Danh sách </a>
        </div>
    </form>
@endsection
