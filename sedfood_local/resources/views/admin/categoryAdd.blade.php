@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Thêm danh mục')
@Section('content')

<h3 class="title-page ">
    Thêm danh mục
</h3>
<form action="/admin/add-category" method="post" class="formAdmin" enctype="multipart/form-data">
    @csrf
    <button class="btnFormAdd ">
        Lưu
    </button>

    <div class="form-group mt-3">
        <label for="title" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" name="name" onkeyup="ChangeToSlug();" id="slug" aria-describedby="title" placeholder="Nhập danh mục bài viết">
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="convert_slug" aria-describedby="title" placeholder="Nhập slug">
    </div>
    <div class="form-group mt-3">
        <label for="exampleInputFile" class="label_admin" >Ảnh danh mục
        <div class="custom-file">
            <input type="file" name="image" id="HinhAnh" >
            <div id="preview"></div>
        </div>
    </label>
    </div>
    <select class="form-select mt-3" aria-label="Default select example" name="status">
        <option selected>Trang thái</option>
        <option value="1">Kích hoạt</option>
        <option value="0">Vô hiệu hóa</option>
    </select>
</form>


@endsection
