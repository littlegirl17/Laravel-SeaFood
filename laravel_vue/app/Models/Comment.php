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


    public function productComment($detail)
    {
        return $this->with('user') //gọi hàm user thông qua một instance
            ->where('product_id', $detail->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function searchComment($filter_idsp, $filter_userName, $filter_content, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_content)) {
            $query->where('content', 'LIKE', "%{$filter_content}%");
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        if (!is_null($filter_userName)) {
            $query->where('user_id', '=', (int)$filter_userName);
        }

        if (!is_null($filter_idsp)) {
            $query->where('product_id', '=', (int)$filter_idsp);
        }

        return $query->paginate(10);
    }

    //kết nối đên bảng users thông qua user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    //admin
    public function commentAll()
    {
        return $this->orderBy('id', 'desc')->paginate(10);
    }
}
