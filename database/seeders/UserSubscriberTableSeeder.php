<?php

namespace Database\Seeders;

use App\Models\UserSubscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserSubscriber::factory()->count(31)->create();
    }
}
