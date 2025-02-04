<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Game;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        
        Game::factory(100)->create();

        \App\Models\User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'username' => 'xoxo',
            'email' => 'test@example.com',
        ]);
    }
}
