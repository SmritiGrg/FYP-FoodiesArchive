<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_post_id'
    ];

    // each like belongs to a user
    public function user(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    // each like belongs to a food post
    public function foodPost(): void
    {
        $this->belongsTo(FoodPosts::class, 'food_post_id', 'id');
    }
}
