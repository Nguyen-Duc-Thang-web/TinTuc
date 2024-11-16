<aside id="sidebar" class="sidebar d-flex flex-column justify-content-between">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.dashboard') }}">
                 <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Quản lý người dùng</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.create') }}">
                        <i class="bi bi-circle"></i><span>Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li><!-- End User Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#cate-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-bookmark"></i><span>Quản lý danh mục</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cate-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.categories.index') }}">
                         <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.create') }}">
                         <i class="bi bi-circle"></i><span>Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Categories Nav -->
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#post-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-postcard"></i><span>Quản lý bài viết</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="post-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}">
                        <i class="bi bi-circle"></i><span>Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Posts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#comment-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-chat"></i><span>Quản lý bình luận</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="comment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.comments.index') }}">
                        <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
            </ul>
        </li><!-- End comments Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#ads-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-badge-ad-fill"></i><span>Quản lý quảng cáo</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="ads-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.advertisements.index') }}">
                         <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.advertisements.create') }}">
                         <i class="bi bi-circle"></i><span>Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Advertisements Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#contact-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-telephone"></i><span>Quản lý phản hồi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="contact-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.contacts.index') }}">
                         <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Contacts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#faq-nav" data-bs-toggle="collapse" href="#">
                 <i class="bi bi-question-circle"></i><span>Quản lý F.A.Qs</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="faq-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('admin.faqs.index') }}">
                         <i class="bi bi-circle"></i><span>Danh sách</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.faqs.create') }}">
                         <i class="bi bi-circle"></i><span>Thêm mới</span>
                    </a>
                </li>
            </ul>
        </li><!-- End FAQs Nav -->

    </ul>

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('admin.login') }}">
                 <i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span>
            </a>
        </li><!-- End Logout Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
