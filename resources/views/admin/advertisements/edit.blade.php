@extends('admin.layouts.app')

@section('title')
    Cập nhật quảng cáo
@endsection

@section('content')
    @if (session('success') || session('error'))
        <div class="row text-center">
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        </div>
    @endif

    <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Ảnh: <span class="text-danger">*</span></label>
            <input type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @php
                $url = $advertisement->image;
                if (!\Str::contains($url, 'http')) {
                    $url = Storage::url($url);
                }
            @endphp
            <div>
                <img src="{{ $url }}" alt="" class="img-thumbnail object-fit-cover" width="200px"
                    height="200px">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nội dung: </label>
            <textarea name="content" cols="30" rows="2" class="form-control @error('content') is-invalid @enderror">{{ old('content', $advertisement->content) }}</textarea>
            @error('content')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Link quảng cáo: </label>
            <input type="url" name="link" value="{{ old('link', $advertisement->link) }}" class="form-control @error('link') is-invalid @enderror">
            @error('link')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày bắt đầu: <span class="text-danger">*</span></label>
            <input type="datetime-local" name="start_date" value="{{ old('start_date', $advertisement->start_date) }}" class="form-control @error('start_date') is-invalid @enderror">
            @error('start_date')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày kết thúc: <span class="text-danger">*</span></label>
            <input type="datetime-local" name="end_date" value="{{ old('end_date', $advertisement->end_date) }}" class="form-control @error('end_date') is-invalid @enderror">
            @error('end_date')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trang: <span class="text-danger">*</span></label>
            <select name="pages" class="form-select @error('pages') is-invalid @enderror">
                <option value="">Chọn trang hiển thị</option>
                <option value="home"        @if (old('pages', $advertisement->pages) == 'home') selected @endif>Trang chủ</option>
                <option value="post_detail" @if (old('pages', $advertisement->pages) == 'post_detail') selected @endif>Chi tiết bài viết</option>
            </select>
            @error('category_or_page_required')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @error('both_value')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @error('pages')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Danh mục: <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">Chọn trang danh mục hiển thị</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('category_id', $advertisement->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_or_page_required')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
            @error('category_id')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Vị trí: <span class="text-danger">*</span></label>
            <select name="position" class="form-select @error('position') is-invalid @enderror">
                <option value="">Chọn vị trí hiển thị</option>
                <option value="header"  @if (old('position', $advertisement->position) == 'header') selected @endif>Header</option>
                <option value="sidebar" @if (old('position', $advertisement->position) == 'sidebar') selected @endif>Sidebar</option>
                <option value="middle"  @if (old('position', $advertisement->position) == 'middle') selected @endif>Middle</option>
                <option value="bottom"  @if (old('position', $advertisement->position) == 'bottom') selected @endif>Bottom</option>
            </select>
            @error('position')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái: </label>
            <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="">Chọn trạng thái</option>
                <option value="draft"      @if (old('draft', $advertisement->status)     == 'draft') selected @endif>Bản nháp</option>
                <option value="active"     @if (old('active', $advertisement->status)    == 'active') selected @endif>Chạy quảng cáo</option>
                <option value="paused"     @if (old('paused', $advertisement->status)    == 'paused') selected @endif>Dừng quảng cáo</option>
                <option value="completed"  @if (old('completed', $advertisement->status) == 'completed') selected @endif>Đã hoàn thành</option>
            </select>
            @error('status')
                <small class="text-danger fst-italic">* {{ $message }}</small>
            @enderror
        </div>

        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
        <input type="hidden" name="user_id" value="1">

        <div class="mb-3">
            <button class="btn btn-primary me-2"> <i class="bi bi-arrow-repeat me-1"></i> Cập nhật </button>
            <button type="reset" class="btn btn-secondary me-2">  <i class="bi bi-arrow-clockwise me-1"></i> Nhập lại </button>
            <a href="{{ route('admin.advertisements.index') }}" class="btn btn-info"> <i class="bi bi-arrow-left me-1"></i> Quay lại </a>
        </div>
    </form>
@endsection