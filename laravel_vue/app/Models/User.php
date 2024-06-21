<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'province',
        'district',
        'ward',
        'status',
        'role',
        'image',
        'verification_code',
        'user_group_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //admin
    public function userAll(){
        return $this->orderBy('id', 'desc')->paginate(6);
    }


    public function searchUser($search){
        return $this->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('province', 'LIKE', "%{$search}%")
                    ->orWhere('district', 'LIKE', "%{$search}%")
                    ->orWhere('ward', 'LIKE', "%{$search}%")
                    ->paginate(10);
    }

    public function getCheckEmail($email){
        return $this->where('email',$email)->first();
    }



    public function userGroup(){
        return $this->belongsTo(UserGroup::class, 'user_group_id');
    }
}
