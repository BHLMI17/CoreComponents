<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure products exist before seeding reviews
        $productIds = DB::table('products')->pluck('id');

        if ($productIds->isEmpty()) {
            $this->command->warn('No products found. Skipping review seeding.');
            return;
        }

        foreach ($productIds as $productId) {
            DB::table('reviews')->insert([
                [
                    'product_id' => $productId,
                    'user_name' => 'John Doe',
                    'rating' => rand(3, 5),
                    'title' => 'Amazing GPU!',
                    'comment' => 'This graphics card exceeded my expectations. Runs cool and quiet.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $productId,
                    'user_name' => 'Sarah Smith',
                    'rating' => rand(1, 5),
                    'title' => 'Solid performance',
                    'comment' => 'Good value for money. Performs well in modern games.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'product_id' => $productId,
                    'user_name' => 'Alex Johnson',
                    'rating' => rand(2, 5),
                    'title' => 'Not bad',
                    'comment' => 'Decent card but could be quieter under load.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}