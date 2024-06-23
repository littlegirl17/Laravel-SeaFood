<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrationGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'permission',
    ];

    public function administration()
    {
        return $this->hasMany(Administration::class, 'admin_group_id');
    }
}
