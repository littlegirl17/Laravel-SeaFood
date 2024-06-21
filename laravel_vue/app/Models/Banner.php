<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'position',
    ];

    public function searchBanner($filter_name, $filter_position, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_position)) {
            $query->where('position', $filter_position);
        }

        if (!is_null($filter_name)) {
            $query->where('name', 'LIKE', "%{$filter_name}%");
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }

    public function bannerAll()
    {
        return $this->orderBy('id', 'desc')->with('banneImages')->get();
    }

    public function banneImages()
    {
        return $this->hasMany(BannerImage::class, 'banner_id');
    }

    public function getPosition()
    {
        return  [
            1 => 'Banner slide đầu trang chủ',
            2 => 'Banner dài ở trong trang chủ',
            3 => 'Hai banner nhỏ dưới banner dài',
            4 => 'Banner chung các trang khác',
            5 => 'Footer',
        ];
    }
}
