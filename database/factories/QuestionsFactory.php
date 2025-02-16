<?php

namespace Database\Factories;

use App\Models\FoodPost;
use App\Models\FoodPosts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questions>
 */
class QuestionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foodPostId = FoodPosts::pluck('id')->toArray();
        $userId = User::pluck('id')->toArray();
        return [
            'content' => $this->faker->sentence(), // Generates a random question
            'food_post_id' => $this->faker->randomElement($foodPostId), // Associates with a food post
            'user_id' => $this->faker->randomElement($userId),
        ];
    }
}
