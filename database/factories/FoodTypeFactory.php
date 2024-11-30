<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodType>
 */
class FoodTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(), // Generates a unique word for the food type
            'image' => $this->faker->imageUrl(640, 480, 'food', true, 'FoodType'), // Generates a placeholder food-related image
        ];
    }
}
