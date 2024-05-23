@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Danh mục')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Phiếu giảm giá
        </h3>
        <div class="d-flex justify-content-between">
            <form action="/search" method="GET">
                <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
                <button type="submit" class="btn-coupon">Tìm kiếm</button>
            </form>

            <button class="btnFormAdd mb-3">
                <a href="{{ route('admin.couponAdd') }}" class="text-decoration-none ">Thêm</a>
            </button>
        </div>

        <table class="table pt-3">
            <thead class="table-header">
                <tr>
                    <th class="header__item py-2">Tên phiếu giảm giá</th>
                    <th class="header__item py-2">Mã</th>
                    <th class="header__item py-2">Giảm giá</th>
                    <th class="header__item py-2">Hành động</th>
                </tr>

            </thead>
            <tbody class="">
                @foreach ($coupons as $item)
                    <tr class="">
                        <td class="">{{ $item->name_coupon }}</td>
                        <td class="">{{ $item->code }}</td>
                        <td class="">{{ $item->discount }}</td>

                        <td class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('admin.couponEdit', $item['id']) }}" class="text-decoration-none px-2"><img
                                    src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new"
                                    style="width:35px;height:35px; object-fit:cover;" /></a>
                            <a href="{{ route('admin.couponDelete', $item['id']) }}" class="text-decoration-none "><i
                                    class="fa-solid fa-trash" style="color: #ff0505; font-size: 25px;  "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
