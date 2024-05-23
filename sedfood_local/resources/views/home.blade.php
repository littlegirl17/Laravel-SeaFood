@extends('layout.layout')
@Section('title', 'SeaFood | website hải sản')
@Section('content')
    <div>
        <div class="container-fluid p-0 bannerMobile">
            <div id="carouselExampleInterval" class="carousel slide" data-aos="fade-right" data-aos-offset="300"
                data-aos-easing="ease-in-sine">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="storage/uploads/banner1.png" class="d-block w-100 imageBanner" alt="...">
                    </div>


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
            <div class="row ">
                <div class="col-md-8 banner1">
                    <div id="carouselExampleInterval" class="carousel slide" data-aos="fade-right" data-aos-offset="300"
                        data-aos-easing="ease-in-sine">
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="storage/uploads/banner1.png" class="d-block w-100 imageBanner" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 banner2">
                    <div class="row m-0">
                        <div class="pb-3">
                            <div class="">
                                <img src="storage/uploads/banner2.png" class="d-block  w-100 " alt="...">
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="">
                                <img src="storage/uploads/banner3.png" class="d-block  w-100 " alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="new ">
            <div class="container ">
                <div class="row text-center " data-aos="fade-right">
                    <div class="title">
                        <h2 class="py-3 my-5 title_h2">DANH MỤC ORGANIC</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($categories as $cate)
                            <div class="">
                                <div class="item owl_category" style="">
                                    <a href="/category/{{ $cate->slug }}" class="text-decoration-none textCategory ">
                                        <img src="storage/uploads/{{ $cate['image'] }}" class="img-new animaCate"
                                            alt="">
                                        <h6 class="text-center">{{ $cate['name'] }}</h6>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- START SẢN PHẨM NỐI BẬT --}}
        <section class="productOutstanding"
            style="background-image: url('storage/uploads/product.png'); background-size: cover; background-position: center; background-repeat: no-repeat; margin-top:40px;">
            <div class="container ">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="py-3 mt-3 title_h2">SẢN PHẨM NỔI BẬT</h2>
                    </div>

                    <div class="owl-carousel owl-theme">
                        @foreach ($productOutstanding as $item)
                            <div class="item">
                                <div class="cardhover">
                                    <a href="/detail-product/{{ $item->slug }}" class="text-black text-decoration-none">
                                        <div class="card rounded-0 border-0 cardhover2">
                                            <img src="storage/uploads/{{ $item->image }}" class="card-img-top"
                                                alt="...">
                                        </div>
                                        <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                        <p class="card-text py-1">
                                            <span class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                            <br>
                                        </p>
                                        <div class="hoverAddcart">
                                            <form action="/add-to-cart" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" name="name" value="{{ $item->name }}">
                                                <input type="hidden" name="image" value="{{ $item->image }}">
                                                <input type="hidden" name="price" value="{{ $item->price }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button class="btnForm" type="submit" onclick="sweetAlertAddCart()">Thêm
                                                    giỏ hàng</button>
                                            </form>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
        {{-- END SẢN PHẨM NỐI BẬT --}}

        <div class="container mt-5" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <div class="card border-0 rounded-0  cardImg ">
                <img src="storage/uploads/banner.png" class="card-img-top w-100" alt="...">
            </div>
        </div>

        {{-- START SẢN PHẨM GIẢM GIÁ --}}
        <section class="product">
            <div class="container">
                <div class="row text-center " data-aos="fade-right" data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="py-3 my-5 title_h2">SẢN PHẨM GIẢM GIÁ</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productDiscount as $item)
                            <div class="item">
                                @php
                                    $phamTram = ceil((($item->price - $item->discount_price) / $item->price) * 100);
                                @endphp

                                <div class="position-relative ">
                                    <div class="cardhover">
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            @if (isset($item->discount_price))
                                                <div class="productSale">
                                                    <p>{{ $phamTram }}%</p>
                                                </div>
                                            @endif
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="storage/uploads/{{ $item->image }}" class="card-img-top"
                                                    alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                            <p class="card-text py-1">
                                                <span
                                                    class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                <span
                                                    class="price">{{ number_format($item->discount_price, 0, ',', '.') . 'đ' }}</span>
                                            </p>
                                            <div class="hoverAddcart">
                                                <form action="/add-to-cart" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                                    <input type="hidden" name="discount_price"
                                                        value="{{ $item->discount_price }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                                </form>
                                            </div>
                                        </a>
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
                    <div class="col-sm-6 py-3">
                        <img src="storage/uploads/bannerItem1.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-sm-6 py-3">
                        <img src="storage/uploads/bannerItem2.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>


        {{-- START SẢN PHẨM BÁN CHẠY --}}
        <section class="product">
            <div class="container ">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="py-3 my-5 title_h2">SẢN PHẨM BÁN CHẠY</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productBestSeller as $item)
                            <div class="item">
                                <div class="position-relative">
                                    <div class="cardhover">
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="storage/uploads/{{ $item->image }}" class="card-img-top"
                                                    alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                            <p class="card-text py-1">
                                                <span
                                                    class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                <br>
                                                <span><strong>({{ $item->orderProduct->sum('quantity') }})</strong> Lượt
                                                    đặt mua</span>
                                            </p>
                                            <div class="hoverAddcart">
                                                <form action="/add-to-cart" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                                </form>
                                            </div>
                                        </a>
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
                        <h2 class="py-3 my-5 title_h2">SẢN PHẨM NHIỀU LƯỢT XEM</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productView as $item)
                            <div class="item">
                                <div class="position-relative">
                                    <div class="cardhover">
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="storage/uploads/{{ $item->image }}" class="card-img-top"
                                                    alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                            <p class="card-text py-1">
                                                <span
                                                    class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                <br>
                                                <span><strong>({{ $item->view }})</strong> Lượt xem</span>
                                            </p>
                                            <div class="hoverAddcart">
                                                <form action="/add-to-cart" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                                </form>
                                            </div>
                                        </a>
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
            <section class="product">
                <div class="container ">
                    <div class="row text-center" data-aos="fade-right" data-aos-offset="300"
                        data-aos-easing="ease-in-sine">
                        <div class="title">
                            <h2 class="py-3 my-5 title_h2">{{ $category->name }}</h2>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($productByCategory[$category->id] as $item)
                                <div class="item">
                                    <div class="cardhover">
                                        <a href="/detail-product/{{ $item->slug }}"
                                            class="text-black text-decoration-none">
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="storage/uploads/{{ $item->image }}" class="card-img-top"
                                                    alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                            <p class="card-text py-1">
                                                <span
                                                    class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                <br>
                                            </p>
                                            <div class="hoverAddcart">
                                                <form action="/add-to-cart" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="image" value="{{ $item->image }}">
                                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button class="btnForm" type="submit"
                                                        onclick="sweetAlertAddCart()">Thêm
                                                        giỏ hàng</button>
                                                </form>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </section>
        @endforeach

        {{-- END SẢN PHẨM THEO DANH MỤC --}}

        {{-- START SẢN PHẨM HẾT HÀNG --}}
        @if ($soldout && count($soldout) > 0)
            <section class="product">
                <div class="container ">
                    <div class="row text-center" data-aos="fade-right" data-aos-offset="300"
                        data-aos-easing="ease-in-sine">
                        <div class="title">
                            <h2 class="py-3 my-5 title_h2">SẢN PHẨM BÁN HẾT</h2>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($soldout as $item)
                                <div class="item">
                                    <div class=" position-relative ">
                                        <div class="cardhover">
                                            <a href="/detail-product/{{ $item->slug }}"
                                                class="text-black text-decoration-none">
                                                <div class="soldout">
                                                    <div class="card rounded-0 border-0 cardhover2">
                                                        <img src="storage/uploads/{{ $item->image }}"
                                                            class="card-img-top grayscale" alt="...">
                                                    </div>

                                                    <h5 class="card-title pt-2">Hết hàng</h5>
                                                    <div class="soldout_item">
                                                        <img src="storage/uploads/soldouts.webp"
                                                            class="card-img-top grayscale" alt="...">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
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
                        <h2 class=" py-3 my-5 title_h2">BÀI VIẾT </h2>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                        <div class="card mb-3 border-0 cardBlog">
                            <a href="" class="text-decoration-none text-black">
                                <img src="storage/uploads/baiviet-1.png" class="card-img-top" alt="...">
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
                                <img src="storage/uploads/baiviet-2.png" class="card-img-top" alt="...">
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
                                <img src="storage/uploads/baiviet-3.png" class="card-img-top" alt="...">
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
                                <img src="storage/uploads/baiviet-3.png" class="card-img-top" alt="...">
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


@endsection
