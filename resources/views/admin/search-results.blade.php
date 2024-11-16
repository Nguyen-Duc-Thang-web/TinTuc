@extends('admin.layouts.app')

@section('title')
    Kết Qủa Tìm Kiếm
@endsection

@section('content')
    <h2 class="text-center">Kết quả tìm kiếm</h2>
    {{-- bảng quảng cáo --}}
    @if ($advertisements && $advertisements->count() > 0)
        <h3>Advertisements</h3>
        <div class="table-responsive w-100" style="font-size: 14px;">
            <table class="table table-sm table-hover table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th class="align-middle">ID</th>
                        <th class="align-middle">Nội dung</th>
                        <th class="align-middle">Ngày bắt đầu</th>
                        <th class="align-middle">Ngày kết thúc</th>
                        <th class="align-middle">Trạng thái</th>
                        <th class="align-middle">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($advertisements as $advertisement)
                        <tr>
                            <th scope="row">{{ $advertisement->id }}</th>
                            <td>{{ $advertisement->content }}</td>
                            <td class="text-nowrap">{{ date('d-m-Y', strtotime($advertisement->start_date)) }}</td>
                            <td class="text-nowrap">{{ date('d-m-Y', strtotime($advertisement->end_date)) }}</td>
                            <td class="text-capitalize">{{ $advertisement->status }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.advertisements.index', ['query' => $advertisement->id]) }}"
                                        class="btn btn-sm btn-info me-2 d-flex">
                                        <i class="bi bi-search me-2"></i>Truy vấn
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($categories && $categories->count() > 0)
        <h3>Categories</h3>
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tên</th>
                  
                    <th class="align-middle">Trạng thái</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>
                            {!! $category->is_active
                                ? '<span class="badge bg-success">Hiển thị</span>'
                                : '<span class="badge bg-danger">Không</span>' !!}
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center align-middle">
                                <a href="{{ route('admin.categories.index', ['query' => $category->id]) }}"
                                    class="btn btn-sm btn-info me-2 d-flex">
                                    <i class="bi bi-search me-2"></i>Truy vấn
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{-- bảng comments --}}
    @if ($comments && $comments->count() > 0)
        <h3>Comments</h3>
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">User</th>
                    <th class="align-middle">Post</th>
                    <th class="align-middle">Content</th>
                    <th class="align-middle">Hidden</th>
                
                    <th class="align-middle">Created At</th>
                    <th class="align-middle">Updated At</th>
                    <th class="align-middle">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $comment->id }}</th>
                        <td>{{ $comment->user_name }}</td>
                        <td>{{ $comment->post_title }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{!! $comment->is_hidden ? '<span class="badge bg-danger">Ẩn</span>' : '<span class="badge bg-success">Hiện</span>' !!}</td>
                        <td>{{ $comment->created_at ?? 'N/A' }}</td>
                        <td>{{ $comment->updated_at }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center align-middle">
                                <a href="{{ route('admin.comments.index', ['query' => $comment->id]) }}"
                                    class="btn btn-sm btn-info me-2 d-flex">
                                    <i class="bi bi-search me-2"></i>Truy vấn
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{-- bảng Contacts --}}
    @if ($contacts && $contacts->count() > 0)
        <h3>Contacts</h3>
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
                    @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $contact->id }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->content }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center align-middle">
                                    <a href="{{ route('admin.contacts.index', ['query' => $contact->id]) }}"
                                        class="btn btn-sm btn-info me-2 d-flex">
                                        <i class="bi bi-search me-2"></i>Truy vấn
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    @endif
    {{-- bảng FAGs --}}
    @if ($faqs && $faqs->count() > 0)
        <h3>FAQs</h3>
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
                @if ($faqs && $faqs->count() > 0)
                    @foreach ($faqs as $faq)
                        <tr>
                            <th scope="row">{{ $faq->id }}</th>
                            <td>{{ $faq->question }}</td>
                            <td>{{ $faq->answer }}</td>
                            <td>
                                <a href="{{ route('admin.faqs.index', ['query' => $faq->id]) }}"
                                    class="btn btn-sm btn-info me-2 d-flex">
                                    <i class="bi bi-search me-2"></i>Truy vấn
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="text-danger fst-italic fw-bold">Không có dữ liệu!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif
    {{-- bảng bài viết --}}
    @if ($posts && $posts->count() > 0)
        <h3>Posts</h3>
        <div class="table-responsive w-100" style="font-size: 14px;">
            <table class="table table-sm table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th class="align-middle">ID</th>
                        <th class="align-middle">Tiêu đề</th>
                        <th class="align-middle">Tác giả</th>
                        <th class="align-middle">View</th>
                        <th class="align-middle">Mô tả</th>
                        <th class="align-middle">Danh mục</th>
                        <th class="align-middle">Trạng thái</th>
                        <th class="align-middle">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name ?? 'Không xác định' }}</td> <!-- Hiển thị tên tác giả -->
                           
                            <td>{{ $post->view }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($post->description, 50, '...') }}</td>
                            <td>{{ $post->category->name ?? 'Không có' }}</td>
                            <td>{{ $post->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.posts.index', ['query' => $post->id]) }}"
                                        class="btn btn-sm btn-info me-2 d-flex">
                                        <i class="bi bi-search me-2"></i>Truy vấn
                                    </a>
                                    {{-- <a href="{{ route('admin.posts.edit', $post->id) }}"
                                        class="btn btn-sm btn-warning me-2 d-flex">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger d-flex"
                                            onclick="return confirm('Bạn có muốn xóa bài viết này không?')">
                                            <i class="bi bi-trash me-2"></i>Xóa
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    {{-- bảng người dùng --}}
    @if ($users && $users->count() > 0)
        <h3>Users</h3>
        <table class="table table-sm table-hover text-center align-middle">
            <thead>
                <tr>
                    <th class="align-middle">ID</th>
                    <th class="align-middle">Tên</th>
                    <th class="align-middle">Email</th>
                    <th class="align-middle">Trạng thái</th>
                    <th class="align-middle">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.users.index', ['query' => $user->id]) }}"
                                    class="btn btn-sm btn-info me-2 d-flex">
                                    <i class="bi bi-search me-2"></i>Truy vấn
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
