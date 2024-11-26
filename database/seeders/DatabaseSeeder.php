<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in a specific order
        $this->call([
            UserSeeder::class,      // Populate the users table first
            CourseSeeder::class,    // Populate the courses table
            LocalSeeder::class,    // Populate the courses table
            RoomSeeder::class,      // Populate the rooms table
            ReservationSeeder::class,  // Populate the reservation table with relations
        ]);

        $this->command->info('Database seeding completed successfully!');
    }
}
