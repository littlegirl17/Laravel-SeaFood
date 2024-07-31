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
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="myaccount_image">
                                    <img src="{{ asset('uploads/1.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="myaccount_image_inputfile">
                                    <label for="file-upload" class="custom-file-upload">
                                        Chọn ảnh
                                    </label>
                                    <input type="file" id="file-upload" class="form-control" name="HinhAnh"
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="row account_profile">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tên đăng nhập:</label>
                                    <input type="text" class="form-control" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="email" class="form-control" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Số điện thoại:</label>
                                    <input type="number" class="form-control" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class=" d-flex">
                                    <label class="pe-3" for="">Giới tính:</label>
                                    <div class="form-check d-flex">
                                        <input class="form-check-input" type="radio" name="gender"
                                            id="flexRadioDefault1">
                                        <p class="  pe-3" for="">
                                            Nam </p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="">
                                        <p class=" pe-3 ">
                                            Nữ </p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="">
                                        <p class=" pe-3 ">
                                            Khác </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-3">
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
