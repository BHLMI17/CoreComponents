<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use Database\Seeders\ProductSeeder;

class ProductListingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the product listing page loads successfully.
     */
    public function test_product_listing_page_loads_correctly(): void
    {
        // Seed the products
        $this->seed(ProductSeeder::class);

        // Fetch a product to verify it appears on the page
        $product = Product::first();

        // Make a GET request to the products listing page
        $response = $this->assertDatabaseCount('products', Product::count());
        $response = $this->get('/products');

        // Assert the page loads successfully
        $response->assertStatus(200);

        // Assert the product name appears on the page (assuming the view renders it)
        $response->assertSee($product->name);
    }
}
