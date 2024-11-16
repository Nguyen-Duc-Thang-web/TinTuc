@extends('admin.layouts.app')

@section('title')
    Quản lý F.A.Q
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <small class="fst-italic">
            <h5>Danh sách câu hỏi thường gặp</h5>
        </small>

        @if (session('success') || session('error'))
            <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                {{ session('success') ?? session('error')}}
            </small>
        @endif

        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="table-responsive w-100" style="font-size: 14px;">
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Câu hỏi</th>
                    <th class="align-middle">Trả lời</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if($faqs && $faqs->count() > 0)
                    @foreach ($faqs as $faq)
                        <tr>
                            <th scope="row">{{ $faq->id }}</th>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center align-middle">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning me-2 d-flex"><i class="bi bi-pencil-square me-2"></i>Sửa</a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa câu hỏi này không?')"><i class="bi bi-trash me-2"></i>Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach 
                @else
                    <tr>
                        <td colspan="4" class="text-danger fst-italic fw-bold">Chưa có câu hỏi nào được tạo!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        @isset($faqs)
            {{ $faqs->links() }}
        @endisset
    </div>
@endsection