@extends('clients.layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <!--page-title area-->
    <section class="page-title-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h5 class="page-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $post->title }}</h5>
                        <ul class="page-list">
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li>{{ $post->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--page-title area end-->
{{-- a --}}
    <div class="blog-page-area pd-bottom-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 pd-top-50">
                    <div class="blog-details-page-inner">
                        <div class="single-blog-inner m-0">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb text-center">
                                    @php
                                        $image = $post->image;
                                        if (!\Str::contains($image, 'http')) {
                                            $image = Storage::url($image);
                                        }
                                    @endphp
                                    <img src="{{ $image }}" alt="img">
                                </div>
                                <div class="details pb-4">
                                    <div class="post-meta-single mb-2">
                                        <ul>
                                            <li><a class="tag-base tag-blue" href="#">{{ $post->category->name }}</a>
                                            </li>
                                            <li>
                                                <p><i
                                                        class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                                </p>
                                            </li>
                                            <li><i class="fa fa-user"></i>{{ $post->user->name }}</li>
                                        </ul>
                                    </div>
                                    <h5 class="title mt-0">{{ $post->title }}</h5>
                                </div>
                            </div>
                            <div class="single-blog-details">
                                <div>
                                    {!! $post->content !!}
                                </div>
                            </div>
                            
                            @isset($advertisement)
                                @foreach ($advertisement as $ads)
                                    @if ($ads->position == 'middle' && $ads->pages == 'post_detail')
                                        @php
                                            $image = $ads->image;
                                            if (!\Str::contains($image, 'http')) {
                                                $image = Storage::url($image);
                                            }
                                        @endphp
                                        <div class="add-area">
                                            <a href="{{ $ads->link }}">
                                                <img src="{{ $image }}" alt="img" height="200"
                                                    class="object-fit-cover">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            @endisset
                            <div class="share-buttons mt-4">
                                <h5>Chia sẻ bài viết:</h5>
                                <div class="d-flex">
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                                        class="btn btn-facebook mr-2 text-primary ">
                                        <i class="bi bi-facebook fs-1"></i> Facebook
                                    </a>
                                    <!-- Twitter -->
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-twitter mr-2">
                                        <i class="bi bi-twitter fs-1"></i> Twitter
                                    </a>
                                </div>
                            </div>
                            <div class="author-area">
                                <div class="media">
                                    <img src="{{ $post->user->avatar }}" alt="Avatar" width="100" height="100">
                                    <div class="media-body align-self-center">
                                        <h4>{{ $post->user->name }}</h4>
                                        <p>Chưa có Thông Tin Tác Gỉả</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (isset($relatedPosts) && $relatedPosts->count() > 0)
                            <div class="related-post">
                                <div class="section-title mb-0">
                                    <h5 class="mb-0">Bài viết liên quan</h5>
                                </div>
                                <div class="row">
                                    @foreach ($relatedPosts as $relatedPost)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-post-wrap">
                                                <div class="thumb">
                                                    @php
                                                        $image = $relatedPost->image;
                                                        if (!\Str::contains($image, 'http')) {
                                                            $image = Storage::url($image);
                                                        }
                                                    @endphp
                                                    <img src="{{ $image }}" width="278px" height="165px"
                                                        alt="img">
                                                    @php
                                                        $colors = [
                                                            'tag-red',
                                                            'tag-blue',
                                                            'tag-green',
                                                            'tag-orange',
                                                            'tag-purple',
                                                            'tag-light-green',
                                                        ];
                                                        $randomColor = $colors[array_rand($colors)];
                                                    @endphp

                                                    <a class="tag-base {{ $randomColor }}"
                                                        href="{{ route('category.posts', $relatedPost->category->slug) }}">{{ $relatedPost->category->name }}</a>
                                                </div>
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li><i
                                                                    class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($relatedPost->created_at)) }}
                                                            </li>
                                                            <li><i class="fa fa-user"></i>{{ $relatedPost->user->name }}</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2"
                                                        style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                        <a href="{{ route('post-detail', $relatedPost->slug) }}">
                                                            {{ $relatedPost->title }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="blog-comment">
                            <div class="section-title">
                                <h4>Bình luận</h4>
                            </div>
                            @if($comments->isEmpty())
                                <p>Chưa có bình luận nào.</p>
                            @else
                                @foreach($comments as $comment)
                                    <div class="media">
                                        <a href="#">
                                            <img src="{{ $comment->user->avatar }}" alt="Avatar" width="100" height="100">
                                        </a>
                                        <div class="media-body">
                                            <h5><a href="#">{{ $comment->user->name ?? 'Người dùng ẩn danh' }}</a></h5>
                                            <span class="date">{{ $comment->created_at->format('d M Y') }}</span>
                                            <p>{{ $comment->content }}</p>
                                            <a href="#">Reply <i class="la la-arrow-right"></i></a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="comment-form">
                            <div class="section-title mb-0">
                                <h4 class="mb-0">Để lại bình luận</h4>
                            </div>
                            <form class="contact-form-wrap" action="{{ route('post.comment', $post->slug) }}" method="POST">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="single-input-wrap message input-group">
                                            <textarea class="form-control" rows="4" name="content" placeholder="Bình luận ở đây.....">{{ old('content') }}</textarea>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-pencil"></i></div>
                                            </div>
                                        </div>
                                        @error('content')
                                            <div class="error" style="color: red;">
                                                {{ $message }}
                                            </div>
                                        @enderror
                        
                                        @if (Auth::check())
                                            <div class="submit-area">
                                                <button type="submit" class="btn btn-base">Gửi bình luận</button>
                                            </div>
                                        @else
                                            <p style="text-align: center">Vui lòng <a href="{{ route('admin.login') }}" style="color: red; font-size: 15px">Đăng nhập</a> để bình luận</p>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @if(session('success'))
                                <div class="alert alert-success" style="color: green; text-align: center;">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        
                    </div>
                </div>

                @include('clients.layouts.sidebar')

            </div>
        </div>
    </div>
@endsection
