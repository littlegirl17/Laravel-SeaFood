@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa nhóm người dùng')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center formAdminAlert">
            <h3 class="title-page ">
                Chỉnh sửa nhóm người dùng
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('administrationGroup') }}">Quay
                lại</a>
        </div>

        <form action="{{ route('administrationGroupEdit', $administrationGroup->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" value="{{ $administrationGroup->name }}">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Thiết lập quền hạn</label>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="dashboard" id=""
                        {{ in_array('dashboard', $permission) ? 'checked' : '' }}>Dashboard
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="banner" id=""
                        {{ in_array('banner', $permission) ? 'checked' : '' }}>Banner
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="category" id=""
                        {{ in_array('category', $permission) ? 'checked' : '' }}>Category
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="product" id=""
                        {{ in_array('product', $permission) ? 'checked' : '' }}>Product
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="coupon" id=""
                        {{ in_array('coupon', $permission) ? 'checked' : '' }}>Coupon
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="order" id=""
                        {{ in_array('order', $permission) ? 'checked' : '' }}>Order
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="user" id=""
                        {{ in_array('user', $permission) ? 'checked' : '' }}>User
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="userGroup" id=""
                        {{ in_array('userGroup', $permission) ? 'checked' : '' }}>UserGroup
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="administration" id=""
                        {{ in_array('administration', $permission) ? 'checked' : '' }}>Administration
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="administrationGroup" id=""
                        {{ in_array('administrationGroup', $permission) ? 'checked' : '' }}>AdministrationGroup
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="comment" id=""
                        {{ in_array('comment', $permission) ? 'checked' : '' }}>Comment
                </div>
            </div>
        </form>
    </div>

@endsection
