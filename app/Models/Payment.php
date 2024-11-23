<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'amount_paid',
        'khalti_transaction_id',
        'status',
        'payment_date',
        'subscription_user_id'
    ];

    public function subscription_users(): void
    {
        $this->belongsTo(SubscriptionUser::class, 'subscription_user_id', 'id');
    }
}
