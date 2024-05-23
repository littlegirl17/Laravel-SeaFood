@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa danh mục')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center formAdminAlert">
            <h3 class="title-page ">
                Chỉnh sửa danh mục
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('category') }}">Quay lại</a>
        </div>

        <form action="{{ route('categoryUpdate', $category->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <button class="btnFormAdd ">
                Lưu
            </button>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name"
                    value="{{ $category->name }}">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Slug</label>
                <input type="text" class="form-control" id="convert_slug" name="slug" value="{{ $category->slug }}">
            </div>
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="form-label">Ảnh danh mục</label>
                <div class="custom-file">
                    <input type="file" name="image" id="HinhAnh">
                    @if ($category->image)
                        <img src="{{ asset('storage/uploads/' . $category->image) }}" alt=""
                            style="width:80px; height:80px; object-fit:cover;">
                    @endif
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Thứ tự xuất hiện</label>
                <input type="text" class="form-control" name="sort_order" value="{{ $category->sort_order }}">
            </div>
            <div class="form-group mt-3">
                <label for="title" class="form-label">Trạng thái</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Tắt</option>
                    <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Bật</option>
                </select>
            </div>
        </form>
    </div>

@endsection
