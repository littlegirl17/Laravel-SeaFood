@extends('layout.layout')
@Section('title', 'Xác minh mã')
@Section('content')

    <div class="section">
        <div class="container mt-5">
            <div class="formMauAlert">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="formUser py-5">
                <form action="{{ route('verify-code') }}" method="post" class="formMau ">
                    @csrf
                    <div class="inputGroup my-3">
                        <input type="text" name="verification_code" class="inputLogin">
                        <label class="user-label">Mã xác nhận</label>
                    </div>
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <button class="btnFormUser">Xác minh</button>
                </form>
            </div>

        </div>
    </div>

@endsection
