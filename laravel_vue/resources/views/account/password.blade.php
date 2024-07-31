@extends('layout.layout')
@Section('title', '')
@section('content')
    <div class="container-account mt-3">
        <div class="row">
            <div class="col-md-3">
                @include('account.menuLeftAccount')
            </div>
            <div class="col-md-9" style="background-color: #f0f3fa">
                <form action="">
                    <div class="px-3 pt-3">
                        <h4>Thay đổi mật khẩu</h4>
                        <hr>
                        <div class="row account_profile">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nhập mật khẩu mới:</label>
                                    <input type="password" class="form-control" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Xác nhận mật khẩu mới:</label>
                                    <input type="password" class="form-control" name="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col-md-2">
                                <button class="btnFormUser">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
