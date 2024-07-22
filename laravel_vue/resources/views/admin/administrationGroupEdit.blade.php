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

            <div class="row">
                <div class="col-md-6">
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
                                <input type="checkbox" class="" name="permission[]" value="administration"
                                    id="" {{ in_array('administration', $permissionGroup) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                            <p>Administration</p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                                    id=""
                                    {{ in_array('administrationGroup', $permissionGroup) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                            <p>AdministrationGroup</p>
                        </div>
                        <div class="d-flex">
                            <label class="checkbox-btnGroup">
                                <label for="checkbox"></label>
                                <input type="checkbox" class="" name="permission[]" value="comment"
                                    id="" {{ in_array('comment', $permissionGroup) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                            <p>Comment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Thiết lập quền hạn thêm sửa xóa</label>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="bannerAdd"
                                        id="" {{ in_array('bannerAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="bannerEdit"
                                        id="" {{ in_array('bannerEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="bannerCheckboxDelete" id=""
                                        {{ in_array('bannerCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="categoryAdd"
                                        id="" {{ in_array('categoryAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="categoryEdit"
                                        id="" {{ in_array('categoryEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="categoryCheckboxDelete" id=""
                                        {{ in_array('categoryCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="productAdd"
                                        id="" {{ in_array('productAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="productEdit"
                                        id="" {{ in_array('productEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="productCheckboxDelete" id=""
                                        {{ in_array('productCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="commentAdd"
                                        id="" {{ in_array('commentAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="commentEdit"
                                        id="" {{ in_array('commentEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="commentCheckboxDelete" id=""
                                        {{ in_array('commentCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="couponAdd"
                                        id="" {{ in_array('couponAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="couponEdit"
                                        id="" {{ in_array('couponEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="couponCheckboxDelete" id=""
                                        {{ in_array('couponCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="orderAdd"
                                        id="" {{ in_array('orderAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="orderEdit"
                                        id="" {{ in_array('orderEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="orderCheckboxDelete" id=""
                                        {{ in_array('orderCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userAdd"
                                        id="" {{ in_array('userAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userEdit"
                                        id="" {{ in_array('userEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userCheckboxDelete"
                                        id=""
                                        {{ in_array('userCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="userGroupAdd"
                                        id="" {{ in_array('userGroupAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="userGroupEdit"
                                        id="" {{ in_array('userGroupEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="userGroupCheckboxDelete" id=""
                                        {{ in_array('userGroupCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]" value="adminstrationAdd"
                                        id=""
                                        {{ in_array('adminstrationAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]" value="adminstrationEdit"
                                        id=""
                                        {{ in_array('adminstrationEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationCheckboxDelete" id=""
                                        {{ in_array('adminstrationCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input id="checkbox" type="checkbox" name="permission[]"
                                        value="adminstrationGroupAdd" id=""
                                        {{ in_array('adminstrationGroupAdd', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Thêm</p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupEdit" id=""
                                        {{ in_array('adminstrationGroupEdit', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Sửa </p>
                            </div>
                            <div class="d-flex ps-3">
                                <label class="checkbox-btnGroup">
                                    <label for="checkbox"></label>
                                    <input type="checkbox" class="" name="permission[]"
                                        value="adminstrationGroupCheckboxDelete" id=""
                                        {{ in_array('adminstrationGroupCheckboxDelete', $permissionGroup) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Xóa </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
