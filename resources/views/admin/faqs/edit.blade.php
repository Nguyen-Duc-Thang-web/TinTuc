@extends('admin.layouts.app')

@section('title')
    Cập nhật câu hỏi 
@endsection

@section('content')
    @if (session('success') || session('error'))
        <div class="row text-center">
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        </div>
    @endif
    
    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Câu hỏi: <span class="text-danger">*</span></label>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="form-control @error('question') is-invalid @enderror">
            @error('question')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Câu trả lời: <span class="text-danger">*</span></label>
            <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" cols="30" rows="10">{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-arrow-repeat me-1"></i> Cập nhật </button>
            <button type="reset" class="btn btn-secondary me-2"> <i class="bi bi-arrow-clockwise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Quay lại </a>
        </div>
    </form>
@endsection