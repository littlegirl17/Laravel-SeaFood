@extends('admin.layout.layoutAdmin')
@Section('title','Admin | Sản phẩm')
@Section('content')

<h3 class="title-page ">
    Sản phẩm
</h3>
<div class="row " style="margin-left: 1100px;">
    <button class="btnFormAdd ">
        <a href="{{route('productAdd')}}" class="text-decoration-none ">Thêm</a>
    </button>
</div>
<div class="table pt-3" >
    <div class="table-header">
        <div class="header__item"><a id="name" class="filter__link" href="#">Hình ảnh</a></div>
        <div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Sản phẩm</a></div>
        <div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Danh mục</a></div>
        <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Trạng thái</a></div>
        <div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Hành động</a></div>
    </div>

    <div class="table-content">
        @foreach ($products as $item)
            <div class="table-row">
                <div class="table-data">
                    <img src="{{asset('img/seafood/'.$item->image)}}" alt="">
                </div>
                <div class="table-data">{{$item->name}}</div>
                <div class="table-data">{{$item->category->name}}</div>
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
                    <a href="{{route('productEdit', $item['id'])}}" class="text-decoration-none px-2"><img src="https://img.icons8.com/sf-black-filled/64/1f508d/create-new.png" alt="create-new" style="width:35px;height:35px; object-fit:cover;"/></a>
                    <a href="{{route('productDelete', $item['id'])}}" class="text-decoration-none "><i class="fa-solid fa-trash" style="color: #ff0505; font-size: 25px;  "></i></a>
                </div>
            </div>
        @endforeach

            {{$products->links()}}
        </div>
    </div>
</div>




@endsection
