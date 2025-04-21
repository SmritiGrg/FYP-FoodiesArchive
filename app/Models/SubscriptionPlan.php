<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'features',
        'billing_time',
        'type'
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function subscribers(): void
    {
        $this->hasMany(UserSubscriber::class, 'subscription_id', 'id');
    }
}
