<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserTableSeeder::class,
            FollowsTableSeeder::class,
            CuisineTypeTableSeeder::class,
            FoodTypeTableSeeder::class,
            TagTableSeeder::class,
            BadgeTableSeeder::class,
            SubscriptionPlanTableSeeder::class,
            RestaurantTableSeeder::class,
            FoodPostTableSeeder::class,
            LikeTableSeeder::class,
            ReviewTableSeeder::class,
            QuestionTableSeeder::class,
            AnswersTableSeeder::class,
            UserBadgeTableSeeder::class,
            UserSubscriberTableSeeder::class,
            PaymentTableSeeder::class,
        ]);
    }
}
