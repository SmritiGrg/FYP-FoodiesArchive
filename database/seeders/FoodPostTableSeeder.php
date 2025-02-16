<?php

namespace Database\Seeders;

use App\Models\FoodPost;
use App\Models\FoodPosts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodPosts::create([
            'name' => 'Chicken Momo',
            'rating' => 5,
            'review' => 'Delicious Nepali dumplings with amazing dipping sauce!',
            'price' => 200,
            'image' => 'momo.jpg',
            'restaurant_id' => 5,
            'food_type_id' => 2,
            'cuisine_type_id' => 8,
            'tag_id' => 1,
            'user_id' => 3,
            'created_at' => now()->subDays(15),
            'updated_at' => now()->subDays(15),
        ]);

        FoodPosts::create([
            'name' => 'Pork Thakali Set',
            'rating' => 5,
            'review' => 'The ultimate Thakali experience, highly recommended.',
            'price' => 650,
            'image' => 'thakali_set.jpg',
            'restaurant_id' => 3,
            'food_type_id' => 3,
            'cuisine_type_id' => 1,
            'tag_id' => 3,
            'user_id' => 20,
            'created_at' => now()->subDays(20),
            'updated_at' => now()->subDays(20),
        ]);
        
        FoodPosts::create([
            'name' => 'Sel Roti and Aalu Achaar',
            'rating' => 3,
            'review' => 'Crispy sel roti paired with tangy potato pickle, perfect breakfast.',
            'price' => 150,
            'image' => 'sel_roti.jpg',
            'restaurant_id' => 4,
            'food_type_id' => 4,
            'cuisine_type_id' => 1,
            'tag_id' => 4,
            'user_id' => 3,
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(30),
        ]);

        FoodPosts::create([
            'name' => 'Chatamari',
            'rating' => 4,
            'review' => 'The Nepali pizza! Thin, crispy, and full of flavors.',
            'price' => 250,
            'image' => 'chatamari.jpg',
            'restaurant_id' => 5,
            'food_type_id' => 2,
            'cuisine_type_id' => 2,
            'tag_id' => 5,
            'user_id' => 4,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        FoodPosts::create([
            'name' => 'Yomari',
            'rating' => 3,
            'review' => 'Sweet steamed dumplings filled with molasses, a must-try!',
            'price' => 110,
            'image' => 'yomari.jpg',
            'restaurant_id' => 6,
            'food_type_id' => 3,
            'cuisine_type_id' => 1,
            'tag_id' => 6,
            'user_id' => 2,
            'created_at' => now()->subDays(8),
            'updated_at' => now()->subDays(8),
        ]);

        FoodPosts::create([
            'name' => 'Mixed Laphing',
            'rating' => 4,
            'review' => 'Sweet steamed dumplings filled with molasses, a must-try!',
            'price' => 120,
            'image' => 'yomari.jpg',
            'restaurant_id' => 19,
            'food_type_id' => 3,
            'cuisine_type_id' => 1,
            'tag_id' => 6,
            'user_id' => 2,
            'created_at' => now()->subDays(8),
            'updated_at' => now()->subDays(8),
        ]);

        FoodPosts::create([
            'name' => 'Juju Dhau',
            'rating' => 4,
            'review' => 'Rich and creamy yogurt, a specialty of Bhaktapur.',
            'price' => 80,
            'image' => 'juju_dhau.jpg',
            'restaurant_id' => 9,
            'food_type_id' => 4,
            'cuisine_type_id' => 1,
            'tag_id' => 9,
            'user_id' => 15,
            'created_at' => now()->subDays(18),
            'updated_at' => now()->subDays(18),
        ]);
        FoodPosts::create([
            'name' => 'California Roll Non-Veg',
            'rating' => 5,
            'review' => 'Fresh and flavorful sushi rolls with a variety of toppings.',
            'price' => 1200,
            'image' => 'sushi.jpg',
            'restaurant_id' => 8,
            'food_type_id' => 2,
            'cuisine_type_id' => 7,
            'tag_id' => 2,
            'user_id' => 3,
            'created_at' => now()->subDays(18),
            'updated_at' => now()->subDays(18),
        ]);

        FoodPosts::create([
            'name' => 'Kappa Maki Cucumber Roll',
            'rating' => 5,
            'review' => 'Fresh and flavorful sushi rolls with a variety of toppings.',
            'price' => 1200,
            'image' => 'sushi.jpg',
            'restaurant_id' => 8,
            'food_type_id' => 2,
            'cuisine_type_id' => 7,
            'tag_id' => 1,
            'user_id' => 22,
            'created_at' => now()->subDays(18),
            'updated_at' => now()->subDays(18),
        ]);

        FoodPosts::create([
            'name' => 'Chicken Spring Roll',
            'rating' => 3,
            'review' => 'Fresh and flavorful sushi rolls with a variety of toppings.',
            'price' => 1200,
            'image' => 'sushi.jpg',
            'restaurant_id' => 16,
            'food_type_id' => 2,
            'cuisine_type_id' => 6,
            'tag_id' => 5,
            'user_id' => 22,
            'created_at' => now()->subDays(18),
            'updated_at' => now()->subDays(18),
        ]);

        FoodPosts::create([
            'name' => 'Sweet and Sour Chicken',
            'rating' => 4,
            'review' => 'Classic Chinese dish with a perfect balance of sweetness and tanginess.',
            'price' => 550,
            'image' => 'sweet_sour_chicken.jpg',
            'restaurant_id' => 15,
            'food_type_id' => 2,
            'cuisine_type_id' => 6, 
            'tag_id' => 6,
            'user_id' => 14,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        FoodPosts::create([
            'name' => 'Bibimbap',
            'rating' => 4,
            'review' => 'A colorful Korean rice dish mixed with veggies, meat, and egg.',
            'price' => 550,
            'image' => 'sweet_sour_chicken.jpg',
            'restaurant_id' => 24,
            'food_type_id' => 2,
            'cuisine_type_id' => 2,
            'tag_id' => 6,
            'user_id' => 14,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        FoodPosts::create([
            'name' => 'Kimchi Fried Rice',
            'rating' => 5,
            'review' => 'Classic Chinese dish with a perfect balance of sweetness and tanginess.',
            'price' => 550,
            'image' => 'sweet_sour_chicken.jpg',
            'restaurant_id' => 24,
            'food_type_id' => 2,
            'cuisine_type_id' => 2,
            'tag_id' => 7,
            'user_id' => 24,
            'created_at' => now()->subDays(5),
            'updated_at' => now()->subDays(5),
        ]);

        FoodPosts::create([
            'name' => 'Pasta Carbonara',
            'rating' => 3,
            'review' => 'Creamy and flavorful pasta with pancetta, egg, and cheese.',
            'price' => 700,
            'image' => 'pasta_carbonara.jpg',
            'restaurant_id' => 12,
            'food_type_id' => 2,
            'cuisine_type_id' => 4,
            'tag_id' => 12,
            'user_id' => 5,
            'created_at' => now()->subDays(7),
            'updated_at' => now()->subDays(7),
        ]);

        FoodPosts::create([
            'name' => 'Pizza Margherita',
            'rating' => 2,
            'review' => 'Classic Italian pizza with fresh mozzarella, basil, and tomato sauce.',
            'price' => 800,
            'image' => 'pizza_margherita.jpg',
            'restaurant_id' => 11,
            'food_type_id' => 2,
            'cuisine_type_id' => 4,
            'tag_id' => 17,
            'user_id' => 4,
            'created_at' => now()->subDays(8),
            'updated_at' => now()->subDays(8),
        ]);

        FoodPosts::create([
            'name' => 'Lasagna',
            'rating' => 5,
            'review' => 'Rich and layered lasagna with meat, cheese, and tomato sauce.',
            'price' => 900,
            'image' => 'lasagna.jpg',
            'restaurant_id' => 13,
            'food_type_id' => 3,
            'cuisine_type_id' => 4,
            'tag_id' => 13,
            'user_id' => 25,
            'created_at' => now()->subDays(6),
            'updated_at' => now()->subDays(6),
        ]);

        FoodPosts::create([
            'name' => 'Chatpate',
            'rating' => 1,
            'review' => 'A spicy and tangy mixture of puffed rice, spices, and lime.',
            'price' => 40,
            'image' => 'chatpate.jpg',
            'restaurant_id' => 3,
            'food_type_id' => 3,
            'cuisine_type_id' => 8,
            'tag_id' => 16,
            'user_id' => 2,
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(10),
        ]);

        FoodPosts::create([
            'name' => 'Panipuri',
            'rating' => 5,
            'review' => 'Crispy puris filled with tangy and spicy flavored water!',
            'price' => 50,
            'image' => 'panipuri.jpg',
            'restaurant_id' => 2,
            'food_type_id' => 3,
            'cuisine_type_id' => 8, 
            'tag_id' => 11,
            'user_id' => 21,
            'created_at' => now()->subDays(12),
            'updated_at' => now()->subDays(12),
        ]);
    }
}
