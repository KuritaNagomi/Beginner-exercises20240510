@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css')}}">
@endsection

@section('content')
<div class="user-heading">
    <h2>社員一覧</h2>
</div>
<table class="employees__table">
    <tr class="employees__row">
        <th class="employees__label">名前</th>
        <th class="employees__label">メールアドレス</th>
        <th class="employees__label">登録日</th>
    </tr>
    @foreach($users as $user)
    <tr class="employees__row">
        <td class="employees__data">
            <a class="link"  href="{{ route('user.record', ['id' => $user->id]) }}">{{$user->name}}</a>
        </td>
        <td class="employees__data">{{$user->email}}</td>
        <td class="employees__data">{{$user->created_at}}</td>
    </tr>
    @endforeach
</table>
<div class="pagination">{{ $users->links('vendor.pagination.custom') }}
</div>
@endsection