<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Free Plan
        SubscriptionPlan::create([
            'amount' => 0,
            'features' => [
                'Explore food posts',
                'Like and comment',
                'Review and rating'
            ],
            'type' => 'Free',
            'billing_time' => 'lifetime'
        ]);

        // Premium Plan (Monthly)
        SubscriptionPlan::create([
            'amount' => 199,
            'features' => [
                'Explore food posts',
                'Like and comment',
                'Review and rating',
                'Premium badges',
                'Daily login bonus: +2 Streak Points'
            ],
            'type' => 'Premium',
            'billing_time' => 'monthly'
        ]);

        // Premium Plan (Yearly)
        SubscriptionPlan::create([
            'amount' => 2299,
            'features' => [
                'Explore food posts',
                'Like and comment',
                'Review and rating',
                'Premium badges',
                'Daily login bonus: +2 Streak Points'
            ],
            'type' => 'Premium',
            'billing_time' => 'yearly'
        ]);
    }
}
