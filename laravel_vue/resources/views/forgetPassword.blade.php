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

            </div>
            <div class="formUser py-5">
                <form action="{{ route('form-forget-passwword') }}" method="post" class="formMau">
                    @csrf
                    <div class="inputGroup my-3">
                        <input type="text" name="email" value="{{ old('email') }}" class="inputLogin">
                        <label class="user-label">email</label>
                    </div>
                    <button class="btnFormUser">Tiếp theo</button>
                </form>
            </div>

        </div>
    </div>

@endsection
