<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_group_id',
        'quantity',
        'price',
    ];

    public function getProductDiscountById($id){
        return $this->where('product_id',$id)->get();
    }

    public function getProductDiscountByDefault(){
        return $this->where('user_group_id',1)->get();
    }

    public function product () {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function userGroup () {
        return $this->belongsTo(UserGroup::class,'user_group_id');
    }
}
