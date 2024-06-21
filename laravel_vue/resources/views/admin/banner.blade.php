@extends('admin.layout.layoutAdmin')
@Section('title', 'Admin | banner')
@Section('content')

    <div class="container-fluid">

        <div class="searchAdmin">
            <form id="filterFormBanner" action="{{ route('searchBanner') }}" method="GET">
                <div class="row d-flex flex-row justify-content-between align-items-center">
                    <div class="col-sm-4">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Vị trí banner</label>
                            <select class="form-select  rounded-0" aria-label="Default select example"
                                name="filter_position">
                                <option value="">Tất cả</option>
                                @foreach ($positionGet as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Lọc theo tên banner</label>
                            <input class="form-control rounded-0" name="filter_name" placeholder="Tên sản phẩm"
                                type="text" value="{{ $filter_name ?? '' }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Trạng thái</label>
                            <select class="form-select  rounded-0" aria-label="Default select example" name="filter_status">
                                <option value="">Tất cả</option>
                                <option value="1">Kích hoạt
                                </option>
                                <option value="0">Vô hiệu hóa
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn borrder-0 rounded-0 text-light my-3 " style="background: #4099FF"><i
                            class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc danh
                        mục</button>
                </div>
            </form>
        </div>

        <form id="submitFormAdmin" method="POST">
            @csrf
            <div class="buttonProductForm">
                <button class="btn btnF1">
                    <a href="{{ route('admin.bannerAdd') }}" class="text-decoration-none text-light"><i
                            class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i>Tạo banner</a>
                </button>
                <button class="btn btnF2" type="button"
                    onclick="submitForm('{{ route('admin.checkboxDeleteBanner') }}','post')"><i
                        class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                    banner</button>

            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Banner</h4>
                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class=" py-2"></th>
                            <th class=" py-2">Tên banner</th>
                            <th class=" py-2">Hình ảnh</th>
                            <th class=" py-2">Vị trí</th>
                            <th class=" py-2">Trạng thái</th>
                            <th class=" py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($banners as $item)
                            <tr class="">

                                <td>
                                    <input type="checkbox" name="banner_id[]" id="" value="{{ $item->id }}">
                                </td>
                                <td>
                                    <p>{{ $item->name }}</p>
                                </td>

                                <td class="">
                                    @foreach ($item->banneImages as $banners)
                                        <img src="{{ asset('uploads/' . $banners->image) }}"
                                            alt=""style="width:20%;height:20%; object-fit: cover;">
                                    @endforeach
                                </td>
                                <td>
                                    @if (isset($positionGet[$item->position]))
                                        <p>{{ $positionGet[$item->position] }}</p>
                                    @endif
                                </td>
                                <td class="">
                                    @if ($item->status == 0)
                                        <img src="https://img.icons8.com/material-rounded/24/FA5252/toggle-off.png"
                                            alt="toggle-off" style="width:25px;height:25px; object-fit:cover;" />
                                    @else
                                        <div class="">
                                            <img src="https://img.icons8.com/ios-filled/50/40C057/toggle-on.png"
                                                alt="toggle-on" style="width:25px;height:25px; object-fit:cover;" />
                                        </div>
                                    @endif
                                </td>
                                <td class="actionAdmin">
                                    <button class="btn border-0 rounded-0 p-1" style="background-color: #1f508d">
                                        <a href="{{ route('admin.bannerEdit', $item['id']) }}"
                                            class="text-decoration-none text-light d-flex justify-content-center align-items-center"><img
                                                src="https://img.icons8.com/sf-black-filled/64/ffffff/create-new.png"
                                                alt="create-new" style="width:15px;height:15px; object-fit:cover;" />Sửa</a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <nav class="navPhanTrang">
            <ul class="pagination">
                {{-- <li>{{ $banners->links() }}</li> --}}
            </ul>
        </nav>
    </div>

@endsection

@section('scriptBanner')
    <script>
        $(document).ready(function() {
            $('#filterFormBanner').on('submit', function() {
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('searchBanner') }}',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        $('.table-body').html(response.html);
                    },
                    error: function(error) {
                        console.error('Lỗi khi lọc' + error);
                    }
                })
            })
        })
    </script>
@endsection
