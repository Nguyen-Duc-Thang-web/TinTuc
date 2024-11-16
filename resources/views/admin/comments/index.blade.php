@extends('admin.layouts.app')

@section('title')
    Quản lý bình luận
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách bình luận</h5>
        </small>

        @if (session('success') || session('error'))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error') }}
            </small>
        @endif

        <div class="d-block"></div>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">User</th>
                    <th class="align-middle">Post</th>
                    <th class="align-middle">Content</th>
                    <th class="align-middle">Edited</th>
                    <th class="align-middle">Approved</th>
                    <th class="align-middle">Hidden</th>
                    <th class="align-middle">Deleted At</th>
                    <th class="align-middle">Created At</th>
                    <th class="align-middle">Updated At</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if($comments && $comments->count() > 0)
                    @foreach ($comments as $comment)
                        <tr>
                            <th scope="row">{{ $comment->id }}</th>
                            <td>{{ $comment->user_name }}</td>
                            <td>{{ $comment->post_title }}</td>
                            <td>{{ $comment->content }}</td>
                            <td>{{ $comment->edited }}</td>
                            <td>{!! $comment->is_approve ? '<span class="badge bg-success">Đã chấp nhận</span>' : '<span class="badge bg-danger">Chưa chấp nhận</span>' !!}</td>
                            <td>{!! $comment->is_hidden ? '<span class="badge bg-danger">Ẩn</span>' : '<span class="badge bg-success">Hiện</span>' !!}</td>
                            <td>{{ $comment->deleted_at ?? 'N/A' }}</td>
                            <td>{{ $comment->created_at ?? 'N/A'}}</td>
                            <td>{{ $comment->updated_at }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center align-middle">
                                    <a href="{{ route('admin.comments.edit',  $comment->id) }}" class="btn btn-sm btn-warning me-2 d-flex"><i class="bi bi-pencil-square me-2"></i>sửa</a>

                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa bình luận này không?')">
                                            <i class="bi bi-trash me-2"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11" class="text-danger fst-italic fw-bold">Chưa có bình luận nào!</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
@endsection
