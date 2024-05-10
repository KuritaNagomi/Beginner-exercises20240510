@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users_record.css')}}">
@endsection

@section('content')
<div class="users_record-heading">
    <h2>{{ $user->name }}</h2>
</div>
<table class="employees__table">
    <tr class="employees__row">
        <th class="employees__label">出勤日</th>
        <th class="employees__label">出勤時間</th>
        <th class="employees__label">退勤時間</th>
        <th class="employees__label">休憩時間</th>
        <th class="employees__label">勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)
    <tr class="employees__row">
        <td class="employees__data">{{ $attendance->start_time->format('Y年m月d日') }}</td>
        <td class="employees__data">{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') }}</td>
        <td class="employees__data">{{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') }}</td>
        <td class="employees__data">{{ $attendance->rest_duration }}</td>
        <td class="employees__data">{{ $attendance->total_work_duration }}</td>
    </tr>
    @endforeach
</table>
<div class="pagination">{{ $attendances->links('vendor.pagination.custom') }}
</div>
@endsection