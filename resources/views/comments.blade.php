@extends('layouts.site')
@section('title')
    Comments
@endsection

@section('content')

@foreach($comments as $comment)
    <h3>RESTAURANT:  {{$comment->restaurant->name}}</h3>
    <h4>SHORT DESCRIPTION: </h4><p>{{$comment->restaurant->short_description}}</p>
    <h4>YOUR COMMENT: </h4><p>{{$comment->comment}}</p>
@endforeach
    @endsection