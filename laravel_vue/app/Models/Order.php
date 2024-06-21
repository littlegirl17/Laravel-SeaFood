<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'province',
        'district',
        'ward',
        'total',
        'payment',
        'status_id',
        'coupon_code',
        'note',
        'order_code'
    ];

    public function orderAll(){
        return $this->orderBy('id', 'desc')->get();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');//mỗi Order sẽ có một User
    }

    public function getOrderByStatus($status_id){
        return $this->where('status_id', $status_id)->get();
    }

    public function countNew(){
        return $this->where('status_id', 1)->count();
    }

    public function countProcessing(){
        return $this->where('status_id', 2)->count();
    }

    public function countShipped(){
        return $this->where('status_id', 3)->count();
    }

    public function countCompleted(){
        return $this->where('status_id', 4)->count();
    }
    public function countCancelled(){
        return $this->where('status_id', 5)->count();
    }


    public function searchOrder($search){
        return $this->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('total', 'LIKE', "%{$search}%")
                    ->orWhere('province', 'LIKE', "%{$search}%")
                    ->orWhere('district', 'LIKE', "%{$search}%")
                    ->orWhere('ward', 'LIKE', "%{$search}%")
                    ->orWhere('total', 'LIKE', "%{$search}%")
                    ->paginate(10);
    }


    public function getIdUserOrder($iddh){
        return $this->where('id',$iddh->id)->get();
    }

    public function getPaymentMethod(){
        return [
            1 => 'Thanh toán bằng tiền mặt',
            2 => 'Chuyển khoản ngân hàng',
            3 => 'Thanh toán VNPAY',
            4 => 'Thanh toán MoMo',
        ];

    }

}
