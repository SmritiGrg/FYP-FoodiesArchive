<?php

namespace Database\Seeders;

use App\Models\FoodType;
use App\Models\FoodTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodTypes::create([
            'name' => 'Breakfast',
            'image' => 'breakfast.jpg',
        ]);

        FoodTypes::create([
            'name' => 'Dinner',
            'image' => 'dinner.jpg',
        ]);

        FoodTypes::create([
            'name' => 'Street Food',
            'image' => 'streetFood.jpg',
        ]);

        FoodTypes::create([
            'name' => 'Dessert',
            'image' => 'dessert.jpg',
        ]);

        FoodTypes::create([
            'name' => 'Drinks',
            'image' => 'drink.jpg',
        ]);
    }
}
