@extends('layouts.site')
@section('title')
    Marks
@endsection

@section('content')


@foreach($marks as $mark)
    <h3>RESTAURANT:  {{$mark->restaurant->name}}</h3>
    <h4>SHORT DESCRIPTION: </h4><p>{{$mark->restaurant->short_description}}</p>
    <h4>YOUR MARK: {{$mark->mark}}</h4>
@endforeach
    @endsection