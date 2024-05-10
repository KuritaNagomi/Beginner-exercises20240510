@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css')}}">
@endsection

@section('content')
<div class="date-heading">
    <a class="arrow-date"  href="{{ route('date.index', ['date' => \Carbon\Carbon::parse($today)->subDay()->toDateString()]) }}">＜</a>
    <h2>{{ $today }}</h2>
    <a class="arrow-date"  href="{{ route('date.index', ['date' => \Carbon\Carbon::parse($today)->addDay()->toDateString()]) }}">＞</a>
</div>
<table class="employees__table">
    <tr class="employees__row">
        <th class="employees__label">名前</th>
        <th class="employees__label">勤務開始</th>
        <th class="employees__label">勤務終了</th>
        <th class="employees__label">休憩時間</th>
        <th class="employees__label">勤務時間</th>
    </tr>
    @foreach ($usersWithAttendance as $attendance)
        <tr class="employees__row">
            <td class="employees__data">{{ $attendance->user->name }}</td>
            <td class="employees__data">{{ \Carbon\Carbon::parse($attendance->start_time)->format('H:i:s') }}</td>
            <td class="employees__data">
                @if($attendance->end_time)
                    {{ \Carbon\Carbon::parse($attendance->end_time)->format('H:i:s') }}
                @else
                    00:00:00
                @endif
            </td>
            <td class="employees__data">{{ $attendance->rest_duration }}</td>
            <td class="employees__data">{{ $attendance->total_work_duration }}</td>
        </tr>
    @endforeach
</table>
<div class="pagination">{{ $usersWithAttendance->links('vendor.pagination.custom') }}
</div>

@endsection