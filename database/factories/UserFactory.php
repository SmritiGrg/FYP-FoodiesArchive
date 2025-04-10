<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'image' => $this->faker->imageUrl(),
            'role' => $this->assignRole(),
            'streak_count' => $this->faker->numberBetween(0, 200),
            'total_streak_points' => $this->faker->numberBetween(0, 1000),
            'last_activity_date' => $this->faker->optional()->dateTimeThisYear(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    private function assignRole()
    {
        // Return one of the roles except 'admin'
        return $this->faker->randomElement(['visitor', 'premium_user']);
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
