@extends('layout.layout')
@Section('title', 'Đơn mua')
@section('content')
    <div class="container-account mt-3">
        <div class="row m-0 p-0">
            <div class="col-md-3 col-sm-3 col-12 container-account-left">
                @include('account.menuLeftAccount')
            </div>
            <div class="col-md-9 col-sm-9 col-12 container-account-right" style="background-color: #f0f3fa">
                <form action="">
                    <div class="container-account-right-item">
                        <div class="row">
                            <h4 class="m-0 ps-3">Tất cả đơn hàng đã mua</h4>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            @foreach ($orders as $item)
                                <div class="account_purchase">
                                    <div class="account_purchase_header">
                                        <div class="account_purchase_header_left">
                                            <h5>Mã đơn hàng: {{ $item->order_code }}</h5>
                                        </div>
                                        <div class="account_purchase_header_right">
                                            <p class="account_purchase_header_right_1">Giao hàng thành công</p>
                                            <p class="account_purchase_header_right_2">HOÀN THÀNH</p>
                                        </div>
                                    </div>
                                    @foreach ($orderProduct[$item->id] as $itemOP)
                                        <div class="row pt-3 account_purchase_list_order">
                                            <div class="col-md-2 col-3 account_purchase_list_order_image">
                                                <img src="{{ asset('uploads/' . $itemOP->product->image) }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-md-5 col-5">
                                                <div class="d-flex flex-column">
                                                    <a href="/detail-product/{{ $itemOP->product->slug }}"
                                                        class="text-black text-decoration-none">
                                                        <h5> {{ $itemOP->name }}
                                                        </h5>
                                                    </a>
                                                    <p>x{{ $itemOP->quantity }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-12 price_purchase">
                                                <p class="card-text py-1">
                                                    <span
                                                        class="text-decoration-line-through priceSale">{{ number_format($itemOP->product->price, 0, ',', ',') . 'đ' }}</span>
                                                    {{-- Giá theo xếp hạng --}}
                                                    <span
                                                        class="price">{{ number_format($itemOP->price, 0, ',', ',') . 'đ' }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="row account_purchase_thanhtien">
                                        <div class="col-md-12">
                                            <p class="px-1">Thành tiền: </p>
                                            <h4>{{ number_format($item->total, 0, ',', ',') . 'đ' }}</h4>
                                        </div>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
