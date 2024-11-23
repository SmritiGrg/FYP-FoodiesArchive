<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'restaurant_id',
        'user_id',
        'food_type_id'
    ];

    // relationship between restaurant and food post
    // many food post belongs to a user
    public function restaurants(): void
    {
        $this->belongsTo(Restaurants::class, 'restaurant_id', 'id');
    }

    // relationship between user and food post
    // a food post is created/uploaded by a user
    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relationship between like andd foodPost 
    // a food post can have many likes
    public function likes(): void
    {
        $this->hasMany(Likes::class, 'food_post_id', 'id');
    }

    public function questions(): void
    {
        $this->hasMany(Questions::class, 'food_post_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_food', 'food_post_id', 'category_id');
    }

    public function food_type(): void
    {
        $this->belongsTo(FoodType::class, 'food_type_id', 'id');
    }

    public function reviews(): void
    {
        $this->hasMany(Reviews::class, 'food_post_id', 'id');
    }
}
