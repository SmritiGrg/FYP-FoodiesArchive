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
        SubscriptionPlan::create([
            'amount' => 1099, // Amount for the subscription (adjust accordingly)
            'features' => 'Access to premium features such as posting food, badges, and more.', // Features description
            'type' => 'lifetime', // Type of plan (since you have only one, set it to 'lifetime')
        ]);
    }
}
