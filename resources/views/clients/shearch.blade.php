@extends('clients.layouts.app')

@section('title')
    Kết quả tìm kiếm cho: {{ $searchQuery }}
@endsection

@section('content')
    <section class="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        {{-- <h5 class="page-title">Kết quả tìm kiếm cho: {{ $searchQuery }}</h5> --}}
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li>Kết quả tìm kiếm: {{ $searchQuery }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="cat-page-area pd-bottom-80">
        <div class="container">


            <div class="row">
                <div class="col-lg-9 pd-top-50">
                    <div class="filter-area mb-4 d-flex justify-content-end">
                        <form action="{{ route('search') }}" method="GET" class="form-inline">
                            <input type="hidden" name="search" value="{{ $searchQuery }}">

                            <div class="form-group mr-3">
                                <label for="category" class="mr-2">Danh mục:</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mr-3">
                                <label for="sort_by" class="mr-2">Sắp xếp theo:</label>
                                <select name="sort_by" id="sort_by" class="form-control">
                                    <option value="newest" {{ $sortBy == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                    <option value="oldest" {{ $sortBy == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Lọc</button>
                        </form>
                    </div>
                    <div class="row mb-2">

                        @forelse ($searchResults as $post)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="single-post-wrap style-box">
                                    <div class="thumb">
                                        @php
                                            $image = $post->image;
                                            if (!\Str::contains($image, 'http')) {
                                                $image = Storage::url($image);
                                            }
                                        @endphp
                                        <img src="{{ $image }}" width="100%" height="auto"
                                            alt="{{ $post->title }}">
                                    </div>
                                    <div class="details p-3">
                                        <h6 class="title">
                                            <a href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a>
                                        </h6>
                                        <p>{{ Str::limit($post->description, 100) }}</p>
                                        <a class="btn btn-base mt-3" href="{{ route('post-detail', $post->slug) }}">Xem chi
                                            tiết</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Không tìm thấy kết quả nào cho từ khóa "{{ $searchQuery }}"</p>
                        @endforelse
                    </div>

                    {{-- <!-- Pagination -->
                    <div class="pagination-area">
                        {{ $searchResults->links() }}
                    </div> --}}
                </div>

                @include('clients.layouts.sidebar')
            </div>
        </div>
    </div>
@endsection
