@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Thành viên')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Người dùng
        </h3>
        <div class="d-flex justify-content-between">
            <form action="{{ route('searchUser') }}" method="GET">
                <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
                <button type="submit" class="btn-coupon">Tìm kiếm</button>
            </form>
            <button class="btnFormAdd mb-3">
                <a href="{{ route('userAdd') }}" class="text-decoration-none ">Thêm</a>
            </button>
        </div>
        <table class="table pt-3">
            <thead class="">
                <tr>
                    <th class="py-2">Image</th>
                    <th class="py-2">Email</th>
                    <th class="py-2">Quyền</th>
                    <th class="py-2">Trạng thái</th>
                    <th class="py-2">Hành động</th>

                </tr>
            </thead>
            <tbody class="">
                @foreach ($users as $item)
                    <tr class="">
                        <td class=""><img src="{{ asset('storage/uploads/' . $item->image) }}" alt=""
                                style="width: 80px; height: 80px; object-fit: cover;"></td>
                        <td class="">{{ $item->email }}</td>
                        <td class="">{{ $item->role }}</td>
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
                            <a href="{{ route('userEdit', $item->id) }}" class="text-decoration-none px-2"><img
                                    src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new"
                                    style="width:35px;height:35px; object-fit:cover;" /></a>
                            <a href="{{ route('userDelete', $item->id) }}" class="text-decoration-none "><i
                                    class="fa-solid fa-trash" style="color: #ff0505; font-size: 25px;  "></i></a>
                        </td>
                    </tr>
                @endforeach
                {{ $users->links() }}
            </tbody>
        </table>
    </div>

@endsection
