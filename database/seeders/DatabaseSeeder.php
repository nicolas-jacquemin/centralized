<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::whereRole('admin')->count() === 0) {
            $seed = Str::random(10);
            $password = Str::random(25);
            User::factory()->create([
                'name' => 'Admin',
                'email' => "$seed@email.com",
                'role' => 'admin',
                'password' => bcrypt($password),
            ]);

            echo("Admin user created with email: $seed@email.com and password: $password\n");
        }
    }
}
