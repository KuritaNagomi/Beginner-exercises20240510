<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class DateController extends Controller
{
    public function index (Request $request)
    {
        $today = $request->input('date', now()->toDateString());

        $usersWithAttendance = Attendance::whereDate('start_time', $today)
            ->with('user', 'rest')
            ->paginate(5);

        foreach ($usersWithAttendance as $attendance) {
            $attendance->rest_duration = $this->calculateRestDuration($attendance->rest);

            $attendance->total_work_duration = $this->calculateTotalWorkDuration($attendance->start_time, $attendance->end_time, $attendance->rest_duration);
        }

        return view('date', compact('usersWithAttendance', 'today'));
    }

    private function calculateRestDuration($rest)
    {
        $totalRestDurationSeconds = 0;
        if ($rest !== null && $rest->isNotEmpty()) {
            foreach ($rest as $rest) {
                $restStartTime = \Carbon\Carbon::parse($rest->start_time);
                $restEndTime = \Carbon\Carbon::parse($rest->end_time);
                $totalRestDurationSeconds += $restEndTime->diffInSeconds($restStartTime);
            }
        }

        $restHours = floor($totalRestDurationSeconds / 3600);
        $restMinutes = floor(($totalRestDurationSeconds % 3600) / 60);
        $restSeconds = $totalRestDurationSeconds % 60;

        return sprintf('%02d:%02d:%02d', $restHours, $restMinutes, $restSeconds);
    }

    private function calculateTotalWorkDuration($startTime, $endTime, $restDuration)
    {
        if ($endTime) {
            $totalWorkSeconds = \Carbon\Carbon::parse($endTime)->diffInSeconds($startTime) - \Carbon\Carbon::parse($restDuration)->diffInSeconds(\Carbon\Carbon::createFromTime(0, 0));
        } else {
            $currentTime = now();
            $totalWorkSeconds = $currentTime->diffInSeconds($startTime) - \Carbon\Carbon::parse($restDuration)->diffInSeconds(\Carbon\Carbon::createFromTime(0, 0));
        }

        $totalWorkHours = floor($totalWorkSeconds / 3600);
        $totalWorkMinutes = floor(($totalWorkSeconds % 3600) / 60);
        $totalWorkSeconds = $totalWorkSeconds % 60;

        return sprintf('%02d:%02d:%02d', $totalWorkHours, $totalWorkMinutes, $totalWorkSeconds);
    }
}


