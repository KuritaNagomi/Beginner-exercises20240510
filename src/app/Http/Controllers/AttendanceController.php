<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function punchIn()
    {
        $user = Auth::user();

        $oldAttendance = Attendance::where('user_id', $user->id)->latest()->first();

        if ($oldAttendance && $oldAttendance->start_time->format('Y-m-d') == Carbon::today()->format('Y-m-d')) {
            return redirect()->back()->with('error', 'すでに出勤打刻がされています');
        }

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('my_status', '出勤打刻が完了しました');
    }

    public function punchOut()
    {
        $user = Auth::user();

        $attendance = Attendance::where('user_id', $user->id)->latest()->first();

        if (!$attendance || !empty($attendance->end_time)) {
            return redirect()->back()->with('error', 'すでに退勤打刻がされているか、出勤打刻がされていません');
        }

        $attendance->update([
            'end_time' => Carbon::now()
        ]);

        return redirect()->back()->with('my_status', '退勤打刻が完了しました');
    }
}
