@extends('admin.layouts.app')

@section('title')
    Quản lý liên hệ
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách liên hệ</h5>
        </small>

        @if (session('success') || session('error'))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error')}}
            </small>
        @endif

        <div class="d-block"></div>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tên</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Title</th>
                    <th class="align-middle">Content</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if($contacts && $contacts->count() > 0)
                    @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $contact->id }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->content }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center align-middle">
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-warning me-2 d-flex"><i class="bi bi-pencil-square me-2"></i>Xem</a>
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa liên hệ này không?')"><i class="bi bi-trash me-2"></i>Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                @else
                    <tr>
                        <td colspan="6" class="text-danger fst-italic fw-bold">Chưa có liên hệ nào được tạo!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        @isset($contacts)
            {{ $contacts->links() }}
        @endisset
    </div>
@endsection