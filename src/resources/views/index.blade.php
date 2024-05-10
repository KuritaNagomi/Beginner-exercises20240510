@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="content-heading">
    <h2><?php $user = Auth::user(); ?>{{ $user->name }}さんお疲れ様です！</h2>
</div>
<div class="content">
    @if (session('my_status'))
    <div class="alert-success">
        {{ session('my_status') }}
    </div>
    @endif @if (session('error'))
    <div class="alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="attendance">
        <form class="punch-in" name="punch-in" method="post" action="/punchin">
            @csrf
            <input type="submit" name="punch-in" value="勤務開始">
        </form>
        <form class="punch-out" name="punch-out" method="post" action="/punchout">
            @csrf
            <input type="submit" name="punch-out" value="勤務終了">
        </form>
    </div>
    <div class="rest">
        <form class="rest-start" name="rest-start" method="post" action="/reststart">
            @csrf
            <input type="submit" name="rest-start" value="休憩開始">
        </form>
        <form class="rest-end" name="rest-end" method="post" action="/restend">
            @csrf
            <input type="submit" name="rest-end" value="休憩終了">
        </form>
    </div>
</div>
@endsection
