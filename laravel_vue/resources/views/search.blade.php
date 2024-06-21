@extends('layout.layout')
@Section('title', 'Tìm kiếm')
@Section('content')

    <section class="product">
        <div class="container mt-5">
            <p>Tìm thấy {{ count($products) }} kết quả với từ khóa <i>"{{ $search }}"...</i></p>
            <div class="row">
                @foreach ($products as $item)
                    {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                    @php
                        $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                        $userProductDiscountDefault = $item->productDiscounts
                            ->where('user_group_id', $userGroup)
                            ->first();
                        //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                    @endphp
                    @php
                        if ($userProductDiscountDefault) {
                            $phamTram = ceil(
                                (($item->price - $userProductDiscountDefault->price) / $item->price) * 100,
                            );
                        }
                    @endphp
                    <div class="col-md-3 col-sm-6 col-6 p-0 position-relative  px-3">
                        @if ($item->quantity >= 1)
                            <div class="cardhover">
                                @if (isset($userProductDiscountDefault))
                                    <div class="productSale">
                                        <p>{{ $phamTram }}%</p>
                                    </div>
                                @endif
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="uploads/{{ $item->image }}" class="card-img-top" alt="...">
                                </div>
                                <a href="/detail-product/{{ $item->slug }}"
                                    class="text-black text-decoration-none text-center">
                                    <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                </a>
                                <p class="card-text py-1 text-center">
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
                                            <span class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
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
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btnForm" type="submit" onclick="sweetAlertAddCart()"> <i
                                                class="fa-solid fa-cart-plus" style="color: #1f508ds;"></i></button>
                                    </form>
                                    <button class="btnForm"
                                        onclick="showPopup('{{ $item->id }}', '{{ $item->name }}', '{{ $item->image }}', '{{ $item->price }}', '{{ $item->discount_price }}')"><i
                                            class="fa-solid fa-eye" style="color: #1f508ds;"></i></button>
                                </div>

                            </div>
                        @else
                            <div class=" position-relative text-center">
                                <a href="/detail-product/{{ $item->slug }}" class="text-black text-decoration-none">
                                    <div class="cardhover">
                                        <div class="soldout">
                                            <div class="card rounded-0 border-0 cardhover2">
                                                <img src="uploads/{{ $item->image }}" class="card-img-top grayscale"
                                                    alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">Hết hàng</h5>
                                            <div class="soldout_item">
                                                <img src="uploads/soldouts.webp" class="card-img-top grayscale"
                                                    alt="...">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                    </div>
                @endforeach
                {{ $products->appends(['search' => $search])->links() }}
            </div>
        </div>
    </section>

    {{-- <script>
        $(document).ready(function() {
            $('#searchHome').keyup(function() {
                var inputSearch = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {
                        search: inputSearch
                    },
                    success: function(data) {
                        $('#searchResults').html(data);
                    }
                })
            })
        })
    </script> --}}
@endsection
