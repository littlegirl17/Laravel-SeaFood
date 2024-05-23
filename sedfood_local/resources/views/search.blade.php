@extends('layout.layout')
@Section('title', 'Tìm kiếm')
@Section('content')

    <section class="product">
        <div class="container mt-5">
            <p>Tìm thấy {{ count($products) }} kết quả với từ khóa <i>"{{ $search }}"...</i></p>
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3 col-sm-6 col-6 p-0 position-relative  px-3">
                        <div class="cardhover">
                            <a href="/detail-product/{{ $item->slug }}" class="text-black text-decoration-none text-center">
                                <div class="card rounded-0 border-0 cardhover2">
                                    <img src="storage/uploads/{{ $item->image }}" class="card-img-top" alt="...">
                                </div>
                                <h5 class="card-title pt-2">{{ $item->name }}</h5>
                                <p class="card-text py-1">
                                    <span class="price">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span> <br>
                                </p>
                                <div class="hoverAddcart">
                                    <form action="/add-to-cart" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="name" value="{{ $item->name }}">
                                        <input type="hidden" name="image" value="{{ $item->image }}">
                                        <input type="hidden" name="price" value="{{ $item->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btnForm" type="submit" onclick="sweetAlertAddCart()"> Thêm giỏ
                                            hàng</button>
                                    </form>
                                </div>
                            </a>
                        </div>
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
