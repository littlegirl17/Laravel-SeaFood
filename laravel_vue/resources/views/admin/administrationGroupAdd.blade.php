@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Thêm nhóm người dùng')
@Section('content')
    <div class="container-fluid">

        <h3 class="title-page ">
            Thêm nhóm người dùng
        </h3>
        {{-- hiển thị các thông báo lỗi validation nếu có bất kỳ lỗi nào --}}
        @if ($errors->any())
            <div class="formAdminAlert">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger py-2">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="/admin/add-administrationGroup" method="post" class="formAdmin">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm người dùng">
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Thiết lập quền hạn</label>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input id="checkbox" type="checkbox" name="permission[]" value="banner" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Banner</p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="category" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Category </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="product" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Product </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="coupon" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Coupon </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="order" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Order </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="user" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>User </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="userGroup" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>UserGroup </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="administration" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Administration </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                            id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>AdministrationGroup </p>
                </div>
                <div class="d-flex">
                    <label class="checkbox-btnGroup">
                        <label for="checkbox"></label>
                        <input type="checkbox" class="" name="permission[]" value="comment" id="">
                        <span class="checkmark"></span>
                    </label>
                    <p>Comment </p>
                </div>
            </div>
        </form>
    </div>

@endsection
