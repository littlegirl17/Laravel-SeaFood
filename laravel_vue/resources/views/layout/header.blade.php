<nav class="header_1">
    <div class="container header_box ">
        <div class="header_image">

            @foreach ($banners as $item)
                @if ($item->position == 5)
                    @if ($item->banneImages->isNotEmpty())
                        @foreach ($item->banneImages as $images)
                            <img src="{{ asset('uploads/' . $images->image) }}" class="imgfluidFooter">
                        @endforeach
                    @endif
                @endif
            @endforeach
        </div>
        <form action="{{ route('home.search') }}" method="GET" class="d-flex">
            <div class="InputContainerSearch">
                <input placeholder="Tìm kiếm..." id="searchHome" class="inputSearch" name="search" type="text">
            </div>
        </form>
        <div class="row headerUser_1">
            <ul class="d-flex my-3 list-unstyled ">
                <li class="nav-item dropdown ">
                    <a class="nav-link btnUser" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @auth
                            hi, {{ Session::has('user') ? Session::get('user')->name : '' }}
                        @else
                            Tài khoản <i class="fa-solid fa-user ps-1" style="color: #1f508d;"></i>
                        @endauth
                    </a>
                    <ul class="dropdown-menu">
                        @auth
                            <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                        @endauth
                    </ul>
                </li>
                <li class="nav-item ms-3">
                    <div class="position-relative">
                        <a class="nav-link active" href="/cart">
                            <img width="40" height="40"
                                src="https://img.icons8.com/windows/32/1A1A1A/shopping-bag.png" alt="shopping-bag" />
                        </a>
                        <p class="CountCart">{{ count(Session::get('cart', [])) }}</p>
                    </div>

                </li>
            </ul>

        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg nav_haeder2">
    <div class="container">
        <button class="navbar-toggler text-light bg-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbarNav" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0" data-aos="fade-right">
                <li class="nav-item dropdown navseafood">
                    <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Danh mục hải sản
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $cate)
                            <li><a class="dropdown-item " href="/category/{{ $cate->slug }}">{{ $cate->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active text-light" aria-current="page" href="/">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Bài viết</a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Liên hệ</a>
                </li>
            </ul>
            <div class="row headerUser_2">
                <ul class="d-flex my-3 list-unstyled ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link btnUser" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @auth
                                hi, {{ Session::has('user') ? Session::get('user')->name : '' }}
                            @else
                                Tài khoản <i class="fa-solid fa-user ps-1" style="color: #1f508d;"></i>
                            @endauth
                        </a>
                        <ul class="dropdown-menu">
                            @auth
                                <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Đăng ký</a></li>
                            @endauth
                        </ul>
                    </li>
                    <li class="nav-item ps-1">
                        <button class="btnCart position-relative">
                            <a class="nav-link active" href="/cart">
                                <img width="19" height="19"
                                    src="https://img.icons8.com/windows/32/1A1A1A/shopping-bag.png"
                                    alt="shopping-bag" />
                            </a>
                            <p class="CountCart">{{ count(Session::get('cart', [])) }}</p>
                        </button>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
