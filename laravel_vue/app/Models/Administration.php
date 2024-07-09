<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administration extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'administrations';
    protected $guard = 'admin';
    protected $fillable = [
        'admin_group_id',
        'fullname',
        'name',
        'password',
        'email',
        'image',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function searchAdministration($filter_adminGroupId, $filter_name)
    {
        $query = $this->query();

        if (!is_null($filter_adminGroupId)) {
            $query->where('admin_group_id', $filter_adminGroupId);
        }

        if (!is_null($filter_name)) {
            $query->where('name', 'LIKE', "%{$filter_name}%");
        }

        return $query->paginate(10);
    }

    public function getAllAdmin()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function administrationGroup()
    {
        return $this->belongsTo(AdministrationGroup::class, 'admin_group_id');
    }

    public function countAdministrationGroup($administrationGroup_id)
    {
        return $this->where('admin_group_id', $administrationGroup_id)->count();
    }
}