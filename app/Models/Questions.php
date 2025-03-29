<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'food_post_id',
        'user_id'
    ];

    public function foodPosts(): void
    {
        $this->belongsTo(FoodPost::class, 'food_post_id', 'id');
    }

    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function answers(): void
    {
        $this->hasMany(Answers::class, 'user_id', 'id');
    }
}
