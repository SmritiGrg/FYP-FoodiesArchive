<?php

namespace Database\Factories;

use App\Models\FoodPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Likes>
 */
class LikesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::where('id', '!=', 1)->pluck('id')->toArray(); // Fetch all user IDs except 1-admin
        $foodPostId = FoodPost::pluck('id')->toArray(); // Fetch all food post IDs

        return [
            'user_id' => $this->faker->randomElement($userId), // Associate a random user
            'food_post_id' => $this->faker->randomElement($foodPostId), // Associate a random food post
        ];
    }
}
