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
        'food_post_id'
    ];

    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function food_posts(): void
    {
        $this->belongsTo(FoodPosts::class, 'food_post_id', 'id');
    }
}
