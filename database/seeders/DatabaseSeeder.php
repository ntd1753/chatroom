<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TODO: Seed 5 user account
        for($i=1; $i<= 5; $i++){
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@gmail.com',
                'password' => bcrypt('123456789')]);
        }

        // TODO: Seed 5 Room
        for($i=1; $i<= 5; $i++){
            Room::create([
                'name' => 'Room ' . $i,
                'icon' => '/images/avatar.jpg',
                'description' => 'Chat for all',
                'owner_id' => $i
            ]);
        }
    }
}
