<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'content',
        'status',
    ];


    public function productComment($detail){
        return $this->with('user') //gọi hàm user thông qua một instance
                    ->where('product_id', $detail->id)
                    ->where('status',1)
                    ->orderBy('id','desc')
                    ->get();
    }

    public function searchComment($search){
        return $this->where('content', 'LIKE', "%{$search}%")
                    ->orWhere('user_id', 'LIKE', "%{$search}%")
                    ->paginate(10);
    }

    //kết nối đên bảng users thông qua user_id
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    //admin
    public function commentAll(){
        return $this->orderBy('id', 'desc')->paginate(10);
    }
}