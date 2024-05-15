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

    public function getOutstandingProducts($limit = 8){
        return $this->where('outstanding', 1)
                    ->orderBy('id', 'desc')
                    ->take($limit)
                    ->get();
    }

    public function getViewedProducts($limit = 4){
        return $this->where('view', '>', 0)
                    ->orderBy('view', 'desc')
                    ->take($limit)
                    ->get();
    }

    public function getDiscountProducts($limit = 4){
        return $this->where('discount_price', '>', 0)
                            ->orderBy('discount_price', 'asc')
                            ->take($limit)
                            ->get();
    }

    public function productRelated($detail,$slugProduct) {
        $product = Product::whereSlug($slugProduct)->firstOrFail(); //lấy ra slug product
        return $this->where('category_id', $detail->category_id) // lọc sao cho $detail->category_id của sản phẩm hienj tại phải bằng $category trong csdl
        ->where('id' ,'!=' ,$product->id) //$id hienj tại phải khác với 'id' trong csdl để: Loại trừ sản phẩm hiện tại
        ->inRandomOrder()
        ->take(4)
        ->get()
        ;
    }

    public function productIddm($slugCategory){
        $category = Category::whereSlug($slugCategory)->firstOrFail();//dựa trên slug về danh mục đó để lấy ra id của danh mục đó
        return $this->where('category_id', $category->id)->get();
        // lấy danh mục dựa trên slug, sau đó $category->id trả về ID của danh mục này.
    }

    //kết nối đến category thông qua category_id
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    //admin
    public function productAll(){
        return $this->orderBy('id', 'desc')->get();
    }

}
