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
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="dashboard" id="">Dashboard
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="banner" id="">Banner
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="category" id="">Category
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="product" id="">Product
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="coupon" id="">Coupon
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="order" id="">Order
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="user" id="">User
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="userGroup" id="">UserGroup
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="administration"
                        id="">Administration
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="administrationGroup"
                        id="">AdministrationGroup
                </div>
                <div class="">
                    <input type="checkbox" class="" name="permission[]" value="comment" id="">Comment
                </div>
            </div>
        </form>
    </div>

@endsection
