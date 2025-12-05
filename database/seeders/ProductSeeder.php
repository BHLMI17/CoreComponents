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
    }
}