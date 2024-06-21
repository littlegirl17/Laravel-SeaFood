<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'sort_order',
        'status',
        'slug'
    ];

    public function searchCategory($filter_name, $filter_status)
    {
        // Bắt đầu truy vấn từ bảng categories
        $query = $this->query();

        // Áp dụng điều kiện tìm kiếm theo tên (name) nếu có
        if ($filter_name !== null) {
            $query->where('name', 'LIKE', "%{$filter_name}%");
        }

        // Áp dụng điều kiện tìm kiếm theo trạng thái (status) nếu có
        if ($filter_status !== null) {
            $query->where('status', (int) $filter_status);
        }

        // Sử dụng paginate để phân trang kết quả, mỗi trang 10 bản ghi
        return $query->paginate(10);
    }




    public function categoryHome()
    {
        return $this->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    public function productByCate()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 1)
            ->get();
    }

    //admin
    public function categoryAll()
    {
        return $this->orderBy('id', 'desc')->paginate(10);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
