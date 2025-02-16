<?php

namespace Database\Factories;

use App\Models\UserSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['Paid', 'Pending', 'Failed'];
        $paymentMethods = ['Khalti'];
        $subscriberId = UserSubscriber::pluck('id')->toArray();

        return [
            'amount_paid' => 1099,
            'payment_method' => $this->faker->randomElement($paymentMethods), 
            'khalti_transaction_id' => $this->faker->uuid(), 
            'status' => $this->faker->randomElement($status), 
            'payment_date' => $this->faker->dateTimeThisYear(), 
            'subscriber_id' => $this->faker->randomElement($subscriberId), 
        ];
    }
}
