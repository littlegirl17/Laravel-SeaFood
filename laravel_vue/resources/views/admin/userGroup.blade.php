@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Nhóm khách hàng')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Nhóm khách hàng
        </h3>
        @if (session('danger'))
            <div id="alert-message" class="alert alert-danger py-2">{{ session('danger') }}</div>
        @endif
        <div class="d-flex justify-content-between  align-items-center">
            {{-- <form action="{{ route('searchCategory') }}" method="GET">
                <input class="inputSearch_Admin" name="search" placeholder="Nhập từ khóa tìm kiếm" type="search">
                <button type="submit" class="btn-coupon">Tìm kiếm</button>
            </form> --}}

        </div>
        <form id="submitFormAdmin" method="">
            @csrf
            <div class="buttonProductForm">
                <button class="btn btnF1">
                    <a href="{{ route('admin.userGroupAdd') }}" class="text-decoration-none text-light"><i
                            class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo Nhóm khách hàng</a>
                </button>
                {{-- <button class="btn btnF2" type="button"
                    onclick="submitForm('{{ route('checkboxDeleteUserGroup') }}','post')"><i class="pe-2 fa-solid fa-trash"
                        style="color: #ffffff;"></i>Xóa
                </button>  --}}
            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm khách hàng</h4>
                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class=" py-2"></th>
                            <th class=" py-2">Tên Nhóm khách hàng</th>
                            <th class=" py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($userGroups as $item)
                            <tr class="">
                                <td>
                                    <input type="checkbox" name="userGroup_id[]" id="" value="{{ $item->id }}">
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $item->name }}</p>
                                </td>
                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2"><a
                                                href="{{ route('admin.userGroupEdit', $item['id']) }}"
                                                class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                    style="color: #ffffff;"></i>Sửa
                                                nhóm khách hàng</a></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <nav class="navPhanTrang">
            <ul class="pagination">
                {{-- <li>{{ $categorys->links() }}</li> --}}
            </ul>
        </nav>
    </div>


@endsection
