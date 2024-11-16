<div class="col-lg-3 pd-top-50">
    {{-- <div class="share-buttons mt-4">
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
    </div> --}}
    {{-- a --}}

    <div class="category-sitebar">
        <div class="widget widget-category">
            <h6 class="widget-title">Danh mục</h6>
            <div class="row custom-gutters-14">
                @foreach ($categories as $category)
                    <div class="col-md-12 col-sm-6">
                        <div class="single-category-inner text-center">
                            <img src="{{ Storage::url($category->image) }}" alt="img" height="50"
                                class="mx-auto object-fit-cover">
                            <a class="tag-base tag-blue text-nowrap"
                                href="{{ route('category.posts', $category->slug) }}"
                                style="min-width: 200px;">{{ $category->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @isset($advertisement)
            <div class="widget widget-add">
                @foreach ($advertisement as $ads)
                    @if (($ads->position == 'sidebar' && $ads->pages == 'post_detail'))
                        @php
                            $image = $ads->image;
                            if (!\Str::contains($image, 'http')) {
                                $image = Storage::url($image);
                            }
                        @endphp
                        <a href="{{ $ads->link }}" class="add">
                            <img src="{{ $image }}" alt="img" width="262" class="object-fit-cover">
                        </a>
                    @endif
            @endforeach
            
            </div>
        @endisset

        <div class="widget">
            <h6 class="widget-title">Danh mục</h6>
            <div class="post-slider owl-carousel">
                <div class="item">
                    <div class="trending-post">
                        <div class="single-post-wrap style-overlay">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/5.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">The FAA will test drone </a></h6>
                            </div>
                        </div>
                        <div class="single-post-wrap style-overlay">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/6.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">Flight schedule and quarantine</a>
                                </h6>
                            </div>
                        </div>
                        <div class="single-post-wrap style-overlay mb-0">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/7.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">Indore bags cleanest city</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="trending-post">
                        <div class="single-post-wrap style-overlay">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/5.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">The FAA will test drone </a></h6>
                            </div>
                        </div>
                        <div class="single-post-wrap style-overlay">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/6.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">Flight schedule and quarantine</a>
                                </h6>
                            </div>
                        </div>
                        <div class="single-post-wrap style-overlay mb-0">
                            <div class="thumb">
                                <img src="{{ asset('template/assets/img/post/7.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <div class="post-meta-single">
                                    <p><i class="fa fa-clock-o"></i>December 26, 2018</p>
                                </div>
                                <h6 class="title"><a href="#">Indore bags cleanest city</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget">
            <div class="nxp-tab-inner nxp-tab-post-two mb-4">
                <ul class="nav nav-tabs justify-content-center" id="nx1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="nx1-tab-1" data-toggle="pill" href="#nx1-tabs-1" role="tab"
                            aria-selected="true">
                            Gần đây
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nx1-tab-2" data-toggle="pill" href="#nx1-tabs-2" role="tab"
                            aria-selected="false">
                            Phổ biến
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="nx1-content">
                <div class="tab-pane fade show active" id="nx1-tabs-1" role="tabpanel">
                    <div class="single-post-list-wrap">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/1.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Himachal Pradesh rules in order
                                            to
                                            allow tourists </a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post-list-wrap">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/2.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Online registration, booking for
                                            Vaishno Devi </a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post-list-wrap mb-0">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/3.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Detecting technologies in
                                            airports
                                            this year</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nx1-tabs-2" role="tabpanel">
                    <div class="single-post-list-wrap">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/2.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Online registration, booking for
                                            Vaishno Devi </a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post-list-wrap">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/3.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Detecting technologies in
                                            airports
                                            this year</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post-list-wrap mb-0">
                        <div class="media">
                            <div class="media-left">
                                <img src="{{ asset('template/assets/img/post/list/3.png') }}" alt="img">
                            </div>
                            <div class="media-body">
                                <div class="details">
                                    <div class="post-meta-single">
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>08.22.2023</li>
                                        </ul>
                                    </div>
                                    <h6 class="title"><a href="#">Detecting technologies in
                                            airports
                                            this year</a></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
