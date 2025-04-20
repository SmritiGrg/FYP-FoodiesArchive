<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'full_name' => 'Admin User',
            'username' => 'adminn',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'image' => 'admin.jpg',
            'role' => 'admin',
        ]);

        User::create([
            'full_name' => 'Smriti Gurung',
            'username' => 'smrii28',
            'email' => 'gurungsm.10@gmail.com',
            'password' => Hash::make('customer123'),
            'image' => 'aries10-profile-1742961117.jpg',
            'role' => 'general',
            'streak_count' => 21,
            'last_activity_date' => now(),
            'total_streak_points' => 21,
            'created_at' => now()->subMonths(1)
        ]);

        User::create([
            'full_name' => 'Aries Gurung',
            'username' => 'aries10',
            'email' => 'aries10@gmail.com',
            'password' => Hash::make('Aries28#'),
            'image' => 'aries10-profile-1742961117.jpg',
            'role' => 'general',
            'streak_count' => 21,
            'last_activity_date' => now(),
            'total_streak_points' => 21,
            'created_at' => now()->subMonths(1)
        ]);

        User::create([
            'full_name' => 'Luffy San',
            'username' => 'luffy10',
            'email' => 'luffy5@gmail.com',
            'password' => Hash::make('Luffy28#'),
            'image' => 'aries10-profile-1742961117.jpg',
            'role' => 'general',
            'streak_count' => 21,
            'last_activity_date' => now(),
            'total_streak_points' => 21,
            'created_at' => now()->subMonths(1)
        ]);
        User::factory()->count(42)->create();
    }
}
