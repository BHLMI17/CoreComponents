<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the database seeders run successfully and populate data.
     */
    public function test_database_seeders_populate_data(): void
    {
        // Run the seeders
        $this->seed();

        // Assert that the admin users defined in DatabaseSeeder are created
        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'bilalhussain.lmi@gmail.com',
            'role' => 'admin',
        ]);
        
        // Assert that products were seeded by checking if the table is not empty
        $this->assertTrue(Product::count() > 0, 'Products table should not be empty after seeding.');
    }
}
