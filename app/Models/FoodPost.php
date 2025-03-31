<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'review',
        'rating',
        'price',
        'image',
        'restaurant_id',
        'user_id',
        'food_type_id',
        'cuisine_type_id',
        'tag_id'
    ];

    // Many food posts belong to a restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurants::class, 'restaurant_id', 'id');
    }

    // A food post is created/uploaded by a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // A food post can have many likes
    public function likes()
    {
        return $this->hasMany(Likes::class, 'food_post_id', 'id');
    }

    // A food post can have many questions
    public function questions()
    {
        return $this->hasMany(Questions::class, 'food_post_id', 'id');
    }

    // A food post belongs to a food type
    public function foodType()
    {
        return $this->belongsTo(FoodTypes::class, 'food_type_id', 'id');
    }

    // A food post belongs to a cuisine type
    public function cuisineType()
    {
        return $this->belongsTo(CuisineTypes::class, 'cuisine_type_id', 'id');
    }

    // A food post can have many reviews
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'food_post_id', 'id')->whereNull('parent_id');
    }

    public function tag()
    {
        return $this->belongsTo(Tags::class, 'tag_id', 'id');
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'food_post_id', 'user_id')->withTimestamps();
    }
}
