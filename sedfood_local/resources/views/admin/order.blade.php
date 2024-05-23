@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Đơn hàng')
@Section('content')
    <div class="container-fluid">

        <h3 class="title-page ">
            Đơn hàng
        </h3>
        <form action="/search" method="GET">
            <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
            <button type="submit" class="btn-coupon">Tìm kiếm</button>
        </form>

        <button class="btnFormAdd mb-3">
            {{-- <a href="{{ route('orderAdd') }}" class="text-decoration-none ">Thêm</a> --}}
        </button>
        <div class="table-responsive">
            <table class="table table-bordered pt-3">
                <thead>
                    <tr class="">
                        <th class="py-2">IDDH</th>
                        <th class="py-2">Khách hàng</th>
                        <th class="py-2">Chi tiết sản phẩm</th>
                        <th class="py-2">Tổng cộng</th>
                        <th class="py-2">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr class="" style="background: #fff">
                            <td class="">{{ $loop->iteration }}</td>
                            <td class=" d-flex flex-column p-0 m-0">
                                <div class="text-start m-0">
                                    <p class="m-0 p-0">Điện thoại: <span>{{ $item->phone }}</span></p>
                                    <p class="m-0 p-0">Tên KH: <strong>{{ $item->name }}</strong></p>
                                </div>
                                <div class="m-0 p-0 text-start">
                                    <p class="m-0 p-0">Địa chỉ:
                                        {{ $item->province . ', ' . $item->district . ', ' . $item->ward }}</p>
                                </div>

                            </td>
                            <td class="">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Hình</th>
                                                <th>SP</th>
                                                <th>Giá</th>
                                                <th>SL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productByOrder[$item->id] as $product)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/uploads/' . $product->product->image) }}"
                                                            alt="{{ $product->product->name }}"
                                                            style="width: 50px; height: 50px; object-fit: cover;">
                                                    </td>
                                                    <th>{{ $product->name }}</th>
                                                    <th>{{ number_format($product->price, 0, ',', ',') }}đ</th>
                                                    <td>{{ $product->quantity }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td class="">
                                <h6>{{ number_format($item->total, 0, ',', ',') }}đ</h6>
                            </td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="" class="text-decoration-none px-2"><img
                                        src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png"
                                        alt="create-new" style="width:35px;height:35px; object-fit:cover;" /></a>
                                <a href="" class="text-decoration-none "><i class="fa-solid fa-trash"
                                        style="color: #ff0505; font-size: 25px;  "></i></a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection
