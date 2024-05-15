@extends('layout.layout')
@Section('title','SeaFood | website hải sản')
@Section('content')
<div>
    <div class="container-fluid p-0" >
        <div id="carouselExampleInterval" class="carousel slide" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                <img src="img/banner/banner1.png" class="d-block w-100 imageBanner" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                <img src="img/banner/banner2.png" class="d-block w-100 imageBanner" alt="...">
                </div>
                <div class="carousel-item">
                <img src="img/banner/banner3.png" class="d-block w-100 imageBanner" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <section class="new ">
        <div class="container ">
            <div class="row text-center " data-aos="fade-right">
                <div class="title">
                    <h2 class="py-3 my-5 title_h2">DANH MỤC ORGANIC</h2>
                </div>
                @foreach ($categories as $cate)
                    <div class="col-md-3 col-sm-6 col-6 " >
                        <a href="/category/{{$cate->slug}}" class="text-decoration-none textCategory ">
                            <img src="img/logo/{{$cate['image']}}" class="img-new animaCate" alt="">
                            <h6>{{$cate['name']}}</h6>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- START SẢN PHẨM NỐI BẬT --}}
    <section class="product">
        <div class="container ">
            <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="title">
                    <h2 class="py-3 my-5 title_h2">SẢN PHẨM NỔI BẬT</h2>
                </div>
                @foreach ($productOutstanding as $item)
                    <div class="col-md-3 col-sm-6 col-6 p-0 position-relative  px-3">
                        <div class="cardhover">

                            <a href="/detail-product/{{$item->slug}}" class="text-black text-decoration-none">
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="img/seafood/{{$item->image}}" class="card-img-top" alt="...">
                                </div>
                                <h5 class="card-title pt-2">{{$item->name}}</h5>
                                <p class="card-text py-1">
                                    <span class="price">{{number_format($item->price, 0, ',', '.').'đ'}}</span>
                                </p>
                                <div class="hoverAddcart">
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="name" value="{{$item->name}}">
                                        <input type="hidden" name="image" value="{{$item->image}}">
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btnForm" type="submit" onclick="sweetAlertAddCart()"> Thêm giỏ hàng</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    {{-- END SẢN PHẨM NỐI BẬT --}}

    <div class="container mt-5" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
        <div class="card border-0 rounded-0  cardImg ">
            <img src="img/banner/banner.png" class="card-img-top" alt="...">
            {{-- <div class="card-img-overlay bg-dark  bg-opacity-25">
                <div class="col-md-7 text_imgfluid">
                    <h1 class="card-title text-black">Organic thiên nhiên tươi xanh</h1>
                    <p class="text-black">
                        Tại đây, chúng tôi không chỉ chú trọng đến việc cung cấp những sản phẩm chất lượng cao mà còn tôn trọng và bảo vệ môi trường. Tất cả những gì chúng tôi làm đều được thực hiện một cách tự nhiên và bền vững, từ quy trình chăm sóc cây trồng cho đến việc thu hoạch và chế biến sản phẩm.
                    </p>
                    <button class="btn btn-success btn_imgfluid">
                        <span>Xem nhiều sản phẩm hơn <i class="fa-solid fa-arrow-right"></i></span>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- START SẢN PHẨM GIẢM GIÁ --}}
    <section class="product" >
        <div class="container">
            <div class="row text-center " data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="title">
                    <h2 class="py-3 my-5 title_h2">SẢN PHẨM GIẢM GIÁ</h2>
                </div>
                @foreach($productDiscount as $item)

                    @php
                        $phamTram = ceil((($item->price - $item->discount_price)/$item->price)*100);
                    @endphp

                    <div class="col-md-3 col-sm-6 col-6  position-relative px-3">
                        <div class="cardhover">
                            <a href="/detail-product/{{$item->slug}}" class="text-black text-decoration-none">
                                <div class="productSale"><p>{{$phamTram}}%</p></div>
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="img/seafood/{{$item->image}}" class="card-img-top" alt="...">
                                </div>
                                <h5 class="card-title pt-2">{{$item->name}}</h5>
                                <p class="card-text py-1">
                                    <span class="text-decoration-line-through priceSale">{{number_format($item->price, 0, ',', '.').'đ'}}</span>
                                    <span class="price">{{number_format($item->discount_price, 0, ',', '.').'đ'}}</span>
                                </p>
                                <div class="hoverAddcart">
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="name" value="{{$item->name}}">
                                        <input type="hidden" name="image" value="{{$item->image}}">
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                        <input type="hidden" name="discount_price" value="{{$item->discount_price}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- END SẢN PHẨM GIẢM GIÁ --}}

    <section style="background-color: #f0efef;">
        <div class="container mt-5">
            <div class="row py-1">
                <div class="col-sm-6 py-3">
                    <img src="img/banner/bannerItem1.png" class="img-fluid" alt="">
                </div>
                <div class="col-sm-6 py-3" >
                    <img src="img/banner/bannerItem2.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- START SẢN PHẨM LƯỢT XEM --}}
    <section class="product">
        <div class="container ">
            <div class="row text-center"  data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                <div class="title">
                    <h2 class="py-3 my-5 title_h2">SẢN PHẨM NHIỀU LƯỢT XEM</h2>
                </div>
                @foreach($productView as $item)
                    <div class="col-md-3 col-sm-6 col-6 p-0 position-relative px-3">
                        <div class="cardhover">
                            <a href="/detail-product/{{$item->slug}}" class="text-black text-decoration-none">
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="img/seafood/{{$item->image}}" class="card-img-top" alt="...">
                                </div>
                                <h5 class="card-title pt-2">{{$item->name}}</h5>
                                <p class="card-text py-1">
                                    <span class="price">{{number_format($item->price, 0, ',', '.').'đ'}}</span> <br>
                                    <span><strong>({{$item->view}})</strong> Lượt xem</span>
                                </p>
                                <div class="hoverAddcart">
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <input type="hidden" name="name" value="{{$item->name}}">
                                        <input type="hidden" name="image" value="{{$item->image}}">
                                        <input type="hidden" name="price" value="{{$item->price}}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- END SẢN PHẨM LƯỢT XEM --}}


    <section class="blog">
        <div class="container">
            <div class="row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                <div class="title">
                    <h2 class=" py-3 my-5 title_h2">BÀI VIẾT </h2>
                </div>
                <div class="col-md-3 col-12">
                    <div class="card mb-3 border-0 cardBlog">
                        <a href="" class="text-decoration-none text-black">
                            <img src="img/blog/baiviet-1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Bài viết</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="card mb-3 border-0 cardBlog">
                        <a href="" class="text-decoration-none text-black">
                            <img src="img/blog/baiviet-2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Bài viết</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="card mb-3 border-0 cardBlog">
                        <a href="" class="text-decoration-none text-black">
                            <img src="img/blog/baiviet-3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Bài viết</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-body-secondary">01-07-2024</small></p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="card mb-3 border-0 cardBlog">
                        <a href="" class="text-decoration-none text-black">
                            <img src="img/blog/baiviet-3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Bài viết</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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
    function sweetAlertAddCart(){
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

