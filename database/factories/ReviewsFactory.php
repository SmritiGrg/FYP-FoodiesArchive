<?php

namespace Database\Factories;

use App\Models\FoodPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reviews>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->toArray(); // Fetch all user IDs
        $foodPostId = FoodPost::pluck('id')->toArray(); // Fetch all food post IDs

        return [
            'review' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween(1, 5),
            'user_id' => $this->faker->randomElement($userId),
            'food_post_id' => $this->faker->randomElement($foodPostId),
        ];
    }
}
