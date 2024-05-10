<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rest;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class RestFactory extends Factory
{
    protected $model = Rest::class;

    public function definition()
    {
        $attendance = Attendance::inRandomOrder()->first();

        $start_time = Carbon::parse($attendance->start_time)->addMinutes(rand(30, 180));

        $end_time = Carbon::parse($start_time)->addMinutes(rand(10, 60));

        return [
            'attendance_id' => $attendance->id,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
