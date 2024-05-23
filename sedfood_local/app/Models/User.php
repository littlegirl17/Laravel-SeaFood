<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'image'
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

    //mối quan hệ giữa bảng users và bảng posts
    // public function usersCoolPosts(){
    //     return $this->hasMany(Post::class, 'user_id');
    //     //Post::class chỉ ra rằng mối quan hệ này liên kết với model Post
    //     //'user_id' chỉ ra rằng khóa ngoại (foreign key) trong bảng posts để liên kết với bảng users là cột user_id.
    // }

    //admin
    public function userAll(){
        return $this->orderBy('id', 'desc')->paginate(6);
    }
}