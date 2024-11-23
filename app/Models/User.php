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
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'image',
        'role'
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

    public function foodPosts(): void
    {
        $this->hasMany(FoodPost::class, 'user_id', 'id');
    }

    public function questions(): void
    {
        $this->hasMany(Questions::class, 'user_id', 'id');
    }

    public function answers(): void
    {
        $this->hasMany(Answers::class, 'user_id', 'id');
    }

    public function reviews(): void
    {
        $this->hasMany(Reviews::class, 'user_id', 'id');
    }
}
