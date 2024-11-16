@extends('admin.layouts.app')

@section('title')
    Thùng rác
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <small class="fst-italic">
                <h5>Danh sách quảng cáo đã xóa</h5>
            </small>
   
            @if (session('success') || session('error'))
                <small class="{{ session('success') ? 'text-success' : 'text-danger' }} fst-italic fw-bold">
                    {{ session('success') ?? session('error') }}
                </small>
            @endif

            <a href="{{ route('admin.advertisements.index') }}" class="btn btn-outline-primary"> <i class="bi bi-arrow-left"> </i></a>
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
                    @if($trashedAdvertisements && $trashedAdvertisements->count() > 0)
                        @foreach ($trashedAdvertisements as $advertisement)
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
                                <td>{{ date('d-m-Y', strtotime($advertisement->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($advertisement->end_date)) }}</td>
                                <td class="text-capitalize">{{ $advertisement->status }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <form action="{{ route('admin.advertisements.restore', $advertisement->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <button class="btn btn-sm btn-secondary me-2 text-nowrap d-flex"> <i class="bi bi-recycle me-1"></i> Khôi phục </button>
                                        </form>

                                        <form action="{{ route('admin.advertisements.force-delete', $advertisement->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger d-flex" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn chến dịch quảng cáo này không?')"> <i class="bi bi-trash me-1"></i> Xóa </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-danger fst-italic fw-bold">Chưa có quảng cáo nào trong thùng rác!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @isset($trashedAdvertisements)
            {{ $trashedAdvertisements->links() }}
        @endisset
    </div>
@endsection