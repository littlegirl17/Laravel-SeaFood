@extends('layout.layout')
@Section('title','Đăng ký')
@Section('content')

<div class="section">
    <div class="container mt-5">

        <div class="row">
            <div class="">
                <form action="/register" class="formMau py-5" method="post">
                    @csrf
                    <h2 class="text-center">ĐĂNG KÝ</h2>
                    <div class="inputGroup my-3">
                        <input required="" type="text" name="email" class="inputLogin">
                        <label class="user-label">Email</label>
                    </div>
                    <div class="inputGroup my-3">
                        <input required="" type="text" name="name" class="inputLogin">
                        <label class="user-label">Họ tên</label>
                    </div>
                    <div class="inputGroup my-3">
                        <input required="" type="text" name="phone" class="inputLogin">
                        <label class="user-label">Số điện thoại</label>
                    </div>

                    <select class="form-select selectForm my-3" name="province" id="province">
                        <option selected disabled>Tỉnh/Thành phố</option>
                    </select>
                    <select class="form-select selectForm my-3" name="district" id="district">
                        <option selected disabled>Quận/Huyện</option>
                    </select>
                    <select class="form-select selectForm my-3" name="ward" id="ward">
                        <option selected disabled>Phường/Xã</option>
                    </select>

                    <div class="inputGroup my-3">
                        <input required="" type="password" name="password" class="inputLogin">
                        <label class="user-label">Mật khẩu</label>
                    </div>
                    <button class="btnForm">Đăng Ký</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
