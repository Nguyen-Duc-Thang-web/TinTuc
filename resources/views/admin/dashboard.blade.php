@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Tổng số lượt đọc bài viêt <span></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-eye-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">lượt xem tất cả bài viết</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Lượt truy cập liên kết quảng cáo</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-share-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">lượt truy cập</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Người dùng đăng kí</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">Người dùng</span>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- End Customers Card -->

                    {{-- <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                               
                                   
                                       
                                    </li>

                                    
                              
                                    
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Reports <span>/Today</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports --> --}}

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Người dùng đọc nhiều nhất</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên Người dùng</th>
                                            <th scope="col">Số lượng bài viết</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#">#2457</a></th>
                                            <td>Brandon Jacob</td>
                                            <td><a href="#" class="text-primary">At praesentium minu</a>
                                            </td>
                                            <td>$64</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2147</a></th>
                                            <td>Bridie Kessler</td>
                                            <td><a href="#" class="text-primary">Blanditiis dolor omnis
                                                    similique</a></td>
                                            <td>$47</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2049</a></th>
                                            <td>Ashleigh Langosh</td>
                                            <td><a href="#" class="text-primary">At recusandae
                                                    consectetur</a></td>
                                            <td>$147</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Angus Grady</td>
                                            <td><a href="#" class="text-primar">Ut voluptatem id earum
                                                    et</a></td>
                                            <td>$67</td>
                                            <td><span class="badge bg-danger">Rejected</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><a href="#">#2644</a></th>
                                            <td>Raheem Lehner</td>
                                            <td><a href="#" class="text-primary">Sunt similique
                                                    distinctio</a></td>
                                            <td>$165</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Bài viết mới nhất</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Bài viết</th>
                                            <th scope="col">Lượt xem</th>
                                        </tr>
                                    </thead>

                                    @isset($latestPosts)
                                        <tbody>
                                            @forelse ($latestPosts as $latestPost)
                                                <tr>
                                                    <th scope="row">
                                                        <a href="#"><img src="{{ $latestPost->image }}" alt=""></a>
                                                    </th>
                                                    <td>
                                                        <a href="#" class="text-primary fw-bold">{{ $latestPost->title }}</a>
                                                    </td>
                                                    <td>{{ $latestPost->view }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        <small class="text-danger">Chưa có bài viết nào được tạo.</small>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    @endisset
                                    {{-- <tbody>
                                        <tr>
                                            <th scope="row"><a href="#"><img
                                                        src="{{ asset('template/admin/assets/img/product-1.jpg') }}"
                                                        alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa
                                                    voluptas nulla</a></td>
                                            <td>$64</td>
                                            <td class="fw-bold">124</td>
                                            <td>$5,828</td>
                                        </tr>
                                    </tbody> --}}
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- News & Updates Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Bài viết nhiều lượt truy cập nhất</span></h5>

                        <div class="news mb-3">
                            @isset($postsMostViewed)
                                @forelse ($postsMostViewed as $mostView)
                                    <div class="post-item clearfix d-flex justify-content-between object-fit-cover">
                                        <img src="{{ $mostView->image }}" width="80px" height="60px" alt="">
                                        <div class="flex-fill ms-3">
                                            <h4 class="ms-0 mb-2"><a href="#">{{ $mostView->title }}</a></h4>
                                            <p style="margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $mostView->description }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="post-item clearfix text-center">
                                        <small class="text-danger">Chưa có bài viết nào được tạo.</small>
                                    </div>
                                @endforelse
                            @endisset
                        </div><!-- End sidebar recent posts-->

                    </div>
                </div><!-- End News & Updates -->
                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục truy cập nhiều nhất</h5>

                        <div class="activity">

                            @isset($mostVisitedCategories)
                                @foreach ($mostVisitedCategories as $mostVisted)
                                    <div class="activity-item d-flex">
                                        <div class="activite-label">{{ $mostVisted->click_count }}</div>
                                        <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                        <div class="activity-content">
                                            <a href="#" class="fw-bold text-dark">{{ $mostVisted->name }}</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endisset    

                        </div>
                    </div>
                </div><!-- End Recent Activity -->

                <!-- Budget Report -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
                    </div>
                </div><!-- End Budget Report -->

                <!-- Website Traffic -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Danh mục bài viết</h5>
                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                    </div>
                </div><!-- End Website Traffic -->

                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard', 'today') }}">Today</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard', 'week') }}">This Week</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard', 'month') }}">This Month</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard', 'year') }}">This Year</a></li>
                        </ul>
                    </div>
                
                    <div class="card-body pb-0">
                        <h5 class="card-title">Tin tức &amp; Cập nhật <span>| {{ ucfirst(request('timeframe', 'today')) }}</span></h5>
                
                        <div class="news">
                            @if (request()->is('admin/dashboard'))
                                @forelse ($postsToday as $post)
                                    <div class="post-item clearfix d-flex justify-content-between">
                                        <img src="{{ asset('template/admin/assets/img/news-1.jpg') }}" alt="">
                                        <div class="flex-fill ms-3">
                                            <h4 class="ms-0 mb-2"><a href="#">{{ $post->title }}</a></h4>
                                            <p style="margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->description }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="post-item clearfix text-center">
                                        <small class="text-danger">Chưa có bài viết nào được tạo trong ngày hôm nay.</small>
                                    </div>
                                @endforelse
                            @else
                                @isset($posts)
                                    @forelse ($posts as $post)
                                        <div class="post-item clearfix d-flex justify-content-between">
                                            <img src="{{ asset('template/admin/assets/img/news-1.jpg') }}" alt="">
                                            <div class="flex-fill ms-3">
                                                <h4 class="ms-0 mb-2"><a href="#">{{ $post->title }}</a></h4>
                                                <p style="margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $post->description }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        @if (session('message'))
                                            <div class="post-item clearfix text-center"><small class="text-danger">{{ session('message') }}</small></div>
                                        @endif
                                    @endforelse
                                @endisset
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- End Right side columns -->

        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Line Chart
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                    name: 'Sales',
                    data: [31, 40, 28, 51, 42, 82, 56],
                }, {
                    name: 'Revenue',
                    data: [11, 32, 45, 32, 34, 52, 41]
                }, {
                    name: 'Customers',
                    data: [15, 11, 32, 18, 9, 24, 11]
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                        "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                        "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                        "2018-09-19T06:30:00.000Z"
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                }
            }).render();
        });
        // End Line Chart

        // Budget Chart
        document.addEventListener("DOMContentLoaded", () => {
            var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                legend: {
                    data: ['Allocated Budget', 'Actual Spending']
                },
                radar: {
                    // shape: 'circle',
                    indicator: [{
                            name: 'Sales',
                            max: 6500
                        },
                        {
                            name: 'Administration',
                            max: 16000
                        },
                        {
                            name: 'Information Technology',
                            max: 30000
                        },
                        {
                            name: 'Customer Support',
                            max: 38000
                        },
                        {
                            name: 'Development',
                            max: 52000
                        },
                        {
                            name: 'Marketing',
                            max: 25000
                        }
                    ]
                },
                series: [{
                    name: 'Budget vs spending',
                    type: 'radar',
                    data: [{
                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                            name: 'Allocated Budget'
                        },
                        {
                            value: [5000, 14000, 28000, 26000, 42000, 21000],
                            name: 'Actual Spending'
                        }
                    ]
                }]
            });
        });
        // End Budget Chart

        // Traffic Chart
        document.addEventListener("DOMContentLoaded", () => {
            var trafficChartData = @json($countPostsInCategory->map(function($item) {
                return ['value' => $item->posts_count, 'name' => $item->name];
            }));

            echarts.init(document.querySelector("#trafficChart")).setOption({
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center'
                },
                series: [{
                    name: 'Số bài viết',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                        }
                    },
                    labelLine: {
                        show: false
                    },
                    data: trafficChartData
                }]
            });
        });
        // End Traffic Chart
    </script>
@endsection
