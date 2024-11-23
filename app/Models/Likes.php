<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $fillable = [
        'likes',
        'user_id',
        'food_post_id'
    ];

    // each like belongs to a user
    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    // each like belongs to a food post
    public function foodPosts(): void
    {
        $this->belongsTo(FoodPost::class, 'food_post_id', 'id');
    }
}
