@extends('clients.layouts.app')

@section('title')
    Trang chủ
@endsection

@section('content')
    <div class="post-area pd-top-75 pd-bottom-50">
        <div class="container">
            <div class="row">
                <div class="{{ isset($postsInWeek) && $postsInWeek->count() > 0 ? 'col-lg-4' : 'col-lg-6' }} col-md-6">
                    <div class="section-title">
                        <h6 class="title">Tin Tức Thịnh Hành</h6>
                    </div>
                    <div class="post-slider owl-carousel">
                        @foreach ($trendingPosts as $post)
    @if ($loop->index % 3 == 0)
        <div class="item">
            <div class="trending-post">
    @endif

                <div class="single-post-wrap style-overlay">
                    <div class="thumb">
                        @php
                            $image = $post->image;
                            if (!\Str::contains($image, 'http')) {
                                $image = Storage::url($image);
                            }
                        @endphp
                        <img src="{{ $image }}" width="363px" height="180px" alt="img">
                    </div>
                    <div class="details">
                        <div class="post-meta-single">
                            <p><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}</p>
                        </div>
                        <h6 class="title post-line1">
                            <a href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a>
                        </h6>
                    </div>
                </div>

    @if ($loop->index % 3 == 2 || $loop->last)
            </div> <!-- Đóng .trending-post -->
        </div> <!-- Đóng .item -->
    @endif
@endforeach
{{-- a --}}
            </div>
        </div>
        <div class="{{ isset($postsInWeek) && $postsInWeek->count() > 0 ? 'col-lg-4' : 'col-lg-6' }} col-md-6">
            <div class="section-title">
                <h6 class="title">Tin Tức Mới Nhất</h6>
            </div>
            <div class="post-slider owl-carousel">
                @foreach ($latestPosts as $post)
                    @if ($loop->index % 6 == 0)
                        <div class="item">
                    @endif

                    <div class="single-post-list-wrap">
                        <div class="media">
                            <div class="media-left">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" width="75px" height="66px" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i
                                                    class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                            </li>
                                        </ul>
                                    </div>
                                    <h6 class="title post-line2"><a
                                            href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($loop->index % 6 == 5 || $loop->index == count($latestPosts) - 1)
            </div>
            @endif
            @endforeach
        </div>
    </div>
    @if (isset($postsInWeek) && $postsInWeek->count() > 0)
        <div class="col-lg-4 col-md-6">
            <div class="section-title">
                <h6 class="title">Có Gì Mới</h6>
            </div>
            <div class="post-slider owl-carousel">
                @foreach ($postsInWeek as $post)
                    <div class="item">
                        <div class="single-post-wrap">
                            <div class="thumb">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" width="265px" height="250px" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single mb-4 pt-1">
                                    <ul>
                                        <li>
                                            <a class="tag-base tag-blue"
                                                href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                                        </li>
                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                        </li>
                                    </ul>
                                </div>
                                <h6 class="title post-line2"><a
                                        href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                                <p class="post-line3">Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do
                                    eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    </div>
    </div>
    </div>

    <div class="bg-sky pd-top-80 pd-bottom-50">
        <div class="container">
            <div class="row">
                @foreach ($featuredPosts as $post)
                    @if ($loop->index <= 6)
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-post-wrap">
                                <div class="thumb">
                                    @php
                                        $image = $post->image;
                                        if (!\Str::contains($image, 'http')) {
                                            $image = Storage::url($image);
                                        }
                                    @endphp
                                    <img src="{{ $image }}" width="380px" height="226px" alt="img">
                                    <p class="btn-date"><i
                                            class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}</p>
                                </div>
                                <div class="details">
                                    <h6 class="title post-line2"><a
                                            href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="pd-top-80 pd-bottom-50">
        <div class="container">
            <div class="row">
                @foreach ($latestPosts as $post)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap style-overlay">
                            <div class="thumb">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" width="275px" height="200px" alt="img">
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
                                    href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}</p>
                                </div>
                                <h6 class="title post-line2"><a
                                        href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="video-area bg-black pd-top-80 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="tab-content" id="ex1-content">
                        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{ asset('template/assets/img/post/23.png') }}" alt="img">
                                    <a href="https://www.youtube.com/watch?v=WwvNiN2_Jlk"
                                        class="video-play-btn play-btn-large play-btn-yellow mfp-iframe" tabindex="0"><i
                                            class="fa fa-play"></i></a>
                                </div>
                                <div class="details">
                                    <div class="post-meta-single">
                                        <a class="tag-base tag-blue" href="cat-tech.html">Tech</a>
                                        <p><i class="fa fa-clock-o"></i>08.22.2023</p>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">Scientists Discover the Switch That
                                            Makes Human</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{ asset('template/assets/img/video/01.png') }}" alt="img">
                                    <a href="https://www.youtube.com/watch?v=WwvNiN2_Jlk"
                                        class="video-play-btn play-btn-large play-btn-yellow mfp-iframe" tabindex="0"><i
                                            class="fa fa-play"></i></a>
                                </div>
                                <div class="details">
                                    <div class="post-meta-single">
                                        <a class="tag-base tag-blue" href="cat-tech.html">Tech</a>
                                        <p><i class="fa fa-clock-o"></i>08.22.2023</p>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">Here’s our take on the latest
                                            technology trends that will </a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{ asset('template/assets/img/post/23.png') }}" alt="img">
                                    <a href="https://www.youtube.com/watch?v=WwvNiN2_Jlk"
                                        class="video-play-btn play-btn-large play-btn-yellow mfp-iframe" tabindex="0"><i
                                            class="fa fa-play"></i></a>
                                </div>
                                <div class="details">
                                    <div class="post-meta-single">
                                        <a class="tag-base tag-blue" href="cat-tech.html">Tech</a>
                                        <p><i class="fa fa-clock-o"></i>08.22.2023</p>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">The gear and game plan you need to
                                            stay connected </a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="ex1-tabs-4" role="tabpanel">
                            <div class="single-post-wrap style-overlay">
                                <div class="thumb">
                                    <img src="{{ asset('template/assets/img/video/1.png') }}" alt="img">
                                    <a href="https://www.youtube.com/watch?v=WwvNiN2_Jlk"
                                        class="video-play-btn play-btn-large play-btn-yellow mfp-iframe" tabindex="0"><i
                                            class="fa fa-play"></i></a>
                                </div>
                                <div class="details">
                                    <div class="post-meta-single">
                                        <a class="tag-base tag-blue" href="cat-tech.html">Tech</a>
                                        <p><i class="fa fa-clock-o"></i>08.22.2023</p>
                                    </div>
                                    <h6 class="title"><a href="blog-details.html">Google Doodle celebrates modernist
                                            sculptor </a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="nxp-tab-inner video-tab-inner text-center">
                        <ul class="nav nav-tabs" id="ex1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="ex1-tab-1" data-toggle="pill" href="#ex1-tabs-1"
                                    role="tab" aria-selected="true">
                                    <div class="single-post-list-wrap style-white text-left">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset('template/assets/img/post/list/9.png') }}"
                                                    alt="img">
                                                <div class="play-btn-small play-btn-gray"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li>
                                                                <div class="tag-base tag-blue">Tech</div>
                                                            </li>
                                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2">Here’s our take on the latest technology
                                                        trends that will </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex1-tab-2" data-toggle="pill" href="#ex1-tabs-2" role="tab"
                                    aria-selected="false">
                                    <div class="single-post-list-wrap style-white text-left">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset('template/assets/img/post/list/10.png') }}"
                                                    alt="img">
                                                <div class="play-btn-small play-btn-gray"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li>
                                                                <div class="tag-base tag-blue">Tech</div>
                                                            </li>
                                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2">The gear and game plan you need to stay
                                                        connected </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex1-tab-3" data-toggle="pill" href="#ex1-tabs-3" role="tab"
                                    aria-selected="false">
                                    <div class="single-post-list-wrap style-white text-left">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset('template/assets/img/post/list/11.png') }}"
                                                    alt="img">
                                                <div class="play-btn-small play-btn-gray"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li>
                                                                <div class="tag-base tag-blue">Tech</div>
                                                            </li>
                                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2">Google Doodle celebrates modernist sculptor
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="ex1-tab-4" data-toggle="pill" href="#ex1-tabs-4" role="tab"
                                    aria-selected="false">
                                    <div class="single-post-list-wrap style-white text-left">
                                        <div class="media">
                                            <div class="media-left">
                                                <img src="{{ asset('template/assets/img/post/list/12.png') }}"
                                                    alt="img">
                                                <div class="play-btn-small play-btn-gray"><i class="fa fa-play"></i>
                                                </div>
                                            </div>
                                            <div class="media-body align-self-center">
                                                <div class="details">
                                                    <div class="post-meta-single">
                                                        <ul>
                                                            <li>
                                                                <div class="tag-base tag-blue">Tech</div>
                                                            </li>
                                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                                        </ul>
                                                    </div>
                                                    <h6 class="title mt-2">Ford recalls 50,000 EV charging cables over
                                                        fire concerns</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @isset($advertisement)
        <div class="add-area bg-after-sky mt-2">
            <div class="container overflow-hidden">
                @foreach ($advertisement as $ads)
                    @if ($ads->position == 'middle' && $ads->pages == 'home')
                        @php
                            $image = $ads->image;
                            if (!\Str::contains($image, 'http')) {
                                $image = Storage::url($image);
                            }
                        @endphp
                        <a href="{{ $ads->link }}">
                            <img src="{{ $image }}" alt="img" height="200" class="object-fit-cover">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endisset

    <div class="tranding-area pd-top-75 mb-2">
        <div class="container">
            <div class="section-title">
                <div class="row">
                    <div class="col-md-12 mb-2 mb-md-0">
                        <h6 class="title">Tin Tức Thịnh Hành</h6>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($trendingPosts as $post)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap">
                            <div class="thumb">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" width="275px" height="200px" alt="img">
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
                                    href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                            </div>
                            <div class="details">
                                <div class="post-meta-single mb-3">
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                        </li>
                                        <li><i class="fa fa-user"></i>{{ $post->user->name }}</li>
                                    </ul>
                                </div>
                                <h6 class="post-line2" style="min-height: 50px;"><a
                                        href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                                <p class="post-line3">{{ $post->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @isset($advertisement)
        <div class="add-area bg-after-sky mt-2">
            <div class="container overflow-hidden">
                @foreach ($advertisement as $ads)
                    @if ($ads->position == 'bottom' && $ads->pages == 'home')
                        @php
                            $image = $ads->image;
                            if (!\Str::contains($image, 'http')) {
                                $image = Storage::url($image);
                            }
                        @endphp
                        <a href="{{ $ads->link }}">
                            <img src="{{ $image }}" alt="img" height="200" class="object-fit-cover">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    @endisset
@endsection

@section('styles')
    <style>
        .post-line1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .post-line2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .post-line3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
