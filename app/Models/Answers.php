<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'question_id',
        'user_id'
    ];

    public function questions(): void
    {
        $this->belongsTo(Questions::class, 'question_id', 'id');
    }

    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}
