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
    //admin
    public function categoryAll(){
        return $this->orderBy('id', 'desc')->get();
    }

}