
@extends('admin.layout.layoutAdmin')
@Section('title','Admin|Thêm thành viên')
@Section('content')

<h3 class="title-page ">
    Thêm người dùng
</h3>
<div class="row " style="margin-left: 1100px;">
    <button class="btnFormAdd ">
        <a href="#" class="text-decoration-none ">Lưu</a>
    </button>
</div>
<form action="" method="post" class="formAdmin">

    <div class="form-group mt-3">
        <label for="title" class="form-label">Họ tên</label>
        <input type="text" class="form-control" id="title" aria-describedby="title" >
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label">Tên đăng nhập</label>
        <input type="text" class="form-control" id="username" aria-describedby="username" >
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" aria-describedby="email" >
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label">Tên đăng nhập</label>
        <input type="text" class="form-control" id="username" aria-describedby="username" >
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label">Số điện thoại</label>
        <input type="number" class="form-control" id="phone" aria-describedby="phone" >
    </div>
    <div class="form-group mt-3">
        <label for="description" class="form-label">Quyền quản trị</label>
        <select class="form-select " aria-label="Default select example">
            <option selected>Danh mục</option>
            <option value="1">Thành viên(user)</option>
            <option value="2">Quản trị viên(admin)</option>
        </select>
    </div>
    <div class="form-group mt-3">
        <select class="form-select " aria-label="Default select example">
            <option selected>Trang thái</option>
            <option value="1">Kích hoạt</option>
            <option value="2">Vô hiệu hóa</option>
        </select>
    </div>
</form>
@endsection
