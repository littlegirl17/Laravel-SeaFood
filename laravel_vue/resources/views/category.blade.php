@extends('layout.layout')
@Section('title', 'Danh mục')
@Section('content')

    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-3 col-12">
                    <ul class="list-group " style="border: 1px solid #f0efef;">
                        <li class="list-group-item active border-0" aria-current="true" style="background: #31629e">Danh mục
                            hải sản</li>
                        @foreach ($categories as $item)
                            <li class="list-group-item border-0"><a href="/category/{{ $item->slug }}"
                                    class="text-decoration-none text-black">{{ $item['name'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-9 col-12">
                    <div class="row ">
                        @foreach ($banners as $item)
                            @if ($item->position === 4)
                                @if ($item->banneImages->isNotEmpty())
                                    @foreach ($item->banneImages as $images)
                                        <div class="col-md-6 col-12 ">
                                            <div class="imageCategory"> <img src="{{ asset('uploads/' . $images->image) }}"
                                                    alt="" class="img-fluid"></div>

                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        @endforeach

                    </div>
                    <div class="row mt-5">
                        <div>
                            <hr>
                        </div>
                        @foreach ($products as $product)
                            {{-- Giá giảm default áp dụng cho user chưa login or login mà chưa có nhóm vào rank đồng bạc vàng --}}
                            @php
                                $userGroup = 1; // ID của nhóm khách hàng "Bình thường (default)", mặc định là 1
                                $userProductDiscountDefault = $product->productDiscounts
                                    ->where('user_group_id', $userGroup)
                                    ->first();
                                //tìm trong bảng productDiscount , có cái user_group_id nào mà =1 thì cho nó show ra
                            @endphp
                            @php
                                if ($userProductDiscountDefault) {
                                    $phamTram = ceil(
                                        (($product->price - $userProductDiscountDefault->price) / $product->price) *
                                            100,
                                    );
                                }
                            @endphp
                            <div class="col-md-4 col-sm-6 col-6 p-3 position-relative  ">
                                <div class="cardhover text-center">
                                    @if (isset($userProductDiscountDefault))
                                        <div class="productSale">
                                            <p>{{ $phamTram }}%</p>
                                        </div>
                                    @endif
                                    <div class="card rounded-0 border-0 cardhover2">
                                        <img src="{{ asset('uploads/' . $product->image) }}" class="card-img-top"
                                            alt="...">
                                    </div>
                                    <a href="/detail-product/{{ $product->slug }}" class="text-black text-decoration-none">
                                        <h5 class="card-title pt-2">{{ $product->name }}</h5>
                                    </a>
                                    <p class="card-text py-1">
                                        @if ($user && $user->userGroup)
                                            @php

                                                $userGroup = $user->userGroup->id; // lấy ID của loại thành viên mà người dùng đang thuộc về, trong bảng user có côt user_group_id
                                                $userProductDiscount = $product->productDiscounts
                                                    ->where('user_group_id', $userGroup)
                                                    ->first(); //;ọc ra chỉ những mức giá giảm giá có user_group_id khớp với $userGroup của người dùng trong bảng PRODUCTDISCOUNT.
                                            @endphp

                                            @if ($userProductDiscount)
                                                {{-- Giá mặc định --}}
                                                <span
                                                    class="text-decoration-line-through priceSale">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                                {{-- Giá theo xếp hạng --}}
                                                <span
                                                    class="price">{{ number_format($userProductDiscount->price, 0, ',', '.') . 'đ' }}</span>
                                            @else
                                                <span
                                                    class="price">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                            @endif
                                        @else
                                            @if ($userProductDiscountDefault)
                                                {{-- Giá mặc định --}}
                                                <span
                                                    class="text-decoration-line-through priceSale">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                                {{-- Giá theo xếp hạng --}}
                                                <span
                                                    class="price">{{ number_format($userProductDiscountDefault->price, 0, ',', '.') . 'đ' }}</span>
                                            @else
                                                <span
                                                    class="price">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                            @endif
                                        @endif
                                    </p>
                                    <div class="hoverAddcart btnFormBox">
                                        <form action="/add-to-cart" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="image" value="{{ $product->image }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">
                                            <input type="hidden" name="discount_price"
                                                value="{{ $product->discount_price }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="btnForm" type="submit"> <i class="fa-solid fa-cart-plus"
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
        </div>
    </section>

@endsection
