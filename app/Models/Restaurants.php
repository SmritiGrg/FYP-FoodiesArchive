<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'website_link',
        'city',
        'longitude',
        'latitude',
        'image',
        'map',
        'open_time',
        'close_time'
    ];

    public function foodPosts(): void
    {
        $this->hasMany(FoodPosts::class, 'restaurant_id', 'id');
    }
}
