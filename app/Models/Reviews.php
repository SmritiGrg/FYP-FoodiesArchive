<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'review',
        'rating',
        'user_id',
        'food_post_id',
        'parent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function food_post()
    {
        return $this->belongsTo(FoodPost::class, 'food_post_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reviews::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Reviews::class, 'parent_id');
    }

    public function helpfuls()
    {
        return $this->hasMany(ReviewHelpful::class, 'review_id');
    }

    public function isHelpfulByAuthUser()
    {
        return $this->helpfuls()->where('user_id', auth()->id())->exists();
    }
}
