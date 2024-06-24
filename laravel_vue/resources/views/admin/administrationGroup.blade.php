@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Nhóm người dùng')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Nhóm người dùng
        </h3>
        @if (session('danger'))
            <div id="alert-message" class="alert alert-danger py-2">{{ session('danger') }}</div>
        @endif
        <form id="submitFormAdmin" method="">
            @csrf
            <div class="buttonProductForm">
                <button class="btn btnF1">
                    <a href="{{ route('administrationGroupAdd') }}" class="text-decoration-none text-light"><i
                            class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo Nhóm người dùng</a>
                </button>
                <button class="btn btnF2" type="button"
                    onclick="submitForm('{{ route('checkboxDeleteAdministrationGroup') }}','post')"><i
                        class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                </button>

            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm người dùng</h4>
                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class=" py-2"></th>
                            <th class=" py-2">Tên Nhóm người dùng</th>
                            <th class=" py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($administrationGroups as $item)
                            <tr class="">
                                <td>
                                    <input type="checkbox" name="administrationGroup_id[]" id=""
                                        value="{{ $item->id }}">
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $item->name }}</p>
                                </td>
                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2"><a
                                                href="{{ route('administrationGroupEdit', $item['id']) }}"
                                                class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                    style="color: #ffffff;"></i>Sửa
                                                nhóm người dùng</a></button>
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
