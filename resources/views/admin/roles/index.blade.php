@extends('admin.layouts.app')

@section('title')
    Danh sách Roles
@endsection

@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> --}}
                <li class="breadcrumb-item">Roles</li>
                <li class="breadcrumb-item active">Danh sách</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title">Danh sách Roles</h5>
                            <a href="{{ route('roles.create') }}" class="btn btn-primary">Thêm mới danh mục</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Role</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <th>{{ $key + 1 }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @if ($role->delete_at)
                                                Không hoạt động
                                            @else
                                                Hoạt động
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">
                                            @if ($role->trashed())
                                                <div class="btn-group" role="group" aria-label="Hành động">
                                                    {{-- Nút khôi phục --}}
                                                    <form action="{{ route('roles.restore', $role->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success me-1"
                                                            onclick="return confirm('Bạn có muốn khôi phục vai trò này?')">Khôi
                                                            Phục</button>
                                                    </form>
                                                    {{-- Nút xóa vĩnh viễn --}}
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Bạn có muốn xóa vĩnh viễn vai trò này?')">Xóa</button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="btn-group" role="group" aria-label="Hành động">
                                                    <!-- Nút chỉnh sửa -->
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        class="btn btn-primary me-1 d-inline">Sửa</a>
                                                    {{-- Nút Ẩn (Xóa mềm) --}}
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Bạn có chắc chắn muốn ẩn?')">Ẩn</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Role Table -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
