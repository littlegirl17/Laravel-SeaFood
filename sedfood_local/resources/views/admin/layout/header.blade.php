
<div class="container-fluid main-page">
    <div class="app-main">
        <nav class="sidebar rounded-0">
            <section class="infocol1 row">
                <div class="col-12 d-flex justify-content-center pb-3">
                    <img src="{{asset('img/logo/LoGo.png')}}" alt="">
                </div>
            </section>
            <section class="infocol2 row">
                <div class="col-md-4">
                    <img src="{{asset('img/logo/'.Session::get('user')->image)}}" alt="">
                </div>
                <div class="col-md-8">
                    <h6>{{Session::get('user')->name}}</h6>
                    <p>Quản trị viên</p>
                </div>
            </section>
            <ul>
                <li>
                    <a href="{{route ('dashboard')}}"><i class="fa-solid fa-gauge-high ico-side" style="color: #B197FC;"></i>Dashboards</a>
                </li>
                <li>
                    <a href="{{route ('category')}}"><i class="fa-solid fa-list ico-side" style="color: #FFD43B;"></i>Quản kí danh mục</a>
                </li>
                <li>
                    <a href="{{route ('product')}}"><i class="fa-solid fa-pen-to-square ico-side" style="color: #63E6BE;"></i>Quản lí sản phẩm</a>
                </li>
                <li>
                    <a href="{{route ('user')}}"><i class="fa-solid fa-user ico-side" style="color: #fa0000;"></i>Quản lí thành viên</a>
                </li>
                <li>
                    <a href="{{route ('comment')}}"><i class="fa-regular fa-message ico-side" style="color: #74C0FC;"></i>Quản lí bình luận</a>
                </li>
            </ul>
        </nav>
        <div class="main-content">
            <section class="headerTop row ">
                <div class="dropdown d-flex justify-content-end align-items-center" style="padding: 0px 0px;">
                    <img src="{{asset('img/logo/'.Session::get('user')->image)}}" alt="">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, {{Session::get('user')->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                    </ul>
                </div>
            </section>
