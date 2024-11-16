@extends('admin.layouts.app')

@section('title')
    Sửa tài khoản
@endsection

@section('content')
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method PUT cho update -->

        <div class="mb-3">
            <label class="form-label">Name: <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email: <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror">
            @error('email')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Avatar: <span class="text-danger">*</span></label>
            <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror">
            @error('avatar')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            <div class="mt-2">
                @if($user->avatar)
                    <img src="{{ asset($user->avatar) }}" alt="Avatar" width="100">
                @else
                    <p class="text-muted">No avatar uploaded.</p>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Status: <span class="text-danger">*</span></label>
            <div>
                <input type="radio" name="is_active" value="1" {{ old('is_active', $user->is_active) == '1' ? 'checked' : '' }}> Active
                <input type="radio" name="is_active" value="0" {{ old('is_active', $user->is_active) == '0' ? 'checked' : '' }}> Inactive
            </div>
            @error('is_active')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Trở về</a>
        </div>
    </form>
@endsection
