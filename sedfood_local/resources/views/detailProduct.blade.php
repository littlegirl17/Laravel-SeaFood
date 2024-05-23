@extends('layout.layout')
@Section('title', 'Chi tiết')
@Section('content')

    <div class="" style="background-color: #f5f5f5; ">
        <section class="pt-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-9 col-12 pt-5" style="background-color: #fff;">
                        <div class="row ">
                            <div class="col-sm-5 col-12">
                                <div class="detailImg">
                                    <img src="{{ asset('storage/uploads/' . $detail->image) }}" class="img-fluid"
                                        id="image_box">
                                </div>
                                <div class="row">
                                    @foreach ($productImage as $item)
                                        <div class="col-sm-3 mt-3">
                                            <img src="{{ asset('storage/uploads/' . $item->images) }}" class="img-fluid"
                                                onclick="clickChangeImg(this)">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-7 col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h2>{{ $detail->name }}</h2>
                                    <p>({{ $detail->view }}) Lượt xem</p>
                                </div>
                                <span class="badge text-bg-success">Còn hàng</span>
                                <p class="pt-2">Loại | <span class="text-danger ">{{ $detail->category->name }}</span></p>
                                <div class="d-flex align-items-center">
                                    <p class="card-text">
                                        @if (isset($detail->discount_price))
                                            <h2 class="priceDetail ">
                                                {{ number_format($detail->discount_price, 0, ',', '.') . 'đ' }}</h2>
                                            <h4 class="text-decoration-line-through priceSaleDetail ps-3">
                                                {{ number_format($detail->price, 0, ',', '.') . 'đ' }}</h4>
                                        @else
                                            <h2 class="priceDetail ">{{ number_format($detail->price, 0, ',', '.') . 'đ' }}
                                            </h2>
                                        @endif
                                    </p>
                                </div>

                                <div class="input-groupDetail pt-5">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"><a href=""
                                                class="text-decoration-none text-black">-</a></button>
                                    </span>
                                    <input type="text" class="input-number border" value="1" min="1"
                                        max="10">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"><a href=""
                                                class="text-decoration-none text-black">+</a></button>
                                    </span>
                                </div>

                                <div class="py-5">
                                    @if ($detail->quantity > 0)
                                        <form action="/add-to-cart" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $detail->id }}">
                                            <input type="hidden" name="name" value="{{ $detail->name }}">
                                            <input type="hidden" name="image" value="{{ $detail->image }}">
                                            <input type="hidden" name="price" value="{{ $detail->price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="buttonDetail"> <span>Thêm vào giỏ
                                                    hàng</span></button>
                                        </form>
                                    @else
                                        <span class="btnsoldout">Sản Phẩm Hết Hàng</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <ul class="list-group " style="border: 1px solid #f0efef;">
                            <li class="list-group-item active border-0" aria-current="true" style="background: #31629e">Cam
                                kết bán hàng</li>
                            <li class="list-group-item border-0 "><i class="fa-solid fa-tractor pe-3"></i>Hàng từ nông sản
                                nhà vườn</li>
                            <li class="list-group-item border-0"><i class="fa-solid fa-fish-fins pe-3"></i>Hàng từ khai thác
                                thủy hải sản</li>
                            <li class="list-group-item border-0"><i class="fa-solid fa-truck pe-3"></i>Free ship toàn quốc
                                đơn hàng trên 400k</li>
                            <li class="list-group-item border-0"><i class="fa-solid fa-globe pe-3"></i>International
                                shipping not yet available!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5 ">
            <div class="container pt-4" style="background-color: #fff;">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Mô tả sản
                            phẩm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Bình
                            luận</button>
                    </li>
                </ul>
                <div class="tab-content mt-3 mb-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div class="row">
                            <h3 class="pt-3">{{ $detail->name }}</h3>
                            <p class="pt-1">
                                {{ $detail->description }}
                            </p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        @foreach ($productComment as $item)
                            <div class="ps-3">
                                <h6>{{ $item->user->name }}</h6>
                                <p>{{ $item->content }}</p>
                            </div>
                        @endforeach
                        <h4>Bình luận về sản phẩm</h4> <br>
                        @if (Session::has('user'))
                            <form action="/add-comment" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $detail->id }}">
                                <input type="hidden" name="user_id" value="{{ Session::get('user')->id }}">
                                <textarea class="form-control " name="content" aria-label="With textarea" cols="30" rows="4"></textarea>
                                <button class="btn btn-outline-success my-3">Gửi </button>
                            </form>
                        @else
                            <p>Bạn cần đăng nhập trước khi bình luận</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container "style="background-color: #fff;">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="py-3 my-3 title_h2">Có Thể Bạn Quan Tâm</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productRelated as $item)
                            <div class="item">
                                @php
                                    $phamTram = isset($item->discount_price)
                                        ? ceil((($item->price - $item->discount_price) / $item->price) * 100)
                                        : 0;
                                @endphp
                                <div class="position-relative  px-3">
                                    <div class="cardhover">
                                        <a href="/detail/{{ $item->slug }}" class="text-black text-decoration-none">
                                            @if (!empty($phamTram))
                                                <div class="productSale">
                                                    <p>{{ $phamTram }}%</p>
                                                </div>
                                            @endif
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="{{ asset('storage/uploads/' . $item->image) }}"
                                                    class="card-img-top" alt="...">
                                            </div>
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text py-1">
                                                @if (isset($item->discount_price))
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                    <span
                                                        class="price">{{ number_format($item->discount_price, 0, ',', '.') . 'đ' }}</span>
                                                @else
                                                    <span
                                                        class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                                @endif
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
    </div>

    <script>
        function clickChangeImg(element) {
            let imageItem = element.getAttribute(
                'src'
            ); // tham số element nhận tham chiếu tới đối tượng <img> đã được click. // lấy giá trị của thuộc tính src của hình ảnh đã click
            document.getElementById('image_box').setAttribute('src',
                imageItem); //đặt giá trị của thuộc tính src của một thẻ hình ảnh khác có id là image_box
        }
    </script>

@endsection
