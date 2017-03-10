@extends('layouts.site')
@section('title')
    Authentication
@endsection

@section('content')
    <form action="{{route('authentication')}}" method="post">
        <lable for="email">E-MAIL</lable>
        <input class="form-control" type="text" name="email">
        <lable for="password">PASSWORD</lable>
        <input class="form-control" type="password" name="password">
        <br>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        {{csrf_field()}}
        <input class="form-control btn btn-primary" type="submit" value="AUTHENTICATION">
    </form>
@endsection