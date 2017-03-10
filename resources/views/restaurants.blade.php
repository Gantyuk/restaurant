@extends('layouts.site')
@section('title')
    Restaurants
@endsection

@section('adds')
    <form action="{{route('authentication')}}" method="get">
        <input type="submit" value="Sing in">
    </form>
    <form action="{{route('registration')}}" method="get">
        <input type="submit" value="Sing up">
    </form>


@endsection