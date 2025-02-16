<?php

namespace Database\Factories;

use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSubscriber>
 */
class UserSubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $premiumUsers = User::where('role', 'premium_user')->pluck('id')->toArray();
        $subscriptionPlan = SubscriptionPlan::first();

        return [
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'), 
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Cancelled']), 
            'subscription_id' => $subscriptionPlan->id, 
            'user_id' => $this->faker->randomElement($premiumUsers), 
        ];
    }
}
