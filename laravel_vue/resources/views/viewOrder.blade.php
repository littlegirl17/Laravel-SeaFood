@extends('layout.layout')
@Section('title', 'don hang')
@Section('content')

    <div class="container mt-5">

        <div class="boxRowOrder">
            {{-- <div class="row mt-3 orderSuccess">
                <div class="orderSuccessItem">
                    <img width="64" height="64" class=""
                        src="https://img.icons8.com/glyph-neue/100/40C057/ok--v1.png" alt="ok--v1" />
                    <p> Đặt hàng thành công
                    </p>
                </div>
            </div> --}}
            <div class="row px-3">
                <div class="" style="border-bottom:0.5px solid #e8e8e8">
                    @foreach ($viewOrderUser as $item)
                        <h3>Order ID: {{ $item->order_code }}</h3>
                        <p>Order date: {{ $item->created_at->format('d/m/Y H:i:s') }}</p>
                    @endforeach
                </div>

            </div>
            <div class="row mt-3 px-3">
                <h4>Thông tin đặt hàng</h4>

                <div class="" style="border-bottom:0.5px solid #e8e8e8">
                    @foreach ($viewOrderUser as $item)
                        <div class="px-4">
                            <p>Người đặt: {{ $item->name }}</p>
                            <p>SĐT: {{ $item->phone }}</p>
                            <p>Địa chỉ:
                                {{ $item->ward . ', ' . $item->district . ', ' . $item->province }}
                            </p>
                            <p>Phương thức thanh toán: {{ $item->getPaymentMethod()[$item->payment] }}</p>
                            <p>Tổng tiền: <strong>{{ number_format($item->total, 0, ',', ',') }}đ</strong></p>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="row mt-3 m-0">
                <h4>Sản phẩm đã đặt</h4>
                <div class="" style="border-bottom:0.5px solid #e8e8e8">

                    <table class="table tableViewOrder">
                        <tbody>
                            @foreach ($viewOrderProduct as $item)
                                <tr class="">
                                    <td class=" px-4 m-0" style="border-style:unset;">
                                        <div class="d-flex"> <img src="uploads/{{ $item->product->image }}" class=""
                                                alt="">

                                            <p class="px-3">{{ $item->name }}</p>
                                        </div>
                                    </td>
                                    <td class="right px-4 m-0" style="border-style:unset;">
                                        <p class="price">
                                            {{ isset($item->price) ? number_format($item->price, 0, ',', ',') : 0 }}đ</p>
                                        <p> số lượng {{ number_format($item->quantity, 0, ',', ',') }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-3 ">
                <div class="col-md-6"></div>
                <div class="col-md-6 d-flex justify-content-end"> <button class="btn rounded-0"
                        style="background-color: #31629e"><a href="/" class="text-decoration-none text-light">Tiếp tục
                            mua sắm</a></button></div>

            </div>
        </div>
    </div>


@endsection
