<div class="banner-area banner-inner-1 bg-black">
    @foreach ($featuredPosts as $post)
        <!-- banner area start -->
        @if ($loop->first)
            <div class="banner-inner pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="thumb after-left-top">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" alt="img">
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                            <div class="banner-details mt-4 mt-lg-0">
                                <div class="post-meta-single">
                                    <ul>
                                        <li><a class="tag-base tag-blue"
                                                href="cat-tech.html">{{ $post->category->name }}</a></li>
                                        <li class="date"><i
                                                class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                        </li>
                                    </ul>
                                </div>
                                <h2 style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->title }}</h2>
                                <p style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->description }}</p>
                                <a class="btn btn-blue" href="{{ route('post-detail', $post->slug) }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner area end -->

            <div class="container">
                <div class="row">
        @elseif($loop->index <= 4)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-post-wrap style-white">
                            <div class="thumb">
                                @php
                                    $image = $post->image;
                                    if (!\Str::contains($image, 'http')) {
                                        $image = Storage::url($image);
                                    }
                                @endphp
                                <img src="{{ $image }}" width="278px" height="185px" alt="img">
                                @php
                                    $colors = ['tag-red', 'tag-blue', 'tag-green', 'tag-orange', 'tag-purple'];
                                    $randomColor = $colors[array_rand($colors)];
                                @endphp

                                <a class="tag-base {{ $randomColor }}" href="cat-tech.html">{{ $post->category->name }}</a>

                            </div>
                            <div class="details">
                                <h6 class="title" style="min-height: 55px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><a href="{{ route('post-detail', $post->slug) }}">{{ $post->title }}</a></h6>
                                <div class="post-meta-single mt-3">
                                    <ul>
                                        <li>
                                            <i class="fa fa-clock-o"></i>{{ date('d.m.Y', strtotime($post->created_at)) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        @endif
    @endforeach
        </div>
    </div>
</div>
