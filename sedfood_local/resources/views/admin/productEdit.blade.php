@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Sửa sản phẩm')
@Section('content')


<h3 class="title-page ">
    Chỉnh sửa bài viết
</h3>
<div class="row " style="margin-left: 1100px;">
    <button class="btnFormAdd ">
        <a href="#" class="text-decoration-none ">Lưu</a>
    </button>
</div>
<form action="" method="post" class="formAdmin">

    <div class="form-group mt-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" class="form-control" id="title" aria-describedby="title" placeholder="Nhập tiêu đề bài viết">
    </div>
    <div class="form-group mt-3">
        <label for="description" class="form-label">Nội dung chi tiết bài viết</label>
        <textarea class="form-control" id="description" rows="3"></textarea>
    </div>
    <div class="form-group mt-3">
        <label for="exampleInputFile" class="label_admin" >Ảnh bài viêt
        <div class="custom-file">
            <input type="file" name="HinhAnh" id="HinhAnh" >
            <div id="preview"></div>
        </div>
        </label>
    </div>
    <div class="form-group mt-3">
        <label for="description" class="form-label">Chọn danh mục của bài viết</label>
        <select class="form-select " aria-label="Default select example">
            <option selected>Danh mục</option>
            <option value="1">Danh mục 1</option>
            <option value="2">Danh mục 2</option>
        </select>
    </div>
    <div class="form-group mt-3">
        <select class="form-select " aria-label="Default select example">
            <option selected>Trang thái</option>
            <option value="1">Bật</option>
            <option value="2">Tắt</option>
        </select>
    </div>
</form>

<script>
    function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#preview').html('<img src="'+event.target.result+'" width="300" height="auto"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#HinhAnh").change(function () {
    imagePreview(this);
});

</script>

@endsection
