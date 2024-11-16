@extends('admin.layouts.app')

@section('title')
    Quản lý quảng cáo
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="fst-italic">
                <h5>Danh sách quảng cáo</h5>
            </small>

            @if (session('success') || session('error'))
                <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                    {{ session('success') ?? session('error') }}
                </small>
            @endif

            <div>
                <a href="{{ route('admin.advertisements.trashed') }}" class="btn btn-outline-danger me-2">
                    <i class="bi bi-trash-fill me-1"></i> Thùng rác
                </a>
                <a href="{{ route('admin.advertisements.create') }}" class="btn btn-primary"> 
                    <i class="bi bi-plus-circle me-1"></i> Thêm mới 
                </a>
            </div>
        </div>

        <div class="table-responsive w-100" style="font-size: 14px;">
            <table class="table table-sm table-hover table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th class="align-middle">ID</th>
                        <th class="align-middle">Tạo bởi</th>
                        <th class="align-middle">Ảnh/Video</th>
                        <th class="align-middle">Nội dung</th>
                        <th class="align-middle">Trang</th>
                        <th class="align-middle">Danh mục</th>
                        <th class="align-middle">Vị trí</th>
                        <th class="align-middle">Ngày bắt dầu</th>
                        <th class="align-middle">Ngày kết thúc</th>
                        <th class="align-middle">Trạng thái</th>
                        <th class="align-middle">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($advertisements && $advertisements->count() > 0)
                        @foreach ($advertisements as $advertisement)
                            <tr>
                                <th scope="row">{{ $advertisement->id }}</th>
                                <td>{{ $advertisement->user->name }}</td>
                                <td class="overflow-hidden">
                                    @php
                                        $url = $advertisement->image;
                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                    @endphp
                                    <img src="{{ $url }}" alt="" width="150px" height="150px" class="object-fit-cover">
                                </td>
                                <td>{{ $advertisement->content }}</td>
                                <td>{{ $advertisement->pages ?? 'N/A' }}</td>
                                <td>{{ $advertisement->category->name ?? 'N/A' }}</td>
                                <td>{{ $advertisement->position }}</td>
                                <td class="text-nowrap">{{ date('d-m-Y', strtotime($advertisement->start_date)) }}</td>
                                <td class="text-nowrap">{{ date('d-m-Y', strtotime($advertisement->end_date)) }}</td>
                                <td class="text-capitalize">{{ $advertisement->status }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('admin.advertisements.edit', $advertisement->id) }}" class="btn btn-sm btn-warning me-2 d-flex"> <i class="bi bi-pencil-square me-1"></i> Sửa </a>

                                        <form action="{{ route('admin.advertisements.destroy', $advertisement->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có muốn xóa chến dịch quảng cáo này không?')"> <i class="bi bi-trash me-1"></i> Xóa </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-danger fst-italic fw-bold">Chưa có chến dịch quảng cáo nào được tạo!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @isset($advertisement)
            {{ $advertisements->links() }}
        @endisset
    </div>
@endsection