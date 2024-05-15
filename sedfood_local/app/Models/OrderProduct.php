<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'total',
    ];

    //thiết lập mối quan hệ đến với order và product
        public function order(){
            return $this->belongsTo(Order::class,'order_id'); //orderProduct thuộc về 1 order
        }

        public function product(){
            return $this->belongsTo(Product::class, 'product_id');//product thuộc về 1 order
        }
}