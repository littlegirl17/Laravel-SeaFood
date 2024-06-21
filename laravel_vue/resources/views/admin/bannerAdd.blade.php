@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Thêm banner')
@Section('content')
    <div class="container-fluid">

        <h3 class="title-page ">
            Thêm banner
        </h3>
        {{-- hiển thị các thông báo lỗi validation nếu có bất kỳ lỗi nào --}}
        {{-- @if ($errors->any())
            <div class="formAdminAlert">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger py-2">{{ $error }}</div>
                @endforeach
            </div>
        @endif --}}

        <form action="/admin/add-banner" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên banner</label>
                <input type="text" class="form-control" name="name" aria-describedby="title"
                    placeholder="Nhập banner bài viết">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" name="title" aria-describedby="title"
                    placeholder="Nhập banner bài viết">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="label_admin">Ảnh banner</label>
                <div class="custom-file">
                    <input type="file" name="image[]" id="HinhAnh" multiple>
                    <div id="preview"></div>
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="position" class="form-label">Vị trí banner xuất hiện trên trang web</label>
                <select class="form-select" name="position">
                    @foreach ($positionGet as $key => $value)
                        <option value="{{ $key }}">
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Thứ tự xuất hiện</label>
                <input type="number" class="form-control" name="sort_order" id="" aria-describedby=""
                    placeholder="">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Trạng thái</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option selected>Trang thái</option>
                    <option value="1">Kích hoạt</option>
                    <option value="0">Vô hiệu hóa</option>
                </select>
            </div>
        </form>
    </div>

@endsection
