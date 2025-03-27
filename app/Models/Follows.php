<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    // Relationship: The user who follows.
    // public function follower()
    // {
    //     return $this->belongsTo(User::class, 'follower_id');
    // }

    // // Relationship: The user being followed.
    // public function following()
    // {
    //     return $this->belongsTo(User::class, 'followed_id');
    // }
}
