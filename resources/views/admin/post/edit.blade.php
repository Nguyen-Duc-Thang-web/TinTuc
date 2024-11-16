@extends('admin.layouts.app')

@section('title')
    Chỉnh sửa bài viết
@endsection

@section('content')
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input for Title -->
        <div class="mb-3">
            <label class="form-label">Tiêu đề: <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Input for Slug -->
        <div class="mb-3">
            <label class="form-label">Slug: <span class="text-danger">*</span></label>
            <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="form-control @error('slug') is-invalid @enderror">
            @error('slug')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Input for Image -->
        <div class="mb-3">
            <label class="form-label">Hình ảnh:</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @if ($post->image)
                <img src="{{ asset($post->image) }}" alt="Current Image" class="mt-2" style="max-width: 100px;">
            @endif
        </div>
        
        <!-- Input for Description -->
        <div class="mb-3">
            <label class="form-label">Description: <span class="text-danger">*</span></label>
            <input type="text" name="description" value="{{ old('description', $post->description) }}" class="form-control @error('description') is-invalid @enderror">
            @error('description')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Textarea for Content -->
        <div class="mb-3">
            <label class="form-label">Nội dung: <span class="text-danger">*</span></label>
            <textarea name="content" rows="5" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Radio buttons for Status (Active/Inactive) -->
        <div class="mb-3">
            <label class="form-label">Trạng thái: <span class="text-danger">*</span></label>
            <div>
                <input type="radio" name="is_active" value="1" {{ old('is_active', $post->is_active) == '1' ? 'checked' : '' }}> Hoạt động
                <input type="radio" name="is_active" value="0" {{ old('is_active', $post->is_active) == '0' ? 'checked' : '' }}> Không hoạt động
            </div>
            @error('is_active')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Input for Category ID (Dropdown) -->
        <div class="mb-3">
            <label class="form-label">Danh mục: <span class="text-danger">*</span></label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Input for Author (User ID) Dropdown -->
        <div class="mb-3">
            <label class="form-label">Tác giả: <span class="text-danger">*</span></label>
            <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">Chọn tác giả</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $post->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <!-- Submit and Reset Buttons -->
        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-pencil me-1"></i> Cập nhật </button>
            <button type="reset" class="btn btn-secondary me-2"> <i class="bi bi-clock-wise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Danh sách </a>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
@endsection

@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.posts.upload', ['_token' => csrf_token()]) }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

@section('styles')
    <style>
        .ck-editor__editable_inline {
            height: 450px;
        }
    </style>
@endsection