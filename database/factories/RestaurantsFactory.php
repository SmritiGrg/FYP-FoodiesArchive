<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurants>
 */
class RestaurantsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), // Generates a random company name
            'longitude' => $this->faker->longitude(), // Generates a random longitude
            'latitude' => $this->faker->latitude(), // Generates a random latitude
            'added_by_user_id' => \App\Models\User::factory(), // Assumes a relationship with the User model
            'status' => $this->faker->randomElement(['approved', 'pending', 'rejected']), // Example status values
        ];
    }
}
