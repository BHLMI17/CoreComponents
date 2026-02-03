<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Razer Basilisk V3 X HyperSpeed',
            'description' => 'Wireless ergonomic gaming mouse with long battery life.',
            'price' => 34.99,
            'image_url' => '/images/Razer Basilisk V3 X HyperSpeed.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'mouse',
        ]);

        Product::create([
            'name' => 'Razer DeathAdder V4 Pro',
            'description' => 'High‑precision wireless gaming mouse with advanced optical switches.',
            'price' => 139.99,
            'image_url' => '/images/Razer DeathAdder V4 Pro.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'mouse',
        ]);

        Product::create([
            'name' => 'AMD Ryzensets 7 5800X',
            'description' => 'High‑performance 8‑core CPU designed for gaming and productivity.',
            'price' => 139.99,
            'image_url' => '/images/AMD Ryzensets 7 5800X.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'cpu',
        ]);

        Product::create([
            'name' => 'Intel Core i7 13700F',
            'description' => 'Powerful Intel CPU ideal for gaming and multitasking workloads.',
            'price' => 299.99,
            'image_url' => '/images/Intel Core i7 13700F.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'cpu',
        ]);

        Product::create([
            'name' => 'Logitech G413 TKL SE Mechanical Gaming Keyboard',
            'description' => 'Durable tenkeyless mechanical keyboard with tactile switches.',
            'price' => 34.99,
            'image_url' => '/images/Logitech G413 TKL SE Mechanical Gaming Keyboard.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux', 'mac'],
            'type' => 'keyboard',
        ]);

        Product::create([
            'name' => 'ASUS ROG Azoth 75% Wireless DIY Custom Gaming Keyboard',
            'description' => 'Premium 75% wireless mechanical keyboard with hot‑swappable switches.',
            'price' => 149.99,
            'image_url' => '/images/ASUS ROG Azoth 75% Wireless DIY Custom Gaming Keyboard.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'keyboard',
        ]);

        Product::create([
            'name' => 'MSI GeForce RTX 5060 8G SHADOW 2X OC Graphics Card',
            'description' => 'Overclocked RTX 5060 GPU with dual‑fan cooling for smooth gaming.',
            'price' => 249.99,
            'image_url' => '/images/MSI GeForce RTX 5060 8G SHADOW 2X OC Graphics Card.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'gpu',
        ]);

        Product::create([
            'name' => 'Powercolor Radeon RX 9060 XT HellHound OC 16GB GDDR6 Graphics Card',
            'description' => 'High‑end Radeon GPU with 16GB VRAM and custom HellHound cooling.',
            'price' => 259.99,
            'image_url' => '/images/Powercolor Radeon RX 9060 XT HellHound OC 16GB GDDR6 Graphics Card.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'gpu',
        ]);

        Product::create([
            'name' => 'PHILIPS 24E1N1100A',
            'description' => '24‑inch Full HD monitor with vibrant colours and slim bezels.',
            'price' => 54.99,
            'image_url' => '/images/PHILIPS 24E1N1100A.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac', 'linux'],
            'type' => 'monitor',
        ]);

        Product::create([
            'name' => 'KOORUI G2411P 24 Inch Gaming Monitor',
            'description' => '24‑inch gaming monitor with fast refresh rate and sharp visuals.',
            'price' => 149.99,
            'image_url' => '/images/KOORUI G2411P 24 Inch Gaming Monitor.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'monitor',
        ]);

                Product::create([
            'name' => 'Logitech G Pro X Superlight',
            'description' => 'Ultra-light wireless esports mouse.',
            'price' => 129.99,
            'image_url' => '/images/Logitech G Pro X Superlight.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'mouse',
        ]);

        Product::create([
            'name' => 'SteelSeries Rival 3',
            'description' => 'Lightweight RGB gaming mouse.',
            'price' => 29.99,
            'image_url' => '/images/SteelSeries Rival 3.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'mouse',
        ]);

        Product::create([
            'name' => 'Glorious Model O',
            'description' => 'Honeycomb lightweight mouse with RGB.',
            'price' => 49.99,
            'image_url' => '/images/Glorious Model O.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac', 'linux'],
            'type' => 'mouse',
        ]);

        Product::create([
            'name' => 'Corsair K70 RGB MK.2',
            'description' => 'Mechanical keyboard with per-key RGB.',
            'price' => 149.99,
            'image_url' => '/images/Corsair K70 RGB MK2.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'keyboard',
        ]);

        Product::create([
            'name' => 'Razer Huntsman Mini',
            'description' => 'Compact 60% keyboard with optical switches.',
            'price' => 109.99,
            'image_url' => '/images/Razer Huntsman Mini.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'keyboard',
        ]);

        Product::create([
            'name' => 'Keychron K2',
            'description' => 'Wireless mechanical keyboard, compact layout.',
            'price' => 89.99,
            'image_url' => '/images/Keychron K2.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac', 'linux'],
            'type' => 'keyboard',
        ]);

        Product::create([
            'name' => 'AMD Ryzen 5 7600X',
            'description' => '6-core CPU great for gaming and productivity.',
            'price' => 229.99,
            'image_url' => '/images/AMD Ryzen 5 7600X.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'cpu',
        ]);

        Product::create([
            'name' => 'Intel Core i5-13600K',
            'description' => 'High performance hybrid CPU for gaming.',
            'price' => 289.99,
            'image_url' => '/images/Intel Core i5 13600K.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'cpu',
        ]);

        Product::create([
            'name' => 'AMD Ryzen 9 7900X',
            'description' => '12-core high-end CPU for heavy workloads.',
            'price' => 399.99,
            'image_url' => '/images/AMD Ryzen 9 7900X.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'cpu',
        ]);

        Product::create([
            'name' => 'NVIDIA GeForce RTX 4070',
            'description' => 'Powerful GPU for 1440p gaming.',
            'price' => 599.99,
            'image_url' => '/images/NVIDIA RTX 4070.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'gpu',
        ]);

        Product::create([
            'name' => 'AMD Radeon RX 7800 XT',
            'description' => 'Strong value GPU for high refresh gaming.',
            'price' => 499.99,
            'image_url' => '/images/AMD RX 7800 XT.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'gpu',
        ]);

        Product::create([
            'name' => 'NVIDIA GeForce RTX 4060 Ti',
            'description' => 'Efficient GPU for 1080p/1440p gaming.',
            'price' => 399.99,
            'image_url' => '/images/NVIDIA RTX 4060 Ti.png',
            'stock' => 50,
            'compatibility' => ['windows', 'linux'],
            'type' => 'gpu',
        ]);

        Product::create([
            'name' => 'ASUS TUF VG27AQ',
            'description' => '27-inch 1440p 165Hz gaming monitor.',
            'price' => 299.99,
            'image_url' => '/images/ASUS TUF VG27AQ.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'monitor',
        ]);

        Product::create([
            'name' => 'AOC 24G2',
            'description' => '24-inch 1080p 144Hz IPS gaming monitor.',
            'price' => 159.99,
            'image_url' => '/images/AOC 24G2.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac', 'linux'],
            'type' => 'monitor',
        ]);

        Product::create([
            'name' => 'LG 27GP850',
            'description' => '27-inch 1440p high refresh IPS monitor.',
            'price' => 349.99,
            'image_url' => '/images/LG 27GP850.png',
            'stock' => 50,
            'compatibility' => ['windows', 'mac'],
            'type' => 'monitor',
        ]);

    }
}