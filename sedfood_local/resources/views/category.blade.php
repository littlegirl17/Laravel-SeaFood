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
                    <div class="row">
                        @foreach ($products as $product)
                            @php
                                $phamTram = isset($product->discount_price)
                                    ? ceil((($product->price - $product->discount_price) / $product->price) * 100)
                                    : 0;
                            @endphp
                            <div class="col-md-4 col-sm-6 col-6 p-3 position-relative  ">
                                <div class="cardhover text-center">

                                    @if (!empty($phamTram))
                                        <div class="productSale">
                                            <p>{{ $phamTram }}%</p>
                                        </div>
                                    @endif
                                    <div class="card rounded-0 border-0 cardhover2">
                                        <img src="{{ asset('storage/uploads/' . $product->image) }}" class="card-img-top"
                                            alt="...">
                                    </div>
                                    <a href="/detail-product/{{ $product->slug }}" class="text-black text-decoration-none">
                                        <h5 class="card-title pt-2">{{ $product->name }}</h5>
                                    </a>
                                    <p class="card-text py-1">
                                        @if (isset($product->discount_price))
                                            <span
                                                class="text-decoration-line-through priceSale">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
                                            <span
                                                class="price">{{ number_format($product->discount_price, 0, ',', '.') . 'đ' }}</span>
                                        @else
                                            <span
                                                class="price">{{ number_format($product->price, 0, ',', '.') . 'đ' }}</span>
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
