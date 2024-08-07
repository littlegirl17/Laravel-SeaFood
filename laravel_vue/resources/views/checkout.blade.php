@extends('layout.layout')
@Section('title', 'Thanh toan')
@Section('content')


    <div class="container mt-5">
        <form action="/checkout" method="post">
            @csrf
            <div class="row checkout">
                <div class="col-md-6 col-sm-6 col-12 px-3 checkoutbox1">
                    <div class="checkoutRow_1">
                        <h5>Thông tin giao hàng</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" id="" placeholder="Họ và tên"
                                        name="name" value="{{ Session::has('user') ? Session::get('user')->name : '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" class="form-control " id="" placeholder="Email"
                                                name="email"
                                                value="{{ Session::has('user') ? Session::get('user')->email : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="" class="form-label">SĐT</label>
                                            <input type="number" class="form-control" id=""
                                                placeholder="Số điện thoại" name="phone"
                                                value="{{ Session::has('user') ? Session::get('user')->phone : '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <h6>Địa chỉ giao hàng</h6>
                            <div class="col-md-4 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="province"
                                    id="province">
                                    @if (Session::has('user'))
                                        <option selected value="{{ Session::get('user')->province }}">
                                            {{ Session::get('user')->province }}</option>
                                    @else
                                        <option selected disabled>Tỉnh/Thành phố</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="district"
                                    id="district">
                                    @if (Session::has('user'))
                                        <option selected value="{{ Session::get('user')->district }}">
                                            {{ Session::get('user')->district }}</option>
                                    @else
                                        <option selected disabled>Quận/Huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="ward"
                                    id="ward">
                                    @if (Session::has('user'))
                                        <option selected value="{{ Session::get('user')->ward }}">
                                            {{ Session::get('user')->ward }}</option>
                                    @else
                                        <option selected disabled>Phường/Xã</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Lời nhắn</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Lưu ý cho người bán" name="note"
                                        value="{{ Session::has('user') ? Session::get('user')->note : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h6>Phương thức thanh toán</h6>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <img src="{{ asset('uploads/other.svg') }}" alt="" class="mx-3"
                                            style="width: 40px; ">Thanh toán khi giao hàng (COD)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Quý khách có thể thanh toán khi đã nhận được sản phẩm mình đã đặt.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <img src="{{ asset('uploads/cod.svg') }}" alt="" class="mx-3"
                                            style="width: 40px; ">Chuyển khoản qua ngân hàng
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>Quý khách vui lòng ghi nội dung chuyển khoản như sau: Họ và tên + Mã số đơn hàng.
                                        </p>
                                        <span>Ngân hàng MB BANK</span><br>
                                        <span>Tên chủ TK: Huỳnh Kha</span><br>
                                        <span>STK: 0353123771</span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <img src="{{ asset('uploads/vnpay_new.svg') }}" alt="" class="mx-3"
                                            style="width: 40px; ">Thanh toán online qua cổng VNPay
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <img src="{{ asset('uploads/momo.svg') }}" alt="" class="mx-3"
                                            style="width: 40px; "> Ví MoMo
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 ">
                            <a href="" class="text-decoration-none text-black combackCart">Quay lại giỏ hàng</a>
                        </div>
                        <div class="col-md-6 successCheckout">
                            <button type="submit" class="buttonCheckout">Hoàn tất đơn hàng</button>
                        </div>
                    </div>
                </div>
                @php

                @endphp
                <div class="col-md-6 col-sm-6 col-12 bg-body-tertiary checkoutbox2">
                    @if (Session::has('buyNowCart'))
                        @php
                            $buyNowCart = Session::get('buyNowCart');
                            $userProductDiscount = 0;
                            $userProductDiscountDefault = 0;

                            $product = $products->where('id', $buyNowCart['id'])->first();
                            if ($user && $user->userGroup) {
                                $userGroup = $user->userGroup->id;
                                $userProductDiscount = $product->productDiscounts
                                    ->where('user_group_id', $userGroup)
                                    ->first();
                            }

                            $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                            $userProductDiscountDefault = $product->productDiscounts
                                ->where('user_group_id', $userGroup)
                                ->first();

                            if ($userProductDiscount) {
                                $ThanhTien = $userProductDiscount->price;
                            } elseif ($userProductDiscountDefault) {
                                $ThanhTien = $userProductDiscountDefault->price;
                            } else {
                                $ThanhTien = $buyNowCart['price'];
                            }

                            $TongTien = $ThanhTien * $buyNowCart['quantity'];
                        @endphp
                        <div class="row mt-3">
                            <input type="hidden" name="id" value="{{ $buyNowCart['id'] }}">

                            <div class="col-md-3 col-sm-3 imgCheckout">
                                <img src="{{ asset('uploads/' . $buyNowCart['image']) }}" class="rounded-3"
                                    alt="">
                            </div>
                            <div class="col-md-6 col-sm-9">
                                <h5>{{ $buyNowCart['name'] }}</h5>
                                <p>Số lượng: {{ $buyNowCart['quantity'] }}</p>
                            </div>
                            <div class="col-md-3">
                                @if ($user && $user->userGroup)
                                    @if ($userProductDiscount)
                                        <h5>{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</h5>
                                        <span
                                            class="text-decoration-line-through">{{ number_format($buyNowCart['price'], 0, ',', '.') . 'đ' }}</span>
                                    @else
                                        <h5 class="m-0 p-0">{{ number_format($buyNowCart['price'], 0, ',', '.') . 'đ' }}
                                        </h5>
                                    @endif
                                @else
                                    @if ($userProductDiscountDefault)
                                        <h5 class="m-0 p-0">
                                            {{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</h5>
                                        <span
                                            class="text-decoration-line-through">{{ number_format($buyNowCart['price'], 0, ',', '.') . 'đ' }}</span>
                                    @else
                                        <h5 class="m-0 p-0">{{ number_format($buyNowCart['price'], 0, ',', '.') . 'đ' }}
                                        </h5>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        @php
                            $TongTien = 0;
                            $ThanhTien = 0;
                        @endphp
                        {{-- @if (is_array($cart)) --}}
                        @foreach ($cart as $item)
                            {{-- @if (is_array($item)) --}}
                            @php
                                $product = $products->where('id', $item['product_id'])->first();

                                $SoTien = $product ? $product->price : 0; // giá bth chưa có giá giảm

                                if ($user && $user->userGroup) {
                                    $userGroup = $user->userGroup->id; // lấy ra id trong bảng userGroups
                                    $userProductDiscount = $product->productDiscounts
                                        ->where('user_group_id', $userGroup)
                                        ->first(); //check trong bảng productDiscount nếu user_group_id trong bảng(PD) khớp với id trong bảng(UG) hay không, có thì lấy ra

                                    if ($userProductDiscount) {
                                        $SoTien = $userProductDiscount->price; // GIÁ giảm của sản phẩm trong bảng (PD)
                                    }
                                }

                                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                $userProductDiscountDefault = $product->productDiscounts
                                    ->where('user_group_id', $userGroup)
                                    ->first();
                                if ($userProductDiscountDefault) {
                                    $SoTien = $userProductDiscountDefault->price;
                                }

                                $ThanhTien = $SoTien * $item['quantity'];
                                $TongTien += $ThanhTien;
                            @endphp
                            <div class="row mt-3 ">
                                <input type="hidden" name="id" value="{{ $item['product_id'] }}">
                                <div class="col-md-3 col-sm-3 imgCheckout">
                                    <img src="{{ asset('uploads/' . $product->image) }}" class="rounded-3"
                                        alt="">
                                </div>
                                <div class="col-md-6 col-sm-9">
                                    <h5>{{ $product->name }}</h5>
                                    <p>Số lượng: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="m-0 p-0">{{ number_format($ThanhTien, 0, ',', '.') . 'đ' }}</h5>
                                </div>
                            </div>
                            {{-- @endif --}}
                        @endforeach
                        {{-- @endif --}}
                    @endif
                    <hr>

                    <hr>
                    <div class="d-flex px-3 justify-content-between">
                        <h6>Tạm tính</h6>
                        <h6>{{ number_format($TongTien, 0, ',', '.') . 'đ' }}</h6>
                    </div>
                    @php
                        $final_total = $TongTien; // Biến lưu tổng tiền cuối cùng sau khi áp mã giảm giá
                        $code = '';
                        if (Session::has('coupon')) {
                            foreach (Session::get('coupon') as $key => $cou) {
                                $code = $cou['code'];
                                if (isset($cou['type'])) {
                                    if ($cou['type'] == 0) {
                                        $total_coupon = ($TongTien * $cou['discount']) / 100;
                                        $final_total = $TongTien - $total_coupon;
                                    } else {
                                        $total_coupon = $cou['discount'];
                                        $final_total = $TongTien - $total_coupon;
                                    }
                                }
                            }
                        }
                    @endphp
                    <div class="d-flex px-3 justify-content-between">
                        <h6>Giảm giá</h6>
                        <h6>
                            @if (Session::has('coupon'))
                                @foreach (Session::get('coupon') as $cou)
                                    {{ number_format($cou['discount'], 0, ',', '.') . 'đ' }}
                                @endforeach
                            @endif
                        </h6>
                    </div>
                    <hr>

                    <div class="d-flex px-3 justify-content-between">
                        <h4>Tổng cộng</h4>
                        <h4>{{ number_format($final_total, 0, ',', '.') . 'đ' }}</h4>
                    </div>
                    <input type="hidden" name="total" value="{{ $final_total }}">
                    <input type="hidden" name="coupon_code" value="{{ $code }}">

                </div>
            </div>
        </form>

    </div>

    <script></script>
@endsection
