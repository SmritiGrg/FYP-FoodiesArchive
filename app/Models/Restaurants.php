<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurants extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'added_by_user_id',
        'status',
    ];

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }

    public function foodPosts(): void
    {
        $this->hasMany(FoodPosts::class, 'restaurant_id', 'id');
    }
}
