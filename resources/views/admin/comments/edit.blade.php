@extends('admin.layouts.app')

@section('title')
    Cập nhật Trạng thái Bình luận
@endsection

@section('content')
    @if (session('success') || session('error'))
        <div class="row text-center">
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        </div>
    @endif

    <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Display non-editable fields -->
        <div class="mb-3">
            <label class="form-label">ID: </label>
            <input type="text" class="form-control" value="{{ $comment->id }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">User name: </label>
            <input type="text" class="form-control" value="{{ $comment->user->name }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Post name: </label>
            <input type="text" class="form-control" value="{{ $comment->post->title }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung: </label>
            <textarea class="form-control" rows="3" disabled>{{ $comment->content }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày tạo: </label>
            <input type="text" class="form-control" value="{{ $comment->created_at }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày cập nhật: </label>
            <input type="text" class="form-control" value="{{ $comment->updated_at }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Phê duyệt: </label>
            <select name="is_approve" class="form-select">
                <option value="0" @if (!$comment->is_approve) selected @endif>Chưa phê duyệt</option>
                <option value="1" @if ($comment->is_approve) selected @endif>Đã phê duyệt</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ẩn bình luận: </label>
            <select name="is_hidden" class="form-select">
                <option value="0" @if (!$comment->is_hidden) selected @endif>Hiện</option>
                <option value="1" @if ($comment->is_hidden) selected @endif>Ẩn</option>
            </select>
        </div>


        <!-- Action buttons -->
        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-arrow-repeat me-1"></i> Cập nhật </button>
            <a href="{{ route('admin.comments.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Quay lại </a>
        </div>
    </form>
@endsection
