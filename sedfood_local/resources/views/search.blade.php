@extends('layout.layout')
@Section('title', 'Tìm kiếm')
@Section('content')

    <section class="product">
        <div class="container mt-5">
            <p>Tìm thấy {{ count($products) }} kết quả với từ khóa <i>"{{ $search }}"...</i></p>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3 col-sm-6 col-6 p-0 position-relative  px-3">
                        @if ($item->quantity >= 1)
                            <div class="cardhover">
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="storage/uploads/{{ $item->image }}" class="card-img-top" alt="...">
                                </div>
                                <a href="/detail-product/{{ $item->slug }}"
                                    class="text-black text-decoration-none text-center">
                                    <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                </a>
                                <p class="card-text py-1 text-center">
                                    <span class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span> <br>
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
                                                <img src="storage/uploads/{{ $item->image }}"
                                                    class="card-img-top grayscale" alt="...">
                                            </div>
                                            <h5 class="card-title pt-2">Hết hàng</h5>
                                            <div class="soldout_item">
                                                <img src="storage/uploads/soldouts.webp" class="card-img-top grayscale"
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
