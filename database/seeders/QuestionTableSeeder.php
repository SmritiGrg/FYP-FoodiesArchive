<?php

namespace Database\Seeders;

use App\Models\Questions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questions::factory()->count(40)->create();
    }
}
