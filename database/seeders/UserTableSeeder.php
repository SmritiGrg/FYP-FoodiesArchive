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
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'adminn',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'image' => 'admin.jpg',
            'role' => 'admin',
        ]);
        User::create([
            'first_name' => 'Customer',
            'last_name' => 'User',
            'username' => 'contentuser',
            'email' => 'gurungsm.10@gmail.com',
            'password' => Hash::make('customer123'),
            'image' => 'customer.jpg',
            'role' => 'creator',
        ]);
        User::factory()->count(18)->create();
    }
}
