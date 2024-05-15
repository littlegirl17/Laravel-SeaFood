@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Bình luận')
@Section('content')


<h3 class="title-page ">
    Bình luận
</h3>
<div class="row " style="margin-left: 1100px;">
    <button class="btnFormAdd ">
        <a href="#" class="text-decoration-none ">Thêm</a>
    </button>
</div>
<div class="table pt-3">
    <div class="table-header">
        <div class="header__item"><a id="name" class="filter__link" href="#">Người bình luận</a></div>
        <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Sản phẩm</a></div>
        <div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Nội dung</a></div>
        <div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">Trạng thái</a></div>
        <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Hành động</a></div>
    </div>
    <div class="table-content">
        @foreach ($comments as $item)
            <div class="table-row">
                <div class="table-data">{{$item->user->name}}</div>
                <div class="table-data">{{$item->product->name}}</div>
                <div class="table-data">{{$item->content}}</div>
                <div class="table-data">{{$item->status == 0 ? 'Tắt' : 'Bật' }}</div>
                <div class="table-data">
                    <a href="" class="text-decoration-none  px-2"><button class="btn btn-outline-warning ">Edit</button></a>
                    <a href="" class="text-decoration-none "><button class="btn btn-outline-danger">Delete</button></a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
</ul>

@endsection
