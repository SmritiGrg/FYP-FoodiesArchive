<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;
    public $payment;

    public function __construct($user, $subscription, $payment)
    {
        $this->user = $user;
        $this->subscription = $subscription;
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Your Foodies Archive Subscription Receipt')
            ->view('emails.paymentReceipt');
    }
}
