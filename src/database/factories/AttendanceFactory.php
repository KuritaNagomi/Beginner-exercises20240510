<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attendance;
use Carbon\Carbon;
use App\Models\User;


class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        $user_id = User::inRandomOrder()->first()->id;

        $attendance_date = Carbon::today()->subDays(rand(0, 7));

        $start_time = Carbon::createFromTime(8, 0, 0)->addMinutes(rand(0, 120));

        $end_time = Carbon::parse($start_time)->addHours(rand(5, 12));

        $end_time->setDate($start_time->year, $start_time->month, $start_time->day);

        return [
            'user_id' => $user_id,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
    }
}
