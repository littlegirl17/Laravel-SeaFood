@extends('layout.layout')
@Section('title','Danh mục')
@Section('content')

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3 col-12">
                <ul class="list-group " style="border: 1px solid #f0efef;">
                    <li class="list-group-item active border-0" aria-current="true" style="background: #0286e7">Danh mục hải sản</li>
                    @foreach ($categories as $item)
                        <li class="list-group-item border-0"><a href="/category/{{$item->slug}}" class="text-decoration-none text-black">{{$item['name']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-sm-9 col-12">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-6 col-6 p-0 position-relative  px-3">
                            <div class="cardhover">
                                <a href="/detail-product/{{$product->slug}}" class="text-black text-decoration-none">
                                    <div class="card rounded-0 border-0 cardhover2">
                                        <img src="{{ asset('img/seafood/'.$product->image) }}" class="card-img-top" alt="...">
                                    </div>
                                    <h5 class="card-title pt-2">{{$product->name}}</h5>
                                    <p class="card-text py-1">
                                        <span class="price">{{$product->price}}đ</span>
                                    </p>
                                    <div class="hoverAddcart">
                                        <form action="/add-to-cart" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value=">id">
                                            <input type="hidden" name="name" value=">name">
                                            <input type="hidden" name="image" value=">image">
                                            <input type="hidden" name="price" value=">price">
                                            <input type="hidden" name="quantity" value="1">
                                            <button class="btnForm" type="submit"> Thêm giỏ hàng</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
