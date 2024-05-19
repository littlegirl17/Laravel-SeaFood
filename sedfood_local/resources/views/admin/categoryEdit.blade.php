@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Sửa danh mục')
@Section('content')


<h3 class="title-page ">
    Chỉnh sửa danh mục
</h3>
<form action="{{ route('categoryUpdate', $category->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
    @csrf
    <button class="btnFormAdd ">
        Lưu
    </button>
    @method('PUT')

    <div class="form-group mt-3">
        <label for="title" class="form-label" >Tên danh mục</label>
        <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name" value="{{$category->name}}">
    </div>
    <div class="form-group mt-3">
        <label for="title" class="form-label" >Slug</label>
        <input type="text" class="form-control" id="convert_slug" name="slug" value="{{$category->slug}}">
    </div>
    <div class="form-group mt-3">
        <label for="exampleInputFile" class="label_admin" >Ảnh danh mục
        <div class="custom-file">
            <input type="file" name="image" id="HinhAnh">
            @if ($category->image)
                <img src="{{asset('img/logo/'.$category->image)}}" alt="" style="width:80px; height:80px; object-fit:cover;">
            @endif
        </div>
    </label>
    </div>
    <select class="form-select mt-3" aria-label="Default select example" name="status">
        <option value="0" {{$category->status == 0 ? 'selected' : ''}}>Tắt</option>
        <option value="1" {{$category->status == 1 ? 'selected' : ''}}>Bật</option>
    </select>

</form>


@endsection
