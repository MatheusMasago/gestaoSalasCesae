<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Get data from related tables
        $users = DB::table('users')->pluck('id');
        $courses = DB::table('courses')->pluck('id');
        $rooms = DB::table('rooms')->pluck('id');

        // Check if there are related records to link
        if ($users->isEmpty() || $courses->isEmpty() || $rooms->isEmpty()) {
            $this->command->error('Please seed the users, courses, and rooms tables first.');
            return;
        }

        // Insert 20 random reservations
        foreach (range(1, 20) as $index) {
            $date = Carbon::today()->addDays(rand(0, 30)); // Random date within the next 30 days
            $startTime = Carbon::createFromTime(rand(8, 15), 0); // Random time between 8 AM and 3 PM
            $endTime = (clone $startTime)->addHours(rand(1, 3)); // End time is 1-3 hours later

            DB::table('reservations')->insert([
                'date' => $date->toDateString(),
                'start_time' => $startTime->toTimeString(),
                'end_time' => $endTime->toTimeString(),
                'status' => 'pending',
                'id_user' => $users->random(),
                'id_course' => $courses->random(),
                'id_room' => $rooms->random()
            ]);
        }

        $this->command->info('Schedule table seeded successfully!');
    }
}
