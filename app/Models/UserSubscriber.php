<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'status',
        'subscription_id',
        'user_id'
    ];

    public function users(): void
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscription_plan(): void
    {
        $this->belongsTo(SubscriptionPlan::class, 'subscription_id', 'id');
    }
}
