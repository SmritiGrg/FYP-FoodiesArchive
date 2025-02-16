<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tags::create([
            'name' => 'Highly Recommended',
        ]);

        Tags::create([
            'name' => 'Must Try',
        ]);

        Tags::create([
            'name' => 'Worth the Hype',
        ]);

        Tags::create([
            'name' => 'Hidden Gem',
        ]);

        Tags::create([
            'name' => 'Best Seller',
        ]);

        Tags::create([
            'name' => 'Authentic Nepali',
        ]);

        Tags::create([
            'name' => 'Comfort Food',
        ]);

        Tags::create([
            'name' => 'Perfect Pair',
        ]);

        Tags::create([
            'name' => 'Once in a Lifetime',
        ]);

        Tags::create([
            'name' => 'Budget-Friendly',
        ]);

        Tags::create([
            'name' => 'Local Treasure',
        ]);

        Tags::create([
            'name' => 'Food Lovers Dream',
        ]);

        Tags::create([
            'name' => 'Nepali Streets Best',
        ]);

        Tags::create([
            'name' => 'Wouldnt Recommend',
        ]);

        Tags::create([
            'name' => 'Taste of Nepal',
        ]);

        Tags::create([
            'name' => 'Disappointing Taste',
        ]);

        Tags::create([
            'name' => 'Avoid at all Costs',
        ]);

        
    }
}
