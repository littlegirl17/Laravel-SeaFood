@extends('layout.layout')
@Section('title', 'don hang')
@Section('content')

    <div class="container mt-5">

        <div class="boxRowOrder">
            <div class="row mt-3 orderSuccess">
                <div class="orderSuccessItem">
                    <img width="64" height="64" class=""
                        src="https://img.icons8.com/glyph-neue/100/40C057/ok--v1.png" alt="ok--v1" />
                    <p> Đặt hàng thành công
                    </p>
                </div>
            </div>
            <div class="row mt-5 mx-5">
                <div class="titleOrder">
                    <h4>Thông tin đặt hàng</h4>
                </div>
                @foreach ($viewOrderUser as $item)
                    <div class="col-md-12">
                        <p>Mã đơn hàng: <strong>{{ $item->order_code }}</strong></p>
                        <p>Địa chỉ thanh toán:
                            <strong>{{ $item->ward . ', ' . $item->district . ', ' . $item->province }}</strong>
                        </p>
                        <p>Phương thức thanh toán: <strong>{{ $item->getPaymentMethod() }}</strong></p>
                        <p>Tổng tiền: <strong>{{ number_format($item->total, 0, ',', ',') }}đ</strong></p>
                    </div>
                @endforeach

            </div>
            <div class="row mt-3 mx-5">
                <div class="titleOrder">
                    <h4>Sản phẩm đã mua</h4>
                </div>

                <div class="col-md-12">
                    <table class="table">
                        <tbody>
                            @foreach ($viewOrderProduct as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex"> <img src="uploads/{{ $product->product->image }}"
                                                class="imgCart" alt="">

                                            <p class="px-3">{{ $product->name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="price">{{ isset($product->discount_price) ? number_format($product->discount_price, 0, ',', ',') : number_format($product->price, 0, ',', ',') }}đ</span>
                                    </td>
                                    <td>
                                        sô luong {{ number_format($product->quantity, 0, ',', ',') }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-5 mx-5">
                <a href="btn btn-outline-success">Mua thêm sản phẩm khác</a>
            </div>
        </div>
    </div>


@endsection
