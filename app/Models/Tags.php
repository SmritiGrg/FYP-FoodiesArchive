<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function foodPosts()
    {
        return $this->hasMany(FoodPost::class, 'tag_id', 'id');
    }
}
