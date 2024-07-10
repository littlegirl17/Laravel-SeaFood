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

    public function orderAll()
    {
        return $this->orderBy('id', 'asc')->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); //mỗi Order sẽ có một User
    }

    public function getOrderByStatus($status_id)
    {
        return $this->where('status_id', $status_id)->get();
    }

    public function countNew()
    {
        return $this->where('status_id', 1)->count();
    }

    public function countProcessing()
    {
        return $this->where('status_id', 2)->count();
    }

    public function countShipped()
    {
        return $this->where('status_id', 3)->count();
    }

    public function countCompleted()
    {
        return $this->where('status_id', 4)->count();
    }
    public function countCancelled()
    {
        return $this->where('status_id', 5)->count();
    }


    public function searchOrder($filter_iddh, $filter_userName, $filter_total, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_iddh) && is_numeric($filter_iddh)) {
            $query->where('id', '=', (int)$filter_iddh);
        }

        if (!is_null($filter_userName)) {
            $query->where('name', 'LIKE', "%{$filter_userName}%");
        }

        if (!is_null($filter_total)) {
            $query->where('total', '=', (int)$filter_total);
        }

        if (!is_null($filter_status)) {
            $query->where('status_id', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }


    public function getIdUserOrder($iddh)
    {
        return $this->where('id', $iddh->id)->get();
    }

    // hàm này trả về mảng các PTTT
    public function getPaymentMethod()
    {
        return [
            1 => 'Thanh toán bằng tiền mặt',
            2 => 'Chuyển khoản ngân hàng',
            3 => 'Thanh toán VNPAY',
            4 => 'Thanh toán MoMo',
        ];
    }

    public function totalRevenue()
    {
        return $this->sum('total');
    }

    public function countOrder()
    {
        return $this->count('id');
    }
}
