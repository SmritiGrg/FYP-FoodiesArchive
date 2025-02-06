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
            'image' => 'smrii28-profile-1738587162.jpg',
            'role' => 'visitor',
        ]);
        // User::factory()->count(18)->create();
    }
}
