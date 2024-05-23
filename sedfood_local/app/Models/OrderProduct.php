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
        'quantity',
    ];

    public function getBestSeller(){
        return $this->selectRaw('product_id, SUM(quantity) as total_quantity') //selectRaw thực hiện các hàm SQL như SUM(), AVG(), COUNT()
        ->groupBy('product_id') //groupBy Nhóm các kết quả dựa trên một hoặc nhiều cột.
        ->having('total_quantity','>', 50) //having thêm các điều kiện lọc dữ liệu sau khi đã nhóm lại - Thường được sử dụng cùng với groupBy()
        ->orderByDesc('total_quantity');
    }

    public function orderProductId($orderId){
        return $this->where('order_id', $orderId)->with('product')->get();
    }

    //thiết lập mối quan hệ đến với order và product
        public function order(){
            return $this->belongsTo(Order::class,'order_id'); //orderProduct thuộc về 1 order
        }

        public function product(){
            return $this->belongsTo(Product::class, 'product_id');//product thuộc về 1 order
        }
}