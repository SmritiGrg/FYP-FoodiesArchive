<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPosts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'restaurant_id',
        'user_id',
        'sub_cat_id'
    ];
    public function restaurants(): void
    {
        $this->belongsTo(Restaurants::class, 'restaurant_id', 'id');
    }

    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sub_categories(): void
    {
        $this->belongsTo(SubCategory::class, 'sub_cat_id', 'id');
    }
}
