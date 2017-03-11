@extends('layouts.site')
@section('title')
    Restaurants
@endsection

@section('adds')
    @if(!\Illuminate\Support\Facades\Auth::check())
        <form action="{{route('authentication')}}" method="get">
            <input type="submit" value="Sing in">
        </form>
        <form action="{{route('registration')}}" method="get">
            <input type="submit" value="Sing up">
        </form>
    @else
        <form action="{{route('logout')}}" method="get">
            <input type="submit" value="Log out">
        </form>
    @endif

@endsection