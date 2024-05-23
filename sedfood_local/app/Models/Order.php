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
        'coupon_code'
    ];

    public function orderAll(){
        return $this->orderBy('id', 'desc')->get();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');//mỗi Order sẽ có một User
    }
}