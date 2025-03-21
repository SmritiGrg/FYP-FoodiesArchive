<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'image',
        'role',
        'streak_count',
        'last_activity_date',
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

    // Users this user is following.
    public function followings()
    {
        return $this->hasMany(Follows::class, 'follower_id');
    }

    // Users following this user.
    public function followers()
    {
        return $this->hasMany(Follows::class, 'followed_id');
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurants::class, 'added_by_user_id');
    }

    public function foodPosts()
    {
        return $this->hasMany(FoodPosts::class, 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Questions::class, 'user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'user_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'user_id', 'id');
    }
    public function likes()
    {
        return $this->hasMany(Likes::class, 'user_id', 'id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badges::class, 'user_badges')
            ->withPivot('awarded_date')
            ->withTimestamps();
    }

    public function isFollowing($userId)
    {
        return $this->followings()->where('followed_id', $userId)->exists();
    }
}
