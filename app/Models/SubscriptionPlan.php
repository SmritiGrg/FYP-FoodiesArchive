<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'amaount',
        'features',
        'type'
    ];

    public function subscription_user(): void
    {
        $this->hasMany(SubscriptionUser::class, 'subscription_id', 'id');
    }
}
