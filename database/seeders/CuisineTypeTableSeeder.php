<?php

namespace Database\Seeders;

use App\Models\CuisineTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuisineTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CuisineTypes::create([
            'name' => 'Traditionl Nepali',
            'image' => 'traditionalNepali.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Korean',
            'image' => 'korean.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Indian',
            'image' => 'indian.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Italian',
            'image' => 'italian.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Mexican',
            'image' => 'mexican.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Chinese',
            'image' => 'chinese.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Japanese',
            'image' => 'japanese.jpg',
        ]);

        CuisineTypes::create([
            'name' => 'Basci Nepali',
            'image' => 'basic-nepali.jpg',
        ]);
    }
}
