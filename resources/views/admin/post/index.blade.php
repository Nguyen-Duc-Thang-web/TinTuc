@extends('admin.layouts.app')

@section('title')
    Quản lý bài viết
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách bài viết</h5>
        </small>

        @if (session('success') || session('error'))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        @endif

        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tiêu đề</th>
                    <th class="align-middle">Tác giả</th>
                    <th class="align-middle">Slug</th>
                    <th class="align-middle">View</th>
                    <th class="align-middle">Mô tả</th>
                    <th class="align-middle">Nội dung</th>
                    <th class="align-middle">Hình ảnh</th>
                    <th class="align-middle">Danh mục</th>
                    <th class="align-middle">Trạng thái</th>
                    <th class="align-middle">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if($posts && $posts->count() > 0)
                    @foreach ($posts as $post)

                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name ?? 'Không xác định' }}</td> <!-- Hiển thị tên tác giả -->
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->view }}</td>
                            <td>{{ $post->description }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($post->content, 100, '...') }}</td>
                            <td>
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" alt="Image" width="50" height="50">
                            </td>
                            <td>{{ $post->category->name ?? 'Không có' }}</td>
                            <td>{{ $post->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2 d-flex">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa bài viết này không?')">
                                            <i class="bi bi-trash me-2"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-danger fst-italic fw-bold">Chưa có bài viết nào được tạo!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
