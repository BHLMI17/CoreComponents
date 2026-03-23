<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        //seed reviews
        $this->call(ReviewSeeder::class);



        // Seed products
        $this->call([
            ProductSeeder::class,
        ]);

        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // unique identifier
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );


        User::updateOrCreate(
            ['email' => 'bilalhussain.lmi@gmail.com'], // unique identifier
            [
                'name' => 'Bilal Hussain',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}