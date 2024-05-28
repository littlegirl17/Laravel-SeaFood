@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Bình luận')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Bình luận
        </h3>
        <div class="d-flex justify-content-between">
            <form action="{{ route('searchComment') }}" method="GET">
                <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
                <button type="submit" class="btn-coupon">Tìm kiếm</button>
            </form>
            <button class="btnFormAdd mb-3">
                <a href="#" class="text-decoration-none ">Thêm</a>
            </button>
        </div>
        <table class="table pt-3">
            <thead>
                <tr class="">
                    <th class=" py-2">Người bình luận</th>
                    <th class=" py-2">Sản phẩm</th>
                    <th class=" py-2">Nội dung</th>
                    <th class=" py-2">Trạng thái</th>
                    <th class=" py-2">Hành động</th>
                </tr>
            </thead>

            <tbody class="">
                @foreach ($comments as $item)
                    <tr class="">
                        <td class="nameAdmin">
                            <p>{{ $item->user->name }}</p>
                        </td>
                        <td class="">{{ $item->product->name }}</td>
                        <td class="">{{ $item->content }}</td>
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
                        <td class="actionAdmin">
                            <a href="" class="text-decoration-none px-2"><img
                                    src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new"
                                    style="width:35px;height:35px; object-fit:cover;" /></a>
                            <a href="" class="text-decoration-none "><i class="fa-solid fa-trash"
                                    style="color: #ff0505; font-size: 25px;  "></i></a>
                        </td>
                    </tr>
                @endforeach
                {{ $comments->links() }}
            </tbody>
        </table>
    </div>

@endsection
