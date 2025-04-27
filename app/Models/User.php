<?php

namespace App\Models;

use App\Mail\PremiumExpiredMail;
use Illuminate\Contracts\Auth\CanResetPassword;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;


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
        'total_streak_points',
        'badge_popup',
        'premium_activated_at',
        'last_login_bonus_at',
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
            'last_login_bonus_at' => 'date',
            'password' => 'hashed',
            'badge_popup' => 'array',
        ];
    }

    // Users this user is following.
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    // Users following this user.
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurants::class, 'added_by_user_id');
    }

    public function foodPosts()
    {
        return $this->hasMany(FoodPost::class, 'user_id', 'id');
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
        return $this->belongsToMany(Badge::class, 'user_badges')
            ->withPivot('awarded_date')
            ->withTimestamps();
    }

    public function isFollowing(int $userId)
    {
        return $this->followings()->where('followed_id', $userId)->exists();
    }

    public function bookmarksPosts()
    {
        return $this->belongsToMany(FoodPost::class, 'bookmarks', 'user_id', 'food_post_id')->withTimestamps();
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscriber::class);
    }

    public function hasActivePremium()
    {
        // Get the most recent active subscription
        $activeSubscription = $this->subscriptions()
            ->where('status', 'Active')
            ->latest('end_date')
            ->first();

        // If subscription exists but is expired
        if ($activeSubscription && now()->greaterThan($activeSubscription->end_date)) {
            $activeSubscription->update(['status' => 'Expired']);
            $this->update(['role' => 'general']); // downgrading role

            // Sending expiration email
            Mail::to($this->email)->send(new PremiumExpiredMail($this));
            return false;
        }

        return $this->role === 'premium_user' && $activeSubscription !== null;
    }
}
