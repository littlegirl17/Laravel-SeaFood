@extends('layout.layout')
@Section('title', 'Quên mật khẩu')
@Section('content')


    <div class="section">
        <div class="container mt-5">
            <div class="formMauAlert">
                {{-- hiển thị các thông báo lỗi validation nếu có bất kỳ lỗi nào --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </div>
            <form action="/forgetPassword" method="post" class="formMau py-5">
                {{ csrf_field() }}
                <div class="inputGroup my-3">
                    <input type="text" name="email" value="{{ old('email') }}" class="inputLogin">
                    <label class="user-label">email</label>
                </div>
                <button class="btnForm">Đăng nhập</button>
            </form>
        </div>
    </div>

@endsection
