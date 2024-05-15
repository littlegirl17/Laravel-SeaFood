@extends('layout.layout')
@Section('title','Giỏ hàng')
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
                @if(is_array($cart))
                    @php
                        $TongTien = 0;
                        $SoTien =0;
                    @endphp
                    @foreach ($cart as $item)
                        @if(is_array($item))
                            @php
                                $SoTien = isset($item['discount_price']) ? intval($item['discount_price']) * $item['quantity'] : intval($item['price']) * $item['quantity'];
                                $TongTien += $SoTien;
                            @endphp
                            <tr class="itemcart">

                                <td class="col-4">
                                    <div class="imgName">
                                        <img src="img/seafood/{{ $item['image'] }}" class="imgCart" alt="">
                                        <h6 class="ps-2">{{ $item['name'] }}</h6>
                                    </div>
                                </td>
                                <td class="col-2">
                                    <p class="card-text text-center">
                                        {{-- <span class="text-decoration-line-through priceSale">{{ number_format($item['discount_price'], 0, ',', ',')  }}đ</span> --}}
                                        <span class="price">{{ isset($item['discount_price']) ? number_format($item['discount_price'], 0, ',', ',') : number_format($item['price'], 0, ',', ',') }}đ</span>

                                    </p>
                                </td>
                                <td class="col-3">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" ><a href="{{route('giam', $item['id'])}}" class="text-decoration-none text-black">-</a></button>
                                        </span>
                                        <input type="text" class="input-number border" value="{{ $item['quantity'] }}" min="1" max="10">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-number" ><a href="{{route('tang', $item['id'])}}" class="text-decoration-none text-black">+</a></button>
                                        </span>
                                    </div>
                                </td>
                                <td class="col-2 text-center">
                                    <span class="price ">{{number_format($SoTien, 0, ',', ',')}}đ</span>
                                </td>
                                <td class="col-1">
                                    <span><a href="{{ route('deleteItem', $item['id']) }}" class="text-black d-flex justify-content-center text-decoration-none"><i class="fa-solid fa-trash" style="color: #0286e7;"></i></a></span>
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
            <button class="btn btn-light rounded-0"><a href="/" class="text-decoration-none text-black">Tiếp tục mua sắm</a></button>
        </div>
        <div class="col-md-6 col-6 deleteAll_cart">
            <button class="btn btn-light rounded-0">
                <a  class="text-decoration-none text-black" onclick="deleteAllCart()">Xóa hết sản phẩm</a>
            </button>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-12">
        </div>
        <div class="col-md-6 col-sm-6 col-12 totalAll_cart">
            <div class="totalCart">
                <h4>Tổng tiền giỏ hàng</h4>
                <div class="row totalCartIt">
                    <div class="col-md-6 ">
                        <p >Thành tiền</p>
                        <p >Tổng tiền</p>
                    </div>
                    <div class="col-md-6">
                        <p class="price text-light">{{number_format($TongTien, 0, ',', ',')}}đ</p>
                        <p class="price text-light">{{number_format($TongTien, 0, ',', ',')}}đ</p>
                    </div>
                </div>
                <button class="btnCartCheckout mt-3"><a href="/checkout">Thanh toán</a href=""></button>

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
        }).then((result) => {  // Thực thi hàm sau khi người dùng nhấn một nút
            if (result.isConfirmed) {
                // Nếu người dùng xác nhận, chuyển hướng đến trang xóa tất cả
                window.location.href = "{{ route('deleteAll') }}";
            }
        });
    }
</script>
@endsection

