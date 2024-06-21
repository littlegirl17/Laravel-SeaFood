@extends('layout.layout')
@Section('title', 'Đăng ký')
@Section('content')

    <div class="section">
        <div class="container mt-5">

            <div class="row">
                <div class="formUser py-5">
                    <form action="/register" class="formMau" method="post">
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
                        <div class="inputGroup my-3">
                            <input required="" type="password" name="password" class="inputLogin">
                            <label class="user-label">Mật khẩu</label>
                        </div>
                        <button class="btnFormUser">Đăng Ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
