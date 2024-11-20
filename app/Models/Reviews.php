<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'stars',
        'user_id',
        'food_post_id'
    ];
}
