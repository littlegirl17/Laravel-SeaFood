<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function checkProductCart($userID, $productID)
    {
        return $this->where('carts.user_id', $userID)
            ->where('carts.product_id', $productID)
            ->leftJoin('users', 'carts.user_id', '=', 'users.id')
            ->select('carts.*', 'users.id as user_id')
            ->first();
    }

    public function getCartAll()

    {
        return $this->orderBy('id','desc')->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}