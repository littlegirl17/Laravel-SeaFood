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

    public function search($search){
        return $this->where('name', 'LIKE', "%{$search}%")
                    ->get();
    }

    public function categoryHome(){
        return $this->where('status', 1)
                    ->orderBy('sort_order', 'asc')
                    ->get();
    }

    //admin
    public function categoryAll(){
        return $this->orderBy('id', 'desc')->paginate(6);
    }

    public function productByCate(){
        return $this->hasMany(Product::class, 'category_id')->where('status', 1)
                                                            ->get();
    }

    public function product(){
        return $this->hasMany(Product::class , 'category_id');
    }
}