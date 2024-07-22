@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | Sửa banner')
@Section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <h3 class="title-page ">
                Chỉnh sửa banner
            </h3>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{ route('admin.banner') }}">Quay lại</a>
        </div>

        <form action="{{ route('admin.bannerUpdate', $banner->id) }}" method="post" class="formAdmin"
            enctype="multipart/form-data">
            @csrf
            <div class="buttonProductForm ">
                <button class="btn btnF3">
                    Lưu
                </button>
            </div>
            @method('PUT')

            <div class="form-group mt-3">
                <label for="title" class="form-label">Tên banner</label>
                <input type="text" class="form-control" name="name" value="{{ $banner->name }}">
            </div>

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

            <div class="row mt-5">
                <h4 class="title-page ">
                    Thông tin chi tiết banner </h4>
            </div>

            @if (count($bannerImages))

                <div class="row bannnerImagesEdit bannerImagePUT">
                    @foreach ($bannerImages as $key => $item)
                        <div class="col-md-12 ">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <label for="exampleInputFile" class="form-label">Ảnh
                                        banner</label>
                                    <p class="custom-file">
                                        <input type="file" name="image[{{ $key }}]" id="HinhAnh">
                                        <img src="{{ asset('uploads/' . $item->image) }}" alt=""
                                            style="width:80px; height:80px; object-fit:cover;">
                                    </p>
                                </div>
                                <div class="col-md-3 col-sm-12 col-12">
                                    <label for="title" class="form-label">Tiêu
                                        đề</label>
                                    <input type="text" class="form-control" name="title[]" value="{{ $item->title }}">
                                </div>
                                <div class="col-md-2 col-sm-12 col-12">
                                    <label for="title" class="form-label">Thứ tự xuất
                                        hiện</label>
                                    <input type="text" class="form-control" name="sort_order[]"
                                        value="{{ $item->sort_order }}">
                                </div>
                                <div class="col-md-1 col-sm-12 col-12">
                                    <a class="btn btn-danger"
                                        href="{{ route('banner.delete-images', ['id' => $bannerImages[$key]->id]) }}">Xóa</a>
                                    {{-- lấy ra id trong bảng bannerImages --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row m-0 p-0">
                    <button type="button" class="btn btn-primary  add-bannerImage">Thêm hình ảnh</button>
                </div>
            @else
                <div class="row bannnerImagesEdit">
                    <div class="col-md-12 bannerImagePUT">
                        <div class="row banner_row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <label for="exampleInputFile" class="label_admin">Ảnh banner</label>
                                <div class="custom-file">
                                    <input type="file" name="image[]" id="HinhAnh" multiple>
                                    <div id="preview"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12 col-12">
                                <label for="title" class="form-label">Tiêu đề</label>
                                <input type="text" class="form-control" name="title" aria-describedby="title"
                                    placeholder="Nhập tiêu đề hình ảnh ">
                            </div>
                            <div class="col-md-2 col-sm-12 col-12">
                                <label for="title" class="form-label">Thứ tự xuất hiện</label>
                                <input type="number" class="form-control" name="sort_order" id=""
                                    aria-describedby="" placeholder="">
                            </div>
                            <div class="col-md-1 col-sm-12 col-12">
                                <button class="btn btn-danger remove_bannerImages_add" href="">Xóa</button>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 p-0">
                        <button type="button" class="btn btn-primary  add-bannerImage">Thêm hình ảnh</button>
                    </div>
            @endif
        </form>
    </div>

@endsection

@section('addBannerAdmin')
    <script>
        $(document).ready(function() {
            let imageBannerTemplate = `
                                    <div class="col-md-12 ">

            <div class="row banner_row">

                <div class="col-md-6 col-sm-12 col-12">
                            <label for="exampleInputFile" class="form-label">Ảnh banner</label>
                            <div class="custom-file">
                                <input type="file" name="image[]" id="HinhAnh" >
                                <div id="preview"></div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-12">
                            <label for="title" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="title" aria-describedby="title"
                                placeholder="Nhập tiêu đề hình ảnh ">
                        </div>
                        <div class="col-md-2 col-sm-12 col-12">
                            <label for="title" class="form-label">Thứ tự xuất hiện</label>
                            <input type="number" class="form-control" name="sort_order" id="" aria-describedby=""
                                placeholder="">
                        </div>
                        <div class="col-md-1 col-sm-12 col-12">
                            <button class="btn btn-danger remove_bannerImages_add" >Xóa</button>
                        </div>
            </div>
            </div>

`;

            $('.add-bannerImage').click(function() {
                $('.bannerImagePUT').append(imageBannerTemplate.trim());
            });

            $(document).on('click', '.remove_bannerImages_add', function() {
                $(this).closest('.banner_row').remove();
            });
        });
    </script>
@endsection
