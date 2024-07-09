@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa nhóm người dùng')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between my-3">
            <h3 class="title-page ">
                Chỉnh sửa nhóm người dùng
            </h3>
            <div>
                <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('administrationGroup') }}">Quay
                    lại</a>
            </div>

        </div>

        <form action="{{ route('administrationGroupEdit', $administrationGroup->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm ">
                <button class="btn btnF3">
                    Lưu
                </button>
            </div>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" value="{{ $administrationGroup->name }}">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Thiết lập quền hạn</label>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="banner" id=""
                            {{ in_array('banner', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Banner</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="category" id=""
                            {{ in_array('category', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Category</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="product" id=""
                            {{ in_array('product', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Product</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="coupon" id=""
                            {{ in_array('coupon', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Coupon</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="order" id=""
                            {{ in_array('order', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Order</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="user" id=""
                            {{ in_array('user', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>User</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="userGroup" id=""
                            {{ in_array('userGroup', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>UserGroup</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="administration" id=""
                            {{ in_array('administration', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Administration</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                            id="" {{ in_array('administrationGroup', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>AdministrationGroup</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="comment" id=""
                            {{ in_array('comment', $permissionGroup) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <p>Comment</p>
                </div>
            </div>
        </form>
    </div>

@endsection
