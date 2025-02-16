<?php

namespace Database\Factories;

use App\Models\Questions;
use App\Models\User;
use App\Models\UserSubscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answers>
 */
class AnswersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fetch all question and user IDs
        $questionId = Questions::pluck('id')->toArray();
        $userId = User::pluck('id')->toArray();

        return [
            'content' => $this->faker->paragraph(), // Generate a random answer text
            'question_id' => $this->faker->randomElement($questionId), // Associate a random question
            'user_id' => $this->faker->randomElement($userId), // Associate a random user
        ];
    }
}
