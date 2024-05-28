<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_coupon',
        'code',
        'type',
        'total',
        'date_start',
        'date_end',
        'discount',
        'status'
    ];


    public function searchCoupon($search){
        return $this->where('name_coupon', 'LIKE', "%{$search}%")
                    ->orWhere('code', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('total', 'LIKE', "%{$search}%")
                    ->orWhere('discount', 'LIKE', "%{$search}%")
                    ->paginate(10);
    }

}