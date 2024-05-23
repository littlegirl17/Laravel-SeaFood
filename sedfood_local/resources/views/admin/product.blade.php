@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sản phẩm')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Sản phẩm
        </h3>
        <div class="d-flex justify-content-between  align-items-center">
            <form action="/search" method="GET">
                <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
                <button type="submit" class="btn-coupon">Tìm kiếm</button>
            </form>
            <button class="btnFormAdd ">
                <a href="{{ route('productAdd') }}" class="text-decoration-none ">Thêm</a>
            </button>
        </div>

        <table class="table pt-3">
            <thead class="">
                <tr>
                    <th class=" py-2">Hình ảnh</th>
                    <th class=" py-2">Sản phẩm</th>
                    <th class=" py-2">Danh mục</th>
                    <th class=" py-2">Trạng thái</th>
                    <th class=" py-2">Hành động</th>
                </tr>
            </thead>

            <tbody class="">
                @foreach ($products as $item)
                    <tr class="">
                        <td class="">
                            <img src="{{ asset('storage/uploads/' . $item->image) }}" alt=""
                                style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td class="">{{ $item->name }}</td>
                        <td class="">{{ $item->category->name }}</td>
                        <td class="">
                            @if ($item->status == 0)
                                <img src="https://img.icons8.com/material-rounded/24/FA5252/toggle-off.png" alt="toggle-off"
                                    style="width:25px;height:25px; object-fit:cover;" />
                            @else
                                <div class="">
                                    <img src="https://img.icons8.com/ios-filled/50/40C057/toggle-on.png" alt="toggle-on"
                                        style="width:25px;height:25px; object-fit:cover;" />
                                </div>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('productEdit', $item['id']) }}" class="text-decoration-none px-2"><img
                                    src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new"
                                    style="width:35px;height:35px; object-fit:cover;" /></a>
                            <a href="{{ route('productDelete', $item['id']) }}" class="text-decoration-none "><i
                                    class="fa-solid fa-trash" style="color: #ff0505; font-size: 25px;  "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>

@endsection
