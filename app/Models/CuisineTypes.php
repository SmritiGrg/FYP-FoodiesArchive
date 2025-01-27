<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuisineTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function foodPosts()
    {
        return $this->hasMany(FoodPosts::class, 'cuisine_type_id');
    }
}
