@extends('layout.layout')
@Section('title','Đăng nhập')
@Section('content')


<div class="section">
    <div class="container mt-5">
        <div class="d-flex justify-content-center align-items-center">
            @if ($errors->has('danger'))
                <div class="alert alert-warning" role="alert">
                    {{$errors->first('danger')}}
                </div>
            @endif
        </div>
        <form  action="/login" method="post" class="formMau py-5">
            @csrf
            <h2 class="text-center">ĐĂNG NHẬP</h2>
            <div class="inputGroup my-3">
                <input  type="text" name="name" class="inputLogin" required>
                <label class="user-label">Username</label>
            </div>
            <div class="inputGroup my-3">
                <input  type="password" name="password" class="inputLogin" required>
                <label class="user-label">Password</label>
            </div>
            <button class="btnForm" onclick="sweetAlertLogin()">Đăng nhập</button>
        </form>
    </div>
</div>

@endsection
