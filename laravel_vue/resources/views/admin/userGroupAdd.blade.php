@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Thêm nhóm khách hàng')
@Section('content')
    <div class="container-fluid">

        <h3 class="title-page ">
            Thêm nhóm khách hàng
        </h3>
        {{-- hiển thị các thông báo lỗi validation nếu có bất kỳ lỗi nào --}}
        @if ($errors->any())
            <div class="formAdminAlert">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger py-2">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/admin/add-userGroup" method="post" class="formAdmin">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm khách hàng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập danh mục bài viết">
            </div>
        </form>
    </div>

@endsection
