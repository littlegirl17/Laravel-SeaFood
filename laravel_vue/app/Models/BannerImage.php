<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'title',
        'image',
        'sort_order'
    ];

    public function bannerImageId($id){
        return $this->where('banner_id',$id)->get();
    }
}