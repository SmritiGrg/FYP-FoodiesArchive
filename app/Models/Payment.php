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
        'payment_method',
        'transaction_id',
        'status',
        'payment_date',
        'subscriber_id'
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function subscribers(): void
    {
        $this->belongsTo(UserSubscriber::class, 'subscriber_id', 'id');
    }
}
