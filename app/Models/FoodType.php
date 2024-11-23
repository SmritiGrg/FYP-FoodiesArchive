<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image'
    ];

    public function food_posts(): void
    {
        $this->hasMany(FoodPost::class, 'food_type_id', 'id');
    }
}
