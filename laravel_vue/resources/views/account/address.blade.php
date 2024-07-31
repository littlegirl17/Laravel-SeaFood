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
                        <div class="row pt-3">
                            <h4>Địa chỉ của tôi</h4>
                            <hr>
                            <div class="col-md-4 col-12 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="province"
                                    id="province">
                                    @if (Session::has('user'))
                                        <option value="{{ Session::get('user')->province }}">
                                            {{ Session::get('user')->province }}</option>
                                    @else
                                        <option selected disabled>Tỉnh/Thành phố</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 col-12 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="district"
                                    id="district">
                                    @if (Session::has('user'))
                                        <option selected value="{{ Session::get('user')->district }}">
                                            {{ Session::get('user')->district }}</option>
                                    @else
                                        <option selected disabled>Quận/Huyện</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4 col-12 selectCheckout">
                                <select class="form-select" aria-label="Default select example" name="ward"
                                    id="ward">
                                    @if (Session::has('user'))
                                        <option selected value="{{ Session::get('user')->ward }}">
                                            {{ Session::get('user')->ward }}</option>
                                    @else
                                        <option selected disabled>Phường/Xã</option>
                                    @endif
                                </select>
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
