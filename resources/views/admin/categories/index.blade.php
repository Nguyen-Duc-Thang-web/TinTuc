@extends('admin.layouts.app')

@section('title')
    Quản lý danh mục
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách danh mục</h5>
        </small>

        @if (session('success') || session('error') || isset($error))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') ?? $error }}
            </small>
        @endif

        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tên</th>
                    <th class="align-middle">Ảnh</th>
                    <th class="align-middle">SLUG</th>
                    <th class="align-middle">Trạng thái</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if($categories && $categories->count() > 0)
                    @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                @php
                                    $image = $category->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <div style="height: 200px; overflow: hidden;">
                                    <img src="{{ $image }}" alt="" class="img-thumbnail" style="object-fit: cover; width: 200px; height: 200px;">
                                </div>
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                {!! $category->is_active ? '<span class="badge bg-success">Hiển thị</span>' : '<span class="badge bg-danger">Không</span>' !!}
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center align-middle">
                                    <a href="{{ route('admin.categories.edit', $category->slug) }}" class="btn btn-sm btn-warning me-2 d-flex"><i class="bi bi-pencil-square me-2"></i>Sửa</a>
                                    <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa danh mục này không?')"><i class="bi bi-trash me-2"></i>Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                @else
                    <tr>
                        <td colspan="6" class="text-danger fst-italic fw-bold">Chưa có danh mục nào được tạo!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        @isset($categories)
            {{ $categories->links() }}
        @endisset
    </div>
@endsection