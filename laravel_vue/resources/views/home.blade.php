@extends('layout.layout')
@Section('title', 'SeaFood | website hải sản')
@Section('content')
    <div id="mainApp">
        <div class="container-fluid p-0 bannerMobile">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" data-aos="fade-right"
                data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="carousel-inner">
                    @foreach ($banners as $item)
                        @if ($item->position === 1)
                            @if ($item->banneImages->isNotEmpty())
                                @foreach ($item->banneImages as $images)
                                    <div class="carousel-item active" data-bs-interval="10000">
                                        <img src="{{ asset('uploads/' . $images->image) }}"
                                            class="d-block w-100 imageBanner" alt="...">
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="container bannerDestop">
            @foreach ($banners as $item)
                @if ($item->position === 1)
                    <div class="row ">
                        <div class="col-md-8 banner1">
                            <div id="carouselExampleInterval" class="carousel slide" data-aos="fade-right"
                                data-aos-offset="300" data-aos-easing="ease-in-sine">
                                <div class="carousel-inner">
                                    @if ($item->banneImages->isNotEmpty())
                                        @foreach ($item->banneImages as $images)
                                            @if ($images->sort_order === 1)
                                                <div class="carousel-item active" data-bs-interval="10000">
                                                    <img src="{{ asset('uploads/' . $images->image) }}"
                                                        class="d-block w-100 imageBanner" alt="...">
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 banner2">
                            <div class="row m-0">
                                @if ($item->banneImages && $item->banneImages->isNotEmpty())
                                    @foreach ($item->banneImages as $images)
                                        @if ($images->sort_order == 2)
                                            <div class="pb-3">
                                                <div class="">
                                                    <img src="{{ asset('uploads/' . $images->image) }}"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($item->banneImages && $item->banneImages->isNotEmpty())
                                    @foreach ($item->banneImages as $images)
                                        @if ($images->sort_order == 3)
                                            <div class="pt-2">
                                                <div class="">
                                                    <img src="{{ asset('uploads/' . $images->image) }}"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <section class="new ">
            <div class="container ">
                <div class="row text-center " data-aos="fade-right">
                    <div class="title">
                        <h2 class="title_h2">Danh Mục Hải Sản</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($categories as $cate)
                            <div class="">
                                <div class="item owl_category" style="">
                                    <a href="/category/{{ $cate->slug }}" class="text-decoration-none textCategory ">
                                        <img src="uploads/{{ $cate['image'] }}" class="img-new animaCate" alt="">
                                        <h6 class="text-center">{{ $cate['name'] }}</h6>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- START SẢN PHẨM NỔI BẬT --}}
        <section class="productOutstanding"
            style="background-image: url('uploads/product.png'); background-size: cover; background-position: center; background-repeat: no-repeat; margin-top:40px;">
            <div class="container">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="title_h2">Sản Phẩm Nổi Bật</h2>
                    </div>

                    <div class="owl-carousel owl-theme">
                        @foreach ($productOutstanding as $item)
                            @php
                                $userProductDiscount = 0;
                                $userProductDiscountDefault = 0;

                                if ($user) {
                                    $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                    $userProductDiscount = $item->productDiscounts
                                        ->where('user_group_id', $userGroup)
                                        ->first();
                                } else {
                                    //   Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng
                                    $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                    $userProductDiscountDefault = $item->productDiscounts
                                        ->where('user_group_id', $userGroup)
                                        ->first();
                                    //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                                }
                            @endphp

                            <div class="item">
                                @php
                                    //
                                    if ($user) {
                                        if ($userProductDiscount) {
                                            $phamTram = ceil(
                                                (($item->price - $userProductDiscount->price) / $item->price) * 100,
                                            );
                                        }
                                    } else {
                                        if ($userProductDiscountDefault) {
                                            $phamTram = ceil(
                                                (($item->price - $userProductDiscountDefault->price) / $item->price) *
                                                    100,
                                            );
                                        }
                                    }
                                @endphp
                                <div class="cardhover">
                                    @if ($user)
                                        @if (isset($userProductDiscount))
                                            <div class="productSale">
                                                <p>{{ $phamTram }}%</p>
                                            </div>
                                        @endif
                                    @else
                                        @if (isset($userProductDiscountDefault))
                                            <div class="productSale">
                                                <p>{{ $phamTram }}%</p>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="card rounded-0 border-0 cardhover2">
                                        <img src="uploads/{{ $item->image }}" class="" alt="...">
                                    </div>
                                    <a href="/detail-product/{{ $item->slug }}" class="text-black text-decoration-none">
                                        <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                    </a>
                                    <p class="card-text py-1">
                                        @if ($user && $user->userGroup)
                                            @php

                                                $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                $userProductDiscount = $item->productDiscounts
                                                    ->where('user_group_id', $userGroup)
                                                    ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                            @endphp

                                            @if ($userProductDiscount)
                                                {{-- Giá mặc định --}}
                                                <span
                                                    class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                {{-- Giá theo xếp hạng --}}
                                                <span
                                                    class="price">{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</span>
                                            @else
                                                <span
                                                    class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                            @endif
                                        @else
                                            @if ($userProductDiscountDefault)
                                                {{-- Giá mặc định --}}
                                                <span
                                                    class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                {{-- Giá theo xếp hạng --}}
                                                <span
                                                    class="price">{{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</span>
                                            @else
                                                <span
                                                    class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                            @endif
                                        @endif
                                        <br>
                                    </p>
                                    <div class="hoverAddcart btnFormBox">
                                        {{-- đây là component cha : cho phép truyền dữ liệu từ thành phần cha sang thành phần con --}}
                                        <add-to-cart-component :product-data="{{ json_encode($item) }}"
                                            :user_id="{{ Session::has('user') ? Session::get('user')->id : 0 }}"></add-to-cart-component>
                                        <button class="btnForm"
                                            onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}','{{ $user }}','{{ $userProductDiscount ? $userProductDiscount->price : $item->price }}', '{{ $userProductDiscountDefault ? $userProductDiscountDefault->price : $item->price }}')">
                                            <i class="fa-solid fa-eye" style="color: #1f508ds;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- END SẢN PHẨM NỔI BẬT --}}


        <div class="container mt-5" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <div class="card border-0 rounded-0  cardImg ">
                @foreach ($banners as $item)
                    @if ($item->position === 2)
                        @if ($item->banneImages->isNotEmpty())
                            @foreach ($item->banneImages as $images)
                                <img src="{{ asset('uploads/' . $images->image) }}" class="card-img-top w-100"
                                    alt="...">
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </div>
        </div>

        {{-- START SẢN PHẨM GIẢM GIÁ --}}
        <section class="product">
            <div class="container">
                <div class="row text-center " data-aos="fade-right" data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="title_h2">Sản Phẩm Giảm Giá</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($getDefaultUserGroup as $item)
                            <div class="item">
                                @php
                                    $phamTram = ceil(
                                        (($item->product->price - $item->price) / $item->product->price) * 100,
                                    );
                                @endphp
                                <div class="position-relative ">
                                    <div class="cardhover">
                                        <div class="productSale">
                                            <p>{{ $phamTram }}%</p>
                                        </div>
                                        <div class="card rounded-0 border-0 cardhover2">
                                            <img src="uploads/{{ $item->product->image }}" class="card-img-top"
                                                alt="...">
                                        </div>
                                        <a href="/detail-product/{{ $item->product->slug }}"
                                            class="text-black text-decoration-none">
                                            <h5 class="card-title pt-2">{{ $item->product->name }}</h5>
                                        </a>
                                        <p class="card-text py-1">
                                            <span
                                                class="text-decoration-line-through priceSale">{{ number_format($item->product->price, 0, ',', '.') . 'đ' }}</span>
                                            <span
                                                class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                        </p>
                                        <div class="hoverAddcart btnFormBox">
                                            <add-to-cart-component
                                                :product-data="{{ json_encode($item) }}"></add-to-cart-component>
                                            <button class="btnForm"
                                                onclick="showPopup('{{ $item->product->id }}', '{{ $item->product->name }}', '{{ $item->product->image }}', '{{ $item->product->price }}')"><i
                                                    class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- END SẢN PHẨM GIẢM GIÁ --}}

        <section style="background-color: #f0efef;">
            <div class="container mt-5">
                <div class="row py-1">
                    @foreach ($banners as $item)
                        @if ($item->position === 3)
                            @if ($item->banneImages->isNotEmpty())
                                @foreach ($item->banneImages as $images)
                                    <div class="col-sm-6 py-3">
                                        <img src="{{ asset('uploads/' . $images->image) }}" class="img-fluid"
                                            alt="">
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- START SẢN PHẨM BÁN CHẠY --}}
        <section class="product">
            <div class="container ">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="title_h2">Sản Phẩm Bán Chạy</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productBestSeller as $item)
                            {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                            @php
                                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                $userProductDiscountDefault = $item->productDiscounts
                                    ->where('user_group_id', $userGroup)
                                    ->first();
                                //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                            @endphp
                            <div class="item">
                                @php
                                    if ($userProductDiscountDefault) {
                                        $phamTram = ceil(
                                            (($item->price - $userProductDiscountDefault->price) / $item->price) * 100,
                                        );
                                    }
                                @endphp
                                <div class="position-relative">
                                    <div class="cardhover">
                                        @if (isset($userProductDiscountDefault))
                                            <div class="productSale">
                                                <p>{{ $phamTram }}%</p>
                                            </div>
                                        @endif
                                        <div class="card rounded-0 border-0 cardhover2">
                                            <img src="uploads/{{ $item->image }}" class="card-img-top" alt="...">
                                        </div>
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                        </a>
                                        <p class="card-text py-1">
                                            @if ($user && $user->userGroup)
                                                @php
                                                    $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                    $userProductDiscount = $item->productDiscounts
                                                        ->where('user_group_id', $userGroup)
                                                        ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                                @endphp
                                                @if ($userProductDiscount)
                                                    {{-- Giá mặc định --}}
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                    {{-- Giá theo xếp hạng --}}
                                                    <span
                                                        class="price">{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</span>
                                                @else
                                                    {{-- Giá mặc định --}}
                                                    <span
                                                        class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                @endif
                                            @else
                                                @if ($userProductDiscountDefault)
                                                    {{-- Giá mặc định --}}
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                    {{-- Giá theo xếp hạng --}}
                                                    <span
                                                        class="price">{{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                @endif
                                            @endif

                                            <br>
                                            <span
                                                class="spanBestSeller"><strong>({{ $item->orderProduct->sum('quantity') }})</strong>
                                                Lượt
                                                đặt mua</span>
                                        </p>
                                        <div class="hoverAddcart btnFormBox">
                                            <add-to-cart-component
                                                :product-data="{{ json_encode($item) }}"></add-to-cart-component>
                                            <button class="btnForm"
                                                onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}')"><i
                                                    class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- END SẢN PHẨM BÁN CHẠY --}}

        {{-- START SẢN PHẨM LƯỢT XEM --}}
        <section class="product">
            <div class="container ">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="title_h2">Sản Phẩm Nhiều Lượt Xem</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productView as $item)
                            {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                            @php
                                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                $userProductDiscountDefault = $item->productDiscounts
                                    ->where('user_group_id', $userGroup)
                                    ->first();
                                //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                            @endphp
                            <div class="item">
                                @php
                                    if ($userProductDiscountDefault) {
                                        $phamTram = ceil(
                                            (($item->price - $userProductDiscountDefault->price) / $item->price) * 100,
                                        );
                                    }
                                @endphp
                                <div class="position-relative">
                                    <div class="cardhover">
                                        @if (isset($userProductDiscountDefault))
                                            <div class="productSale">
                                                <p>{{ $phamTram }}%</p>
                                            </div>
                                        @endif
                                        <div class="card rounded-0 border-0 cardhover2">
                                            <img src="uploads/{{ $item->image }}" class="card-img-top" alt="...">
                                        </div>
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                        </a>
                                        <p class="card-text py-1">
                                            @if ($user && $user->userGroup)
                                                @php

                                                    $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                    $userProductDiscount = $item->productDiscounts
                                                        ->where('user_group_id', $userGroup)
                                                        ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                                @endphp

                                                @if ($userProductDiscount)
                                                    {{-- Giá mặc định --}}
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                    {{-- Giá theo xếp hạng --}}
                                                    <span
                                                        class="price">{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                @endif
                                            @else
                                                @if ($userProductDiscountDefault)
                                                    {{-- Giá mặc định --}}
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                    {{-- Giá theo xếp hạng --}}
                                                    <span
                                                        class="price">{{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                @endif
                                            @endif
                                            <br>
                                            <span><strong>({{ $item->view }})</strong> Lượt xem</span>
                                        </p>
                                        <div class="hoverAddcart btnFormBox">
                                            <add-to-cart-component
                                                :product-data="{{ json_encode($item) }}"></add-to-cart-component>
                                            <button class="btnForm"
                                                onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}')"><i
                                                    class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        {{-- END SẢN PHẨM LƯỢT XEM --}}

        {{-- START SẢN PHẨM THEO DANH MỤC --}}
        @foreach ($categories as $category)
            @if ($category->status == 1)
                <section class="product">
                    <div class="container ">
                        <div class="row text-center" data-aos="fade-right" data-aos-offset="300"
                            data-aos-easing="ease-in-sine">
                            <div class="title">
                                <h2 class="title_h2">{{ $category->name }}</h2>
                            </div>
                            @if (isset($productByCategory[$category->id]) && count($productByCategory[$category->id]) > 0)
                                <div class="owl-carousel owl-theme">
                                    @foreach ($productByCategory[$category->id] as $item)
                                        {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                                        @php
                                            $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                            $userProductDiscountDefault = $item->productDiscounts
                                                ->where('user_group_id', $userGroup)
                                                ->first();
                                            //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                                        @endphp
                                        <div class="item">
                                            @php
                                                if ($userProductDiscountDefault) {
                                                    $phamTram = ceil(
                                                        (($item->price - $userProductDiscountDefault->price) /
                                                            $item->price) *
                                                            100,
                                                    );
                                                }
                                            @endphp
                                            <div class="cardhover">
                                                @if (isset($userProductDiscountDefault))
                                                    <div class="productSale">
                                                        <p>{{ $phamTram }}%</p>
                                                    </div>
                                                @endif
                                                <div class="card rounded-0 border-0 cardhover2">
                                                    <img src="uploads/{{ $item->image }}" class="card-img-top"
                                                        alt="...">
                                                </div>
                                                <a href="/detail-product/{{ $item->slug }}"
                                                    class="text-black text-decoration-none">
                                                    <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                                </a>
                                                <p class="card-text py-1">
                                                    @if ($user && $user->userGroup)
                                                        @php

                                                            $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                            $userProductDiscount = $item->productDiscounts
                                                                ->where('user_group_id', $userGroup)
                                                                ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                                        @endphp

                                                        @if ($userProductDiscount)
                                                            {{-- Giá mặc định --}}
                                                            <span
                                                                class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                            {{-- Giá theo xếp hạng --}}
                                                            <span
                                                                class="price">{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</span>
                                                        @else
                                                            <span
                                                                class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                        @endif
                                                    @else
                                                        @if ($userProductDiscountDefault)
                                                            {{-- Giá mặc định --}}
                                                            <span
                                                                class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                            {{-- Giá theo xếp hạng --}}
                                                            <span
                                                                class="price">{{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</span>
                                                        @else
                                                            <span
                                                                class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                        @endif
                                                    @endif
                                                    <br>
                                                </p>
                                                <div class="hoverAddcart btnFormBox">
                                                    <add-to-cart-component
                                                        :product-data="{{ json_encode($item) }}"></add-to-cart-component>
                                                    <button class="btnForm"
                                                        onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}')"><i
                                                            class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif

        @endforeach
        {{-- END SẢN PHẨM THEO DANH MỤC --}}

        {{-- START SẢN PHẨM HẾT HÀNG --}}
        @if ($soldout && count($soldout) > 0)
            <section class="product">
                <div class="container ">
                    <div class="row text-center" data-aos="fade-right" data-aos-offset="300"
                        data-aos-easing="ease-in-sine">
                        <div class="title">
                            <h2 class="title_h2">Sản Phẩm Bán Hết</h2>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($soldout as $item)
                                <div class="item">
                                    <div class=" position-relative ">
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <div class="cardhover">
                                                <div class="soldout">
                                                    <div class="card rounded-0 border-0 cardhover2">
                                                        <img src="uploads/{{ $item->image }}"
                                                            class="card-img-top grayscale" alt="...">
                                                    </div>
                                                    <h5 class="card-title pt-2">Hết hàng</h5>
                                                    <div class="soldout_item">
                                                        <img src="uploads/soldouts.webp" class="card-img-top grayscale"
                                                            alt="...">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- END SẢN PHẨM HẾT HÀNG --}}


        <section class="blog">
            <div class="container">
                <div class="row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                    <div class="title">
                        <h2 class="title_h2">Bài Viết </h2>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card mb-3 border-0 cardBlog">
                            <a href="" class="text-decoration-none text-black">
                                <img src="uploads/baiviet-1.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bài viết</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. </p>
                                    <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card mb-3 border-0 cardBlog">
                            <a href="" class="text-decoration-none text-black">
                                <img src="uploads/baiviet-2.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bài viết</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. </p>
                                    <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card mb-3 border-0 cardBlog">
                            <a href="" class="text-decoration-none text-black">
                                <img src="uploads/baiviet-3.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bài viết</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. </p>
                                    <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card mb-3 border-0 cardBlog">
                            <a href="" class="text-decoration-none text-black">
                                <img src="uploads/baiviet-3.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Bài viết</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. </p>
                                    <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div id="myModal" class="modal">
            <div class="modalBox">
                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close my-0">&times;</span>
                    <div id="modalProductDetails"></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function sweetAlertAddCart() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Thêm vào giỏ hàng thành công",
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

    <script>
        function showPopup(id, name, image, price, user, userDiscountPrice, defaultDiscountPrice) {
            var modal = document.getElementById("myModal");
            modal.style.display = "block";

            var modalProductDetails = document.getElementById("modalProductDetails");

            var priceDisplay = 0;

            // Lấy thông tin về giá giảm dành cho người dùng đang đăng nhập
            if (user) {
                if (userDiscountPrice) {
                    priceDisplay = `
            <h2 class="priceDetail">${new Intl.NumberFormat().format(userDiscountPrice)}đ</h2>
            <span class="text-decoration-line-through priceSale">${new Intl.NumberFormat().format(price)}đ</span>`;
                } else {
                    priceDisplay = `<h2 class="priceDetail">${new Intl.NumberFormat().format(price)}đ</h2>`;
                }
            } else {
                if (defaultDiscountPrice) {
                    priceDisplay = `
            <h2 class="priceDetail">${new Intl.NumberFormat().format(defaultDiscountPrice)}đ</h2>
            <span class="text-decoration-line-through priceSale">${new Intl.NumberFormat().format(price)}đ</span>`;
                } else {
                    priceDisplay = `<h2 class="priceDetail">${new Intl.NumberFormat().format(price)}đ</h2>`;
                }
            }


            var content = `
                <div class="row">
                    <div class="col-sm-6">
                        <div class="detailImg">
                            <img src="/uploads/${image}" class="img-fluid" id="image_box">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2 class="">${name}</h2>
                        <p class="card-text">${priceDisplay}</p>
                        <div class="popupbtn">
                            <div>
                                <div class="input-groupDetail pt-2">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" onclick="decrementQuantity()">
                                            <a class="text-decoration-none text-black">-</a>
                                        </button>
                                    </span>
                                    <input type="text" class="input-number border" id="quantityInput" value="1" min="1" max="10" onchange="validateQuantity()">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" onclick="incrementQuantity()">
                                            <a class="text-decoration-none text-black">+</a>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <form action="/add-to-cart" method="post">
                                @csrf
                                <input type="hidden" name="id" value="${id}">
                                <input type="hidden" name="name" value="${name}">
                                <input type="hidden" name="image" value="${image}">
                                <input type="hidden" name="price" value="${price}">
                                <input type="hidden" id="quantityHidden" name="quantity" value="1">
                                <button type="submit" class="buttonDetail"><span>Thêm vào giỏ</span></button>
                            </form>

                        </div>
                        <div class="btnCartHome_box">
                            <form action="/buy-now" method="post" class="ms-3">
                                @csrf
                                <input type="hidden" name="id" value="${id}">
                                <input type="hidden" name="name" value="${name}">
                                <input type="hidden" name="image" value="${image}">
                                <input type="hidden" name="price" value="${price}">
                                <input type="hidden" id="quantityHiddenBuyNow" name="quantity" value="1">
                                <button type="submit" class="btnCartHome"><span>Mua ngay</span></button>
                            </form>
                        <div>
                    </div>
                </div>
            `;

            modalProductDetails.innerHTML = content;


            // lấy ra modael id
            var modal = document.getElementById("myModal");

            // Lấy phần tử <span> để đóng phương thức
            var span = document.getElementsByClassName("close")[0];

            // khi user click <span> (x), đóng modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            //khi user click ở ngoài modal vẫn đóng đucợ
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        }

        function incrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var quantityHidden = document.getElementById('quantityHidden');
            var quantityHiddenBuyNow = document.getElementById('quantityHiddenBuyNow');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            quantityHidden.value = quantityInput.value; // Cập nhật giá trị của trường ẩn
            quantityHiddenBuyNow.value = quantityInput.value; // Cập nhật giá trị của trường ẩn

        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var quantityHidden = document.getElementById('quantityHidden');
            var quantityHiddenBuyNow = document.getElementById('quantityHiddenBuyNow');

            // Nếu giá trị hiện tại của trường nhập liệu lớn hơn 1
            if (parseInt(quantityInput.value) > 1) {
                // Thì giá trị đó sẽ được giảm đi 1
                quantityInput.value = parseInt(quantityInput.value) - 1;
                quantityHidden.value = quantityInput.value; // Cập nhật giá trị của trường ẩn
                quantityHiddenBuyNow.value = quantityInput.value; // Cập nhật giá trị của trường ẩn

            }
        }

        function validateQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var quantityHidden = document.getElementById('quantityHidden');
            var quantityHiddenBuyNow = document.getElementById('quantityHiddenBuyNow');

            if (parseInt(quantityInput.value) < 1) {
                quantityInput.value = 1;
            }
            quantityHidden.value = quantityInput.value; // Cập nhật giá trị của trường ẩn
            quantityHiddenBuyNow.value = quantityInput.value; // Cập nhật giá trị của trường ẩn

        }

        // Sự kiện thay đổi trên trường input
        document.getElementById('quantityInput').addEventListener('change', function() {
            validateQuantity();
        });
    </script>

@endsection
