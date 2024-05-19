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
                <div class="table-data">
                    @if($item->status == 0)
                        <img src="https://img.icons8.com/material-rounded/24/FA5252/toggle-off.png" alt="toggle-off" style="width:25px;height:25px; object-fit:cover;"/>
                    @else
                    <div class="" >
                        <img src="https://img.icons8.com/ios-filled/50/40C057/toggle-on.png" alt="toggle-on"  style="width:25px;height:25px; object-fit:cover;"/>
                    </div>
                    @endif
                </div>
                <div class="table-data">
                    <a href="" class="text-decoration-none px-2"><img src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new" style="width:35px;height:35px; object-fit:cover;"/></a>
                    <a href="" class="text-decoration-none "><i class="fa-solid fa-trash" style="color: #ff0505; font-size: 25px;  "></i></a>
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
