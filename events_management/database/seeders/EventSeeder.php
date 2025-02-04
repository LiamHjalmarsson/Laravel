<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Event owned by user 
        // every event need to be tied to a specific user an owner and and organizer of that event s

        $users = User::all();

        for ($i = 0; $i < 200; $i++) {
            $user = $users->random();
            \App\Models\Event::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
