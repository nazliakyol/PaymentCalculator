<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Listing::factory(20)->create();
//        User::factory(50)->create();

        User::factory()->create([
            'name' => 'Nazli Akyol',
            'email' => 'nazlinurakyol@yahoo.com',
            'is_admin' => true,
            'password' => bcrypt('password'),
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);

        Listing::factory(10)->create([
            'by_user_id' => 1,
        ]);

        Listing::factory(10)->create([
            'by_user_id' => 2,
        ]);
    }
}
