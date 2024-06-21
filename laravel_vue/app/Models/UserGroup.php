<?php

namespace App\Models;

use App\Models\ProductDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function userGroupAll(){
        return $this->orderBy('id','desc')->get();
    }

    public function product_discount(){
        return $this->hasMany(ProductDiscount::class , 'user_group_id');
    }// Mỗi UserGroup(vàng, đồng ,bạc) có thể có nhiều giảm giá sản phẩm.

    public function user(){
        return $this->hasMany(User::class , 'user_group_id');
    }// mỗi UserGroup(vàng, đồng ,bạc) này có thể thuộc về nhiều user
}