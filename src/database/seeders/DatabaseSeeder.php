<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(30)->create()->each(function ($user) {
            $attendance = Attendance::factory()->create([
                'user_id' => $user->id,
            ]);

        Rest::factory(rand(1, 5))->create([
                'attendance_id' => $attendance->id,
            ]);
        });
    }
}