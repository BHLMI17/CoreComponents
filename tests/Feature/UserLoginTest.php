<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can successfully log in with correct credentials.
     */
    public function test_user_can_login_with_correct_credentials(): void
    {
        // Create a user in the database
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Attempt to log in
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Assert the user is authenticated
        $this->assertAuthenticatedAs($user);
        
        // Assert redirect (assuming redirect to home or intended url)
        $response->assertStatus(302);
    }

    /**
     * Test that a user cannot log in with incorrect credentials.
     */
    public function test_user_cannot_login_with_incorrect_credentials(): void
    {
        // Create a user in the database
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Attempt to log in with the wrong password
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        // Assert the user is not authenticated
        $this->assertGuest();
    }
}
