@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Danh mục')
@Section('content')


<h3 class="title-page ">
    Danh mục
</h3>
<button class="btnFormAdd mb-3">
    <a href="{{route('categoryAdd')}}" class="text-decoration-none ">Thêm</a>
</button>
<div class="row " style="margin-left: 1100px;">

</div>
<div class="table pt-3">
    <div class="table-header">
        <div class="header__item"><a id="name" class="filter__link" href="#">Hình ảnh</a></div>
        <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Tên danh mục</a></div>
        <div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">slug</a></div>
        <div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">Trạng thái</a></div>
        <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Hành động</a></div>
    </div>
    <div class="table-content">
        @foreach ($categorys as $item)
            <div class="table-row">
                <div class="table-data"><img src="{{asset('img/logo/'.$item->image)}}" alt=""></div>
                <div class="table-data">{{$item->name}}</div>
                <div class="table-data">{{$item->slug}}</div>
                <div class="table-data">{{$item->status == 0 ? 'Tắt' : 'Bật' }}</div>
                <div class="table-data">
                    <a href="{{route('categoryEdit', $item['id'])}}" class="text-decoration-none  px-2"><button class="btn btn-outline-warning ">Edit</button></a>
                    <a href="{{route('categoryDelete',$item['id'])}}" class="text-decoration-none ">
                        <button class="btn btn-outline-danger">Delete</button>
                    </a>
                </div>
            </div>
        @endforeach

</div>

<ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>

@endsection
