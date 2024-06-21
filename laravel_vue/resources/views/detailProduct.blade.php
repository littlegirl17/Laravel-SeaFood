@extends('layout.layout')
@Section('title', 'Chi tiết')
@Section('content')
    <div class="" style="background-color: #f5f5f5; ">
        <section class="pt-5">
            <div class="container ">
                <div class="row">
                    <div class="col-md-9 col-12 py-5 px-5" style="background-color: #fff;">
                        <div class="row ">
                            <div class="col-sm-5 col-12">
                                <div class="detailImg">
                                    <img src="{{ asset('uploads/' . $detail->image) }}" class="img-fluid" id="image_box">
                                </div>
                                <div class="row">
                                    @foreach ($detail->product_images as $item)
                                        <div class="col-sm-3 mt-3">
                                            <img src="{{ asset('uploads/' . $item->images) }}" class="img-fluid"
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
                                @if ($detail->quantity >= 1)
                                    <span class="badge text-bg-success">Còn hàng</span>
                                @else
                                    <span class="badge text-bg-danger">Hết hàng</span>
                                @endif
                                <p class="pt-2">Loại | <span class="text-danger ">{{ $detail->category->name }}</span></p>
                                <div class="d-flex align-items-center">
                                    <p class="card-text">
                                        @if ($user && $user->userGroup)
                                            @php

                                                $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                $userProductDiscount = $detail->productDiscounts
                                                    ->where('user_group_id', $userGroup)
                                                    ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                            @endphp

                                            @if ($userProductDiscount)
                                                {{-- Giá mặc định --}}
                                                <h5 class="text-decoration-line-through priceSale">
                                                    {{ number_format($detail->price, 0, ',', '.') . 'đ' }}</h5>
                                                {{-- Giá theo xếp hạng --}}
                                                <h3 class="price">
                                                    {{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</h3>
                                            @else
                                                <h3 class="price">{{ number_format($detail->price, 0, ',', '.') . 'đ' }}
                                                </h3>
                                            @endif
                                        @else
                                            {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                                            @php
                                                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                                $userProductDiscountDefault = $detail->productDiscounts
                                                    ->where('user_group_id', $userGroup)
                                                    ->first();
                                                //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                                            @endphp
                                            @if ($userProductDiscountDefault)
                                                {{-- Giá mặc định --}}
                                                <h5 class="text-decoration-line-through priceSale">
                                                    {{ number_format($detail->price, 0, ',', '.') . 'đ' }}</h5>
                                                {{-- Giá theo xếp hạng --}}
                                                <h3 class="price">
                                                    {{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}
                                                </h3>
                                            @else
                                                <h3 class="price">{{ number_format($detail->price, 0, ',', '.') . 'đ' }}
                                                </h3>
                                            @endif
                                        @endif


                                    </p>
                                </div>

                                <div class="input-groupDetail pt-5">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"
                                            onclick="decrementQuantity()">
                                            <a class="text-decoration-none text-black">-</a>
                                        </button>
                                    </span>
                                    <input type="text" class="input-number border" id="quantityInput" value="1"
                                        min="1" max="10" onchange="validateQuantity()">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"
                                            onclick="incrementQuantity()">
                                            <a class="text-decoration-none text-black">+</a>
                                        </button>
                                    </span>
                                </div>
                                @if ($detail->quantity >= 1)
                                    <div class="py-5 d-flex ">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-12" style="">
                                                <div class="ps-3">
                                                    <form action="/add-to-cart" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $detail->id }}">
                                                        <input type="hidden" name="name" value="{{ $detail->name }}">
                                                        <input type="hidden" name="image" value="{{ $detail->image }}">
                                                        <input type="hidden" name="price" value="{{ $detail->price }}">
                                                        <input type="hidden" id="quantityHidden" name="quantity"
                                                            value="1">
                                                        <button type="submit" class="buttonDetail ">
                                                            <span>Thêm vào giỏ hàng</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-12 ">
                                                <div class="me-5 pt-3">
                                                    <form action="/buy-now" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $detail->id }}">
                                                        <input type="hidden" name="name" value="{{ $detail->name }}">
                                                        <input type="hidden" name="image" value="{{ $detail->image }}">
                                                        <input type="hidden" name="price" value="{{ $detail->price }}">
                                                        <input type="hidden" id="quantityHiddenBuyNow" name="quantity"
                                                            value="1">
                                                        <button type="submit" class="buttonDetail ms-3"> <span>Mua
                                                                ngay</span></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="py-5">
                                        <span class="btnsoldout">Sản Phẩm Hết Hàng</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <ul class="list-group " style="border: 1px solid #f0efef;">
                            <li class="list-group-item active border-0" aria-current="true" style="background: #31629e">
                                Cam
                                kết bán hàng</li>
                            <li class="list-group-item border-0 "><i class="fa-solid fa-tractor pe-3"></i>Hàng từ nông sản
                                nhà vườn</li>
                            <li class="list-group-item border-0"><i class="fa-solid fa-fish-fins pe-3"></i>Hàng từ khai
                                thác
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
            <div class="container py-5 px-5" style="background-color: #fff;">
                <div class="">
                    <h2 style="max-width:250px; border-bottom: 3px solid #31629e">Mô tả sản
                        phẩm</h2>
                </div>
                <div class="">
                    <h4 class="pt-3">{{ $detail->name }}</h4>
                    <p class="pt-1">
                        {!! $detail->description !!}

                    </p>
                </div>
            </div>
        </section>

        <section class="mt-5">
            <div class="container py-5 px-5" style="background-color: #fff;">
                <h2>Bình luận về sản phẩm</h2>
                <div id="appCmt">
                    <div class="ps-3 detailComment" v-for="comment in listComment">
                        <div class="row">
                            <div class="col-sm-1">
                                <img :src="'/uploads/' + comment.user_image" alt="" class="imgComment">
                            </div>
                            <div class="col-sm-11">
                                <p class="m-0">@{{ comment.user_fullname }}</p>
                                <ul class="navbar-nav d-flex flex-row">
                                    <li class="nav-item" v-show="comment.rating>=1"><i
                                            class="fa-solid fa-star small-star" style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating>=2"><i class="fa-solid fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating>=3"><i class="fa-solid fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating>=4"><i class="fa-solid fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating==5"><i class="fa-solid fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating<5"><i class="fa-regular fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating<4"><i class="fa-regular fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating<3"><i class="fa-regular fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating<2"><i class="fa-regular fa-star"
                                            style="color: #FFD43B;"></i></li>
                                    <li class="nav-item" v-show="comment.rating<1"><i class="fa-regular fa-star"
                                            style="color: #FFD43B;"></i></li>
                                </ul>
                                <p class="commentDate m-0">@{{ formatDate(comment.created_at) }}</p>
                                <p class="commentContent m-0">@{{ comment.content }}</p>
                            </div>
                        </div>
                    </div>

                    @if (Session::has('user'))
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" style="z-index: 10000;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Bình luận</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Đánh giá sản phẩm</label>
                                                    <select class="form-control" v-model="rating">
                                                        <option value="5">5 sao</option>
                                                        <option value="4">4 sao</option>
                                                        <option value="3">3 sao</option>
                                                        <option value="2">2 sao</option>
                                                        <option value="1">1 sao</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Nội dung bình luận</label>
                                                    <textarea class="form-control" v-model="content" aria-label="With textarea" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" @click="sendComment()" class="btn btn-primary">Gửi Bình
                                            luận</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Gửi bình luận
                        </button>
                    @else
                        <p>Bạn cần đăng nhập trước khi bình luận</p>
                    @endif
                </div>
        </section>

        <section class="mt-5">
            <div class="container px-5" style="background-color: #fff;">
                <div class="row text-center" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
                    <div class="title">
                        <h2 class="py-3 my-3 title_h2">Có Thể Bạn Quan Tâm</h2>
                    </div>
                    <div class="owl-carousel owl-theme">
                        @foreach ($productRelated as $item)
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
                                <div class="cardhover">
                                    @if (isset($userProductDiscountDefault))
                                        <div class="productSale">
                                            <p>{{ $phamTram }}%</p>
                                        </div>
                                    @endif
                                    <div class="card rounded-0 border-0 cardhover2">
                                        <img src="{{ asset('uploads/' . $item->image) }}" class="" alt="...">
                                    </div>
                                    <a href="/detail-product/{{ $item->slug }}"
                                        class="text-black text-decoration-none">
                                        <h5 class="card-title">{{ $item->name }}</h5>
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
                                    </p>
                                    <div class="hoverAddcart btnFormBox">
                                        <form action="/add-to-cart" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <input type="hidden" name="name" value="{{ $item->name }}">
                                            <input type="hidden" name="image" value="{{ $item->image }}">
                                            <input type="hidden" name="price" value="{{ $item->price }}">
                                            <input type="hidden" name="discount_price"
                                                value="{{ $item->discount_price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="btnForm" type="submit"><i class="fa-solid fa-cart-plus"
                                                    style="color: #1f508ds;"></i></button>
                                        </form>
                                        <button class="btnForm"
                                            onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}', '{{ $item->discount_price }}')"><i
                                                class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
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

    <script>
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

@push('viewFunctionComment')
    <script>
        //khơi tạo 1 instance hay còn gọi là 1 object
        new Vue({
            //gán 1 instance vue vào html với id appCmt
            el: '#appCmt',
            data: {
                listComment: [], //Khi bạn lấy dữ liệu từ API, danh sách các bình luận sẽ được lưu trữ trong biến này.
                content: '', //chứa nội dung của bình luận mới mà người dùng nhập vào.
                rating: 5
            },
            //mounted: nơi bạn muốn load dữ liệu ra => phương thức được gọi khi 1 instance vue được tạo xong
            mounted() {
                this
                    .getComment(); //lấy ra listcomment từ serve //Vai trò: Lấy dữ liệu bình luận ban đầu khi người dùng truy cập trang
            },
            // Định nghĩa các phương thức GET POST PUT DELETE
            methods: {
                //method get comment
                getComment() {
                    axios.get('/api/comment/product/{{ $detail->id }}')
                        .then(response => {
                            this.listComment = response.data.data;
                        })
                        .catch(error => {
                            // Handle error
                        });
                },
                sendComment() {
                    axios.post('/api/comment', {
                            product_id: {{ $detail->id }}, //id đây là id của san phẩm khi gửi lên , để biết cmt này của san pham nào
                            content: this.content, //nội dung của bình luận mà người dùng đã nhập
                            rating: this.rating
                        })
                        .then(response => {
                            // Đóng modal bình luận sau khi gửi thành công
                            document.querySelector('.btn-close').click();
                            // Xóa nội dung và đánh giá của bình luận mới để sẵn sàng cho bình luận tiếp theo
                            this.content = '';
                            this.rating = 5;
                            // Vai trò: Cập nhật danh sách bình luận trên giao diện ngay sau khi người dùng thêm bình luận mới.
                            this.getComment();
                        })
                        .catch(error => {
                            // Handle error
                        });
                },
                formatDate(dateString) {
                    const date = new Date(dateString);
                    return `${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
                }
            }
        });
    </script>
@endpush
