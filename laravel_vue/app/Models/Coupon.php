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


    public function searchCoupon($filter_name, $filter_code, $filter_total, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_code)) {
            $query->where('code', '=', $filter_code);
        }

        if (!is_null($filter_name)) {
            $query->where('name_coupon', 'LIKE', "%{$filter_name}%");
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        if (!is_null($filter_total)) {
            $query->where('total', '=', (int)$filter_total);
        }

        return $query->paginate(10);
    }
}
