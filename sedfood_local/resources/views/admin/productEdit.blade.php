@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Sửa sản phẩm')
@Section('content')


<h3 class="title-page ">
    Chỉnh sửa sản phẩm
</h3>

<form action="{{ route('productUpdate', $product->id) }}" method="post" class="formAdmin" enctype="multipart/form-data">
    @csrf
    <button class="btnFormAdd mb-3">
        Lưu
    </button>
    @method('PUT')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Chung</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Hình ảnh</button>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="form-group mt-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" onkeyup="ChangeToSlug();" id="slug" name="name" value="{{$product->name}}">
            </div>
            <div class="form-group mt-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="convert_slug" name="slug" value="{{$product->slug}}">
            </div>
            <div class="form-group mt-3">
                <label for="description" class="form-label">Nội dung chi tiết sản phẩm</label>
                <textarea class="form-control" id="description" name="description"  rows="3">
                    {{$product->description}}
                </textarea>
            </div>

            <div class="form-group mt-3">
                <label for="description" class="form-label">Chọn danh mục của sản phẩm</label>
                <select class="form-select "  name="category_id">
                    @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{  $item->id == old('category_id', $product->category_id) ? 'selected' : '' }}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Giá giảm sản phẩm</label>
                <input type="number" class="form-control" id="discount_price" name="discount_price" value="{{$product->discount_price}}">
            </div>
            <div class="form-group mt-3">
                <label for="price" class="form-label">Lượt xem</label>
                <input type="number" class="form-control" id="view" name="view" value="{{$product->view}}">
            </div>
            <div class="form-group mt-3">
                <label for="">Nổi bật</label>
                <select class="form-select mt-3" aria-label="Default select example" name="outstanding">
                    <option value="0" {{$product->outstanding == 0 ? 'selected' : ''}}>Tắt</option>
                    <option value="1" {{$product->outstanding == 1 ? 'selected' : ''}}>Bật</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="">Trạng thái</label>
                <select class="form-select mt-3" aria-label="Default select example" name="status">
                    <option value="0" {{$product->status == 0 ? 'selected' : ''}}>Tắt</option>
                    <option value="1" {{$product->status == 1 ? 'selected' : ''}}>Bật</option>
                </select>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="form-group mt-3">
                <label for="exampleInputFile" class="label_admin" >Ảnh bài viêt
                <div class="custom-file">
                    <input type="file" name="image" id="HinhAnh" >
                    @if ($product->image)
                        <img src="{{ asset('img/seafood/'.$product->image)}}" alt="" style="width:80px; height:80px; object-fit:cover;">
                    @endif
                </div>
                </label>
            </div>
            <div class="form-group mt-3">
                @if($productImages->isNotEmpty())
                        <label for="">Hình ảnh sản phẩm</label>
                        <div class="row">
                            @foreach($productImages as $key => $item)
                                <div class="col-12">
                                    <img src="{{ asset('img/seafood/' . $item->images) }}" alt="" class="img-fluid mt-5" style="width:80px; height:80px; object-fit:cover;">
                                    <input type="file" name="images[{{ $key }}]" id="HinhAnh" >
                                </div>
                            @endforeach
                        </div>
                @else
                    @for ($i = 0; $i < 4; $i++)
                        <div class="form-group mt-3">
                            <label for="exampleInputFile" class="label_admin">Ảnh sản phẩm</label>
                            <div class="custom-file">
                                <input type="file" name="images[]" id="HinhAnh">
                                <div id="preview"></div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>

</form>



@endsection
