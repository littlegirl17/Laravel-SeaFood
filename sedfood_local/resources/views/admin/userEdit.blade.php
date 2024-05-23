@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin| Sửa thành viên')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Chỉnh sửa người dùng
        </h3>
        {{--  --}}
        <form action="{{ route('userUpdate', $user->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <button class="btnFormAdd ">
                Lưu
            </button>
            <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">data</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">


                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $user->email }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="title" class="form-label">Số điện thoại</label>
                        <input type="number" class="form-control" id="phone" name="phone"
                            value="{{ $user->phone }}">
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" aria-label="Default select example" name="province" id="province">
                            @if ($user->province)
                                <option selected value="{{ $user->province }}">{{ $user->province }}</option>
                            @else
                                <option selected disabled>Tỉnh/Thành phố</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" aria-label="Default select example" name="district" id="district">
                            @if ($user->district)
                                <option selected value="{{ $user->district }}">{{ $user->district }}</option>
                            @else
                                <option selected disabled>Tỉnh/Thành phố</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-select" aria-label="Default select example" name="ward" id="ward">
                            @if ($user->ward)
                                <option selected value="{{ $user->ward }}">{{ $user->ward }}</option>
                            @else
                                <option selected disabled>Tỉnh/Thành phố</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="exampleInputFile" class="label_admin">Ảnh tài khoản
                            <div class="custom-file">
                                <input type="file" name="image" id="HinhAnh">
                                @if ($user->image)
                                    <img src="{{ asset('storage/uploads/' . $user->image) }}" alt=""
                                        style="width:80px; height:80px; object-fit:cover;">
                                @endif
                            </div>
                        </label>
                        <div class="form-group mt-3">
                            <label for="description" class="form-label">Quyền quản trị</label>
                            <select class="form-select " name="role">
                                <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Thành viên</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select class="form-select " name="status">
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Vô hiệu hóa</option>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Kích hoạt</option>
                            </select>
                        </div>
                    </div>
        </form>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
            @if ($errors->any())
                <div class="alert alert-danger py-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mt-3">
                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>

            <div class="form-group mt-3">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group mt-3">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

    </div>

@endsection
