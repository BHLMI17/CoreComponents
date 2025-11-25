<?php



// database/seeders/ProductSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Wireless Mouse',
            'description' => 'Ergonomic wireless mouse with long battery life.',
            'price' => 29.99,
            'image_url' => '/images/mouse.jpg',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard',
            'description' => 'RGB backlit mechanical keyboard with blue switches.',
            'price' => 89.99,
            'image_url' => '/images/keyboard.jpg',
            'stock' => 30,
        ]);
    }
}