<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Basket;
use Database\Seeders\ProductSeeder;

class BasketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a guest user can add a product to their basket.
     */
    public function test_guest_can_add_product_to_basket(): void
    {
        // Seed the database to get a product
        $this->seed(ProductSeeder::class);
        $product = Product::first();

        // Simulate an HTTP POST request to add the product to the basket
        $response = $this->post('/basket/add', [
            'product_id' => $product->id,
        ]);

        // Assert the response is a redirect back with a success session message
        $response->assertStatus(302);
        $response->assertSessionHas('success', 'Added to basket!');

        // Query the database to ensure the basket item was created
        $this->assertDatabaseHas('baskets', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }
}
