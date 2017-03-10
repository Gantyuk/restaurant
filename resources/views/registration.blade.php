@extends('layouts.site')
@section('title')
    Registration
@endsection

@section('content')
    <form action="{{route('registration')}}" method="post" enctype="multipart/form-data">
        <lable for="first_name">FIRST NAME</lable>
        <input class="form-control" type="text" name="first_name">
        <lable for="last_name">LAST NAME</lable>
        <input class="form-control" type="text" name="last_name">
        <lable for="email">E-MAIL</lable>
        <input class="form-control" type="text" name="email">
        <lable for="password">PASSWORD</lable>
        <input class="form-control" type="password" name="password">
        <lable for="image">IMAGE</lable>
        <input class="form-control" type="file" name="image">
        <br>
        <input type="hidden" name="_token" value="{{Session::token()}}">
        {{csrf_field()}}
        <input class="form-control btn btn-primary" type="submit" value="REGISTRATION">
    </form>
@endsection