@extends('admin.layouts.app')

@section('title')
    Cập nhật danh mục
@endsection

@section('content')
    @if (session('success') || session('error'))
        <div class="row text-center">
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        </div>
    @endif
    
    <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên danh mục: <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh: <span class="text-danger">*</span></label>
            <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @php
                $url = $category->image;
                if (!\Str::contains($url, 'http')) {
                    $url = Storage::url($url);
                }
            @endphp
            <div><img src="{{ $url }}" alt="" class="img-thumbnail object-fit-cover" width="200px" height="200px"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái: </label>
            <div class="input-group">
                <div class="input-group-text">
                    <input type="checkbox" name="is_active" value="1" class="form-checkbox" @if ($category->is_active) checked @endif>
                </div>
                <input type="text" class="form-control" placeholder="Active" disabled>
            </div>
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-arrow-repeat me-1"></i> Cập nhật </button>
            <button type="reset" class="btn btn-secondary me-2"> <i class="bi bi-arrow-clockwise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Quay lại </a>
        </div>
    </form>
@endsection