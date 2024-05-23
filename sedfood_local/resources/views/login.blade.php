@extends('layout.layout')
@Section('title', 'Đăng nhập')
@Section('content')


    <div class="section">
        <div class="container mt-5">
            <div class="formMauAlert">
                {{-- hiển thị các thông báo lỗi validation nếu có bất kỳ lỗi nào --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger py-2">{{ $error }}</div>
                    @endforeach
                @endif

                @if (session('danger'))
                    <div class="alert alert-danger py-2">{{ session('danger') }}</div>
                @endif
            </div>
            <form action="/login" method="post" class="formMau py-5">
                @csrf
                <h2 class="text-center">ĐĂNG NHẬP</h2>
                <div class="inputGroup my-3">
                    <input type="text" name="name" class="inputLogin">
                    <label class="user-label">Username</label>
                </div>
                <div class="inputGroup my-3">
                    <input type="password" name="password" class="inputLogin">
                    <label class="user-label">Password</label>
                </div>

                <button class="btnForm" onclick="sweetAlertLogin()">Đăng nhập</button>
            </form>

        </div>
    </div>

@endsection
