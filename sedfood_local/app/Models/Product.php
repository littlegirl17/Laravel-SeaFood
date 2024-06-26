<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'quantity',
        'category_id',
        'description',
        'price',
        'discount_price',
        'hot',
        'view',
        'outstanding',
        'status',
        'slug'
    ];

    public function search($search){
        return $this->where('name', 'LIKE', "%{$search}%")
        ->where('status', 1)
        ->orderBy('id','desc')
        ->paginate(8);
    }

    public function searchProduct($search){
        return $this->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orderBy('id', 'desc')
                    ->paginate(10);
    }


    public function getOutstandingProducts(){
        return $this->where('outstanding', 1)
                    ->where('status', 1)
                    ->where('quantity', '>', 0)
                    ->orderBy('id', 'desc')
                    ->get();
    }

    public function getViewedProducts($limit = 4){
        return $this->where('view', '>', 0)
                    ->where('status', 1)
                    ->where('quantity', '>', 0)
                    ->orderBy('view', 'desc')
                    ->take($limit)
                    ->get();
    }

    public function getBestSellerProducts(){
        $bestSellers = (new OrderProduct)->getBestSeller();

        return $this->whereIn('id', $bestSellers->pluck('product_id'))->get();
        //whereIn sử dụng để lọc các bản ghi dựa trên các giá trị trong một mảng.
        //pluck  sử dụng để lấy ra một hoặc nhiều cột của một tập hợp bản ghi và trả về một mảng.
    }

    public function getDiscountProducts($limit = 4){
        return $this->where('discount_price', '>', 0)
                            ->where('status', 1)
                            ->where('quantity', '>', 0)
                            ->orderBy('discount_price', 'asc')
                            ->take($limit)
                            ->get();
    }

    public function getSoldOut($limit = 4){
        return $this->where('quantity', 0)
                            ->where('status', 1)
                            ->orderBy('id', 'desc')
                            ->take($limit)
                            ->get();
    }

    public function productRelated($detail,$slugProduct) {
        $product = Product::whereSlug($slugProduct)->firstOrFail(); //lấy ra slug product
        return $this->where('category_id', $detail->category_id) // lọc sao cho $detail->category_id của sản phẩm hienj tại phải bằng $category trong csdl
        ->where('id' ,'!=' ,$product->id) //$id hienj tại phải khác với 'id' trong csdl để: Loại trừ sản phẩm hiện tại
        ->where('status', 1)
        ->where('quantity', '>', 0)
        ->inRandomOrder()
        ->take(4)
        ->get()
        ;
    }

    public function productIddm($slugCategory){
        $category = Category::whereSlug($slugCategory)->firstOrFail();//dựa trên slug về danh mục đó để lấy ra id của danh mục đó
        return $this->where('category_id', $category->id)
                    ->where('status', 1)
                    ->where('quantity', '>', 0)
                    ->get();
        // lấy danh mục dựa trên slug, sau đó $category->id trả về ID của danh mục này.
    }

    // public function productCategory(){
    //     return $this->where('category_id')->get();
    // }

    //kết nối đến category thông qua category_id
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function orderProduct(){
        return $this->hasMany(OrderProduct::class, 'product_id', 'id');
        //hasMany : 1-n
    }


    //admin
    public function productAll(){
        return $this->orderBy('id', 'desc')->paginate(8);
    }

    public function productByOrder(){
        return $this->hasMany(orderProduct::class, 'product_id');
    }
}