<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];
    public function food_posts()
    {
        return $this->belongsToMany(FoodPost::class, 'category_food', 'category_id', 'food_post_id');
    }
}
