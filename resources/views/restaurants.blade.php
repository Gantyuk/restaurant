@extends('layouts.site')
@section('title')
    Restaurants
@endsection

@section('adds')
    @if(!\Illuminate\Support\Facades\Auth::check())

    @else
            @endif

@endsection