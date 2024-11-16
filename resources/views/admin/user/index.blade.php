@extends('admin.layouts.app')

@section('title')
   Quản lí tài khoản
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách tài khoản</h5>
        </small>

        @if (session('success') || session('error'))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error')}}
            </small>
        @endif

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tên</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Mật khẩu</th>
                    <th class="align-middle">Avatar</th>
                    <th class="align-middle">Trạng thái</th>
                    <th class="align-middle">Nhà cung cấp</th>
                    <th class="align-middle">ID Mạng xã hội</th>
                    <th class="align-middle">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if($users && $users->count() > 0)
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>*******</td> <!-- Ẩn mật khẩu không nên hiển thị -->
                            <td>
                                <img src="{{ $user->avatar }}" alt="Avatar" width="50" height="50">
                            </td>
                            <td>{{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                            <td>{{ $user->social_provider ?? 'N/A' }}</td>
                            <td>{{ $user->social_id ?? 'N/A' }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning me-2 d-flex">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa người dùng này không?')">
                                            <i class="bi bi-trash me-2"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-danger fst-italic fw-bold">Chưa có tài khoản nào được tạo!</td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>
@endsection
