@extends('layouts.site')
@section('title')
    Comments
@endsection

@section('content')
    <div class="row">
@foreach($comments as $comment)
    <div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading"><h4> <span class="label label-info">РЕСТОРАН : {{$comment->restaurant->name}}</span></h4></div>
        <div class="panel-body">

            <span class="label label-primary">Ваш коментар: </span><br /><br /><p>{{$comment->comment}}</p>
            <p align="right"><span class="label label-success">{{$comment->created_at}}</span></p>
        </div>
    </div>
    </div>
@endforeach
    </div>
    @endsection