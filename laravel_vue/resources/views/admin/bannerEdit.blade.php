@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa banner')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center formAdminAlert">
            <h3 class="title-page ">
                Chỉnh sửa banner
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.banner') }}">Quay lại</a>
        </div>

        <form action="{{ route('admin.bannerUpdate', $banner->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên banner</label>
                <input type="text" class="form-control" name="name" value="{{ $banner->name }}">
            </div>
            @foreach ($bannerImages as $item)
                <input type="hidden" name="banner_ids[]" value="{{ $item->id }}">
                <div class="form-group mt-3">
                    <label for="exampleInputFile" class="form-label">Ảnh banner</label>
                    <div class="custom-file">
                        <input type="file" name="image" id="HinhAnh">
                        @if ($item->image)
                            <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                style="width:80px; height:80px; object-fit:cover;">
                        @endif
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" name="title[]" value="{{ $item->title }}">
                </div>
                <div class="form-group mt-3">
                    <label for="title" class="form-label">Thứ tự xuất hiện</label>
                    <input type="text" class="form-control" name="sort_order[]" value="{{ $item->sort_order }}">
                </div>
            @endforeach

            <div class="form-group mt-3">
                <label for="position" class="form-label">Vị trí banner xuất hiện trên trang web</label>
                <select class="form-select" name="position">
                    @foreach ($positionGet as $key => $value)
                        <option value="{{ $key }}" {{ $banner->position == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="title" class="form-label">Trạng thái</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Tắt</option>
                    <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Bật</option>
                </select>
            </div>
        </form>
    </div>

@endsection
