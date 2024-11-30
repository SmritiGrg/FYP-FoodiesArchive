<?php

namespace Database\Factories;

use App\Models\FoodType;
use App\Models\Restaurants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodPost>
 */
class FoodPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::pluck('id')->toArray();
        $foodTypeId = FoodType::pluck('id')->toArray();
        $restaurantId = Restaurants::pluck('id')->toArray();
        return [
            'name' => $this->faker->name(), // Generates a random food post name
            'description' => $this->faker->paragraph(), // Generates a random description
            'price' => $this->faker->randomFloat(2, 10, 100), // Generates a random price between 10 and 100
            'image' => $this->faker->imageUrl(), // Generates a placeholder image
            'restaurant_id' => fake()->randomElement($restaurantId), // Associates a restaurant
            'user_id' => fake()->randomElement($userId), // Associates a user
            'food_type_id' => fake()->randomElement($foodTypeId),
        ];
    }
}
