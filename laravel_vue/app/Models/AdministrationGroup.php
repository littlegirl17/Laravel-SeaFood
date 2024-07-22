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

    public function administrationGroupAll()
    {
        return $this->orderBy('id', 'asc')->get();
    }

    public function administration()
    {
        return $this->hasMany(Administration::class, 'admin_group_id');
    }

    public function checkGetPermission($perrmission)
    {
        $perrmissionDatabase = json_decode($this->perrmission, true);
        return in_array($perrmission, $perrmissionDatabase);
    }
}