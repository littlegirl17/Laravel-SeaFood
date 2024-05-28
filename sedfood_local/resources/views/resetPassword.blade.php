@extends('layout.layout')
@Section('title', 'Đặt lại mật khẩu')
@Section('content')

    <div class="section">
        <div class="container mt-5">
            <div class="formMauAlert">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="formUser py-5">
                <form action="{{ route('reset-password') }}" method="post" class="formMau ">
                    @csrf
                    <div class="inputGroup my-3">
                        <input type="password" name="password" class="inputLogin">
                        <label class="user-label">Mật khẩu mới</label>
                    </div>
                    <div class="inputGroup my-3">
                        <input type="password" name="password_confirmation" class="inputLogin">
                        <label class="user-label">Xác nhận mật khẩu</label>
                    </div>
                    {{-- Trường email này lấy ra tuef sesion với mục đích là để biết bạn đang đặt lại mật khẩu cho email nào --}}
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <button class="btnFormUser">Đặt lại mật khẩu</button>
                </form>
            </div>

        </div>
    </div>

@endsection
