@extends('admin.layouts.app')

@section('title')
    Thêm mới câu hỏi
@endsection

@section('content')
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Câu hỏi: <span class="text-danger">*</span></label>
            <input type="text" name="question" value="{{ old('question') }}" class="form-control @error('question') is-invalid @enderror">
            @error('question')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Câu trả lời: <span class="text-danger">*</span></label>
            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" cols="30" rows="10"></textarea>
            @error('answer')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-bookmark me-1"></i> Thêm mới </button>
            <button type="reset" class="btn btn-secondary me-2"> <i class="bi bi-clock-wise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Danh sách </a>
        </div>
    </form>
@endsection