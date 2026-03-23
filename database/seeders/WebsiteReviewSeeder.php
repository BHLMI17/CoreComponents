<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('website_reviews')->insert([
            [
                'user_name' => 'Vangelis Fafoutis',
                'rating' => 5,
                'comment' => 'The website is clean, fast, and easy to navigate. Checkout was smooth and the product arrived quickly. Would give this group 100% each on their final mark.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'James Turner',
                'rating' => 5,
                'comment' => 'Fantastic website! Smooth checkout, fast loading, and great product selection.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Aisha Khan',
                'rating' => 4,
                'comment' => 'Great experience overall. Customer support was quick and helpful.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Michael Roberts',
                'rating' => 5,
                'comment' => 'One of the best tech stores online. Easy to navigate and trustworthy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_name' => 'Emily Carter',
                'rating' => 3,
                'comment' => 'Good website but could improve the mobile layout. Still a solid experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}