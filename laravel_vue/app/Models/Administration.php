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
        'fullName',
        'username',
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

    public function checkLogin($username, $password)
    {
        return $this->where('name', $username)->Where('password', $password)->first();

        // if ($adminLogin && Hash::check($password, $adminLogin->password)) {
        //     return $adminLogin;
        // }
        // return $adminLogin;
    }
}
