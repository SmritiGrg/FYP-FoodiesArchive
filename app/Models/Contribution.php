<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'contribution_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
