<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    public function userAll()
    {
        return $this->orderBy('id', 'desc')->paginate(6);
    }


    public function searchUser($filter_email, $filter_status)
    {
        $query = $this->query();

        if (!is_null($filter_email)) {
            $query->where('email', 'LIKE', "%{$filter_email}%");
        }

        if (!is_null($filter_status)) {
            $query->where('status', '=', (int)$filter_status);
        }

        return $query->paginate(10);
    }

    public function getCheckEmail($email)
    {
        return $this->where('email', $email)->first();
    }


    public function countUserGroup($userGroupId)
    {
        return $this->where('user_group_id', $userGroupId)->count();
    }

    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id');
    }
}
