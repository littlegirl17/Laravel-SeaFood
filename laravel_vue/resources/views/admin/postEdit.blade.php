@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa danh mục')
@Section('content')


    <h3 class="title-page ">
        Chỉnh sửa bài viết
    </h3>
    <form action="{{ route('postUpdate', $post->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
        @csrf
        <div class="buttonProductForm ">
            <button class="btn btnF3">
                Lưu
            </button>
        </div>
        @method('PUT')

        <div class="form-group mt-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="name" value="{{ $post->name }}">
        </div>
        <div class="form-group mt-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <select name="" id="" class="form-select mt-3">
                <option value="">1</option>
                <option value="">1</option>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="title" class="form-label">Mô tả</label>
            <textarea name="description" id="" cols="30" rows="10">{{ $post->description }}</textarea>
        </div>
        <div class="form-group mt-3">
            <label for="exampleInputFile" class="label_admin">Ảnh bài viết
                <div class="custom-file">
                    <input type="file" name="image" id="HinhAnh">
                    @if ($post->image)
                        <img src="{{ asset('storage/uploads/' . $post->image) }}" alt=""
                            style="width:80px; height:80px; object-fit:cover;">
                    @endif
                </div>
            </label>
        </div>
        <select class="form-select mt-3" aria-label="Default select example" name="status">
            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Tắt</option>
            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Bật</option>
        </select>

    </form>


@endsection
