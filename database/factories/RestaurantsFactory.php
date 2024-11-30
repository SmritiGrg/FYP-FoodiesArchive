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
            'name' => $this->faker->company(), // Generates a restaurant name
            'phone_number' => $this->faker->phoneNumber(), // Generates a random phone number
            'email' => $this->faker->unique()->safeEmail(), // Generates a unique email address
            'website_link' => $this->faker->url(), // Generates a random website URL
            'city' => $this->faker->city(), // Generates a city name
            'longitude' => $this->faker->longitude(), // Generates a random longitude
            'latitude' => $this->faker->latitude(), // Generates a random latitude
            'image' => $this->faker->imageUrl(640, 480, 'restaurants', true, 'Restaurant'), // Generates a placeholder image URL
            'map' => $this->faker->url(), // Generates a random map link (can be customized)
            'open_time' => $this->faker->time('H:i'), // Generates a random opening time
            'close_time' => $this->faker->time('H:i'), // Generates a random closing time
        ];
    }
}
