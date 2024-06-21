@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa nhóm khách hàng')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center formAdminAlert">
            <h3 class="title-page ">
                Chỉnh sửa nhóm khách hàng
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.userGroup') }}">Quay lại</a>
        </div>

        <form action="{{ route('admin.userGroupUpdate', $userGroup->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" value="{{ $userGroup->name }}">
            </div>
        </form>
    </div>

@endsection
