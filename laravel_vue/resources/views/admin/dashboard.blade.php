@extends('admin.layout.layoutAdmin')
@Section('title', 'Dashboard')
@Section('content')

    <div class="container-fluid">
        <h3 class="title-page cssTitle">
            Bảng điều khiển
        </h3>
        <div class="row cardDashboard">
            <div class="col-md-3 col-sm-6 col-12 pb-3">
                <a class="sidebar-link" href="{{ route('category') }}">
                    <div class="cardDashboard_1">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-4 iconDashboard">
                                <img width="30" height="30"
                                    src="https://img.icons8.com/external-xnimrodx-lineal-xnimrodx/64/ff5370/external-categories-shopping-mall-xnimrodx-lineal-xnimrodx.png"
                                    alt="external-categories-shopping-mall-xnimrodx-lineal-xnimrodx" />
                            </div>
                            <div class="col-md-8 col-sm-8 col-8">
                                <h4>Danh mục</h4>
                                <p class="">10 danh mục</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 pb-3 ">
                <a class="sidebar-link" href="{{ route('product') }}">
                    <div class="cardDashboard_2">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-4 iconDashboard">
                                <img width="30" height="30"
                                    src="https://img.icons8.com/ios-filled/64/4099ff/open-box.png" alt="open-box" />
                            </div>
                            <div class="col-md-8 col-sm-8 col-8">
                                <h4>Sản phẩm</h4>
                                <p>10 danh mục</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 pb-3 ">
                <a class="sidebar-link" href="{{ route('user') }}">
                    <div class="cardDashboard_3">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-4 iconDashboard">
                                <img width="30" height="30"
                                    src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/64/2ed8b6/external-user-social-media-ui-tanah-basah-glyph-tanah-basah.png"
                                    alt="external-user-social-media-ui-tanah-basah-glyph-tanah-basah" />
                            </div>
                            <div class="col-md-8 col-sm-8 col-8">
                                <h4>Thành viên</h4>
                                <p>10 danh mục</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6 col-12 pb-3 ">
                <div class="cardDashboard_4">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-4  iconDashboard">
                            <img width="30" height="30"
                                src="https://img.icons8.com/external-creatype-outline-colourcreatype/64/ffb64d/external-blog-user-interface-creatype-outline-colourcreatype.png"
                                alt="external-blog-user-interface-creatype-outline-colourcreatype" />
                        </div>
                        <div class="col-md-8 col-sm-8 col-8">
                            <h4>Bài viêt</h4>
                            <p>10 danh mục</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
