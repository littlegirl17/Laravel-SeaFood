@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin| Sửa thành viên')
@Section('content')

    <div class="container-fluid">

        <h3 class="title-page ">
            Chỉnh sửa người dùng
        </h3>
        {{--  --}}
        <form action="{{ route('administrationUpdate', $administration->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <button class="btnFormAdd ">
                Lưu
            </button>

            <div class="row">
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $administration->name }}">
                </div>
                <div class="form-group mt-3">
                    <label for="description" class="form-label">Nhóm người dùng</label>
                    <select class="form-select " name="admin_group_id">
                        @foreach ($administrationGroups as $item)
                            <option value="{{ $item->id }}"
                                {{ $item->id == $administration->admin_group_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="fullname" name="fullname"
                        value="{{ $administration->fullname }}">
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $administration->email }}">
                </div>


                <div class="form-group mt-3">
                    <label for="title" class="form-label">Image</label>
                    <div class="custom-file">
                        <input type="file" name="image" id="HinhAnh">
                        @if ($administration->image)
                            <img src="{{ asset('uploads/' . $administration->image) }}" alt=""
                                style="width:80px; height:80px; object-fit:cover;">
                        @endif
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="title" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group mt-3">
                    <label for="" class="form-label">Xác nhận mật khẩu </label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <div class="form-group mt-3">
                    <label for="title" class="form-label">Trạng thái</label>
                    <select class="form-select " name="status">
                        <option value="0" {{ $administration->status == 0 ? 'selected' : '' }}>Vô hiệu
                            hóa</option>
                        <option value="1" {{ $administration->status == 1 ? 'selected' : '' }}>Kích hoạt
                        </option>
                    </select>
                </div>
            </div>
    </div>
    </div>


    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
        @if ($errors->any())
            <div id="alert-message" class="alert alert-danger mt-3 py-2">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <div class="form-group mt-3">
            <label for="password" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group mt-3">
            <label for="" class="form-label">Xác nhận lại mật khẩu mới</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

    </div>
    </form>
    </div>

@endsection
