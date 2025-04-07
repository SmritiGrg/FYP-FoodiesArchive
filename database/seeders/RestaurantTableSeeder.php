<?php

namespace Database\Seeders;

use App\Models\Restaurants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = [
            ['name' => 'The Garden of Dreams Restaurant', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3165, 'latitude' => 27.7124, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Bhojan Griha', 'location' => 'Kathmandu, Nepal', 'longitude' => 85.3269, 'latitude' => 27.6992, 'added_by_user_id' => 8, 'status' => 'approved'],
            ['name' => 'OR2K', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3087, 'latitude' => 27.7131, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Kaiser Café', 'location' => 'Butwal, Nepal', 'longitude' => 85.3162, 'latitude' => 27.7117, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Thakali Bhanchha Ghar', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3098, 'latitude' => 27.7106, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Nepali Chulo', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3207, 'latitude' => 27.7153, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Dal Bhat Power Restaurant', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3085, 'latitude' => 27.7120, 'added_by_user_id' => 2, 'status' => 'approved'],
            ['name' => 'Himalayan Java Coffee', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3161, 'latitude' => 27.7118, 'added_by_user_id' => 19, 'status' => 'approved'],
            ['name' => 'Roadhouse Café', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3089, 'latitude' => 27.7134, 'added_by_user_id' => 16, 'status' => 'approved'],
            ['name' => 'Krishna Pauroti', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3296, 'latitude' => 27.6896, 'added_by_user_id' => 22, 'status' => 'approved'],
            ['name' => 'Newa Lahana', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3016, 'latitude' => 27.6748, 'added_by_user_id' => 25, 'status' => 'approved'],
            ['name' => 'Samay Baji', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3210, 'latitude' => 27.7060, 'added_by_user_id' => 2, 'status' => 'approved'],
            ['name' => 'The Bakery Café', 'location' => 'Dang, Nepal', 'longitude' => 85.3154, 'latitude' => 27.7109, 'added_by_user_id' => 7, 'status' => 'approved'],
            ['name' => 'Kathmandu Grill', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3101, 'latitude' => 27.7132, 'added_by_user_id' => 12, 'status' => 'approved'],
            ['name' => 'Third Eye Restaurant', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3082, 'latitude' => 27.7131, 'added_by_user_id' => 7, 'status' => 'approved'],
            ['name' => 'Yala Café', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3117, 'latitude' => 27.7172, 'added_by_user_id' => 20, 'status' => 'approved'],
            ['name' => 'Bajeko Sekuwa', 'location' => 'Kathmandu, Nepal', 'longitude' => 85.3093, 'latitude' => 27.7177, 'added_by_user_id' => 7, 'status' => 'approved'],
            ['name' => 'Pumpernickel Bakery', 'location' => 'Chitwan, Nepal', 'longitude' => 85.3086, 'latitude' => 27.7135, 'added_by_user_id' => 2, 'status' => 'approved'],
            ['name' => 'Yangling Tibetan Restaurant', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3094, 'latitude' => 27.7114, 'added_by_user_id' => 13, 'status' => 'approved'],
            ['name' => 'Fire and Ice Pizzeria', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3160, 'latitude' => 27.7122, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Patan Durbar Square Restaurant', 'location' => 'Kathmandu, Nepal', 'longitude' => 85.3241, 'latitude' => 27.6718, 'added_by_user_id' => 12, 'status' => 'approved'],
            ['name' => 'Tukche Thakali Kitchen', 'location' => 'Kathmandu, Nepal', 'longitude' => 85.3074, 'latitude' => 27.7128, 'added_by_user_id' => 5, 'status' => 'approved'],
            ['name' => 'Le Sherpa', 'location' => 'Pokhara, Nepal', 'longitude' => 85.3103, 'latitude' => 27.7256, 'added_by_user_id' => 14, 'status' => 'approved'],
            ['name' => 'Annapurna Food Court', 'location' => 'Lalitpur, Nepal', 'longitude' => 85.3171, 'latitude' => 27.7110, 'added_by_user_id' => 1, 'status' => 'approved'],
            ['name' => 'Everest Momo', 'location' => 'Chitwan, Nepal', 'longitude' => 85.3190, 'latitude' => 27.7105, 'added_by_user_id' => 16, 'status' => 'approved'],
            ['name' => 'Kafe Joy', 'location' => 'Pokhara, Nepal', 'longitude' => 55.3190, 'latitude' => 37.7665, 'added_by_user_id' => 5, 'status' => 'approved'],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurants::create($restaurant);
        }
    }
}
