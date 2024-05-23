@extends('layout.layout')
@Section('title', 'Giỏ hàng')
@Section('content')

    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-borderless tableMobie">
                <thead>
                    <tr class="text-center headCart">
                        <th class="col-4">Sản phẩm</th>
                        <th class="col-2">Đơn giá</th>
                        <th class="col-3">Số lượng</th>
                        <th class="col-2">Số tiền</th>
                        <th class="col-1">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_array($cart))
                        @php
                            $TongTien = 0;
                            $SoTien = 0;
                        @endphp
                        @foreach ($cart as $item)
                            @if (is_array($item))
                                @php
                                    $SoTien = isset($item['discount_price'])
                                        ? intval($item['discount_price']) * $item['quantity']
                                        : intval($item['price']) * $item['quantity'];
                                    $TongTien += $SoTien;
                                @endphp
                                <tr class="itemcart">

                                    <td class="col-4">
                                        <div class="imgName">
                                            <img src="storage/uploads/{{ $item['image'] }}" class="imgCart" alt="">
                                            <h6 class="ps-2">{{ $item['name'] }}</h6>
                                        </div>
                                    </td>
                                    <td class="col-2">
                                        <p class="card-text text-center">
                                            {{-- <span class="text-decoration-line-through priceSale">{{ number_format($item['discount_price'], 0, ',', ',')  }}đ</span> --}}
                                            <span
                                                class="price">{{ isset($item['discount_price']) ? number_format($item['discount_price'], 0, ',', ',') : number_format($item['price'], 0, ',', ',') }}đ</span>

                                        </p>
                                    </td>
                                    <td class="col-3">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number"><a
                                                        href="{{ route('giam', $item['id']) }}"
                                                        class="text-decoration-none text-black">-</a></button>
                                            </span>
                                            <input type="text" class="input-number border"
                                                value="{{ $item['quantity'] }}" min="1" max="10">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-number"><a
                                                        href="{{ route('tang', $item['id']) }}"
                                                        class="text-decoration-none text-black">+</a></button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="col-2 text-center">
                                        <span class="price ">{{ number_format($SoTien, 0, ',', ',') }}đ</span>
                                    </td>
                                    <td class="col-1">
                                        <span><a href="{{ route('deleteItem', $item['id']) }}"
                                                class="text-black d-flex justify-content-center text-decoration-none"><i
                                                    class="fa-solid fa-trash" style="color: #0286e7;"></i></a></span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <div class="container pb-5">
        <div class="row">
            <div class="col-md-6 col-6 ">
                <button class="btn btn-light rounded-0"><a href="/" class="text-decoration-none text-black">Tiếp tục
                        mua sắm</a></button>
            </div>
            <div class="col-md-6 col-6 deleteAll_cart">
                <button class="btn btn-light rounded-0">
                    <a class="text-decoration-none text-black" onclick="deleteAllCart()">Xóa hết sản phẩm</a>
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <form action="{{ route('coupon') }}" method="post" id="coupon-form">
                    @csrf
                    <div class="row my-4">
                        <div class="col-md-8 col-sm-8 col-12">
                            <input type="text" class="form-control p-2" name="coupon" id="coupon-input"
                                placeholder="Mã giảm giá">
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            @if (Session::get('coupon'))
                                <a class="btn btn-danger" href="{{ route('couponDelete') }}">Xóa mã giảm</a>
                            @else
                                <button type="submit" name="check_coupon" class="btn-coupon"> Áp mã</button>
                            @endif
                        </div>
                    </div>
                </form>
                @if (session('message'))
                    <div id="noneCoupon" class="alert alert-success">{{ session('message') }}</div>
                @elseif (session('error'))
                    <div id="noneCoupon" class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>
            <div class="col-md-6 col-sm-6 col-12 totalAll_cart">
                <div class="totalCart">
                    <h4>Tổng tiền giỏ hàng</h4>
                    <div class="row totalCartIt">

                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2">
                                <span class="">Tạm tính</span><span
                                    class="price text-light ">{{ number_format($TongTien, 0, ',', ',') }}đ</span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span class="">Giảm giá</span>
                                <span class="price text-light ">
                                    @if (Session::has('coupon'))
                                        @foreach (Session::get('coupon') as $key => $cou)
                                            @if (isset($cou['type']))
                                                @if ($cou['type'] == 0)
                                                    <span>
                                                        @php
                                                            $total_coupon = ($TongTien * $cou['discount']) / 100;
                                                            // echo '<p>Tổng giảm:'.number_format($total_coupon, 0, ',', '.').'đ</p>';
                                                        @endphp
                                                    </span>
                                                    <span>{{ number_format($TongTien - $total_coupon, 0, ',', '.') . 'đ' }}</span>(
                                                    {{ $cou['discount'] }}%)
                                                @else
                                                    {{ number_format($cou['discount'], 0, ',', '.') . 'đ' }}
                                                    <span>
                                                        @php
                                                            $total_coupon = $TongTien - $cou['discount'];
                                                        @endphp
                                                    </span>
                                                    {{-- <p>{{number_format($total_coupon, 0, ',', '.').'đ'}}</p> --}}
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </span>
                            </div>
                            <div class="d-flex justify-content-between py-2">
                                <span class="">Thành tiền</span>
                                <span class="price text-light ">
                                    @if (Session::has('coupon'))
                                        @php
                                            if (isset($total_coupon)) {
                                                if ($cou['type'] == 0) {
                                                    $final_total = $TongTien - $total_coupon;
                                                } else {
                                                    $final_total = $TongTien - $cou['discount'];
                                                }
                                            } else {
                                                $final_total = $TongTien;
                                            }
                                        @endphp
                                        <p>{{ number_format($final_total, 0, ',', '.') }}đ</p>
                                    @else
                                        <p>{{ number_format($TongTien, 0, ',', '.') }}đ</p>
                                    @endif
                                </span>
                            </div>
                        </div>

                    </div>
                    <button id="btnCheckout" class="btnCartCheckout mt-3"><a href="/checkout"
                            onclick="return checkCart()">Thanh toán</a></button>

                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteAllCart() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false // Tắt việc tự động áp dụng CSS của thư viện
            });

            // Hiển thị cửa sổ cảnh báo với tiêu đề, nội dung và biểu tượng cảnh báo
            // Cũng hiển thị hai nút xác nhận và hủy
            swalWithBootstrapButtons.fire({
                title: "Bạn có muốn xóa hết sản phẩm?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Tôi có!",
                cancelButtonText: "không!",
                reverseButtons: true
            }).then((result) => { // Thực thi hàm sau khi người dùng nhấn một nút
                if (result.isConfirmed) {
                    // Nếu người dùng xác nhận, chuyển hướng đến trang xóa tất cả
                    window.location.href = "{{ route('deleteAll') }}";
                }
            });
        }
    </script>
    <script>
        setTimeout(function() {
            $('#noneCoupon').fadeOut(); //fadeOut để ẩn một phần tử HTMLs
        }, 3000);
    </script>
    <script>
        function checkCart() {
            var cartEmpy = {{ is_array($cart) && count($cart) > 0 ? 'false' : 'true' }};
            if (cartEmpy) { //nếu nó là true
                alert('Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
                return false; // Ngăn không cho chuyển hướng đến trang thanh toán
            }
            return true;
        }
    </script>
@endsection
