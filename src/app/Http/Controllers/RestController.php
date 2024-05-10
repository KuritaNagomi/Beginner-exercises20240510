<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;

class RestController extends Controller
{
    public function restStart()
    {
        $user = Auth::user();

        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('start_time', $today)->first();

        if(!$attendance){
            return redirect()->back()->with('error', '出勤打刻がされていません');
        }

        $restEnd = Rest::where('attendance_id', $attendance->id)->whereNull('end_time')->first();

    if ($restEnd) {
        return redirect()->back()->with('error', '休憩終了を打刻してください');
    }

        $restStart = new Rest([
            'attendance_id' => $attendance->id,
            'start_time' => Carbon::now(),
        ]);
        $restStart->save();

        return redirect()->back()->with ('my_status', '休憩を開始します');
    }

    public function restEnd()
    {
        $user = Auth::user();

        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)->whereDate('start_time', $today)->first();

        if(!$attendance){
            return redirect()->back()->with('error', '出勤打刻がされていません');
        }

        $restStart = Rest::where('attendance_id', $attendance->id)->whereDate('start_time', $today)->whereNull('end_time')->latest()->first();

        if(!$restStart){
            return redirect()->back()->with('error', '休憩開始打刻がされていません');
        }

        $restStart->end_time = Carbon::now();
        $restStart->save();

        return redirect()->back()->with('my_status', '休憩を終了します');
    }

}
