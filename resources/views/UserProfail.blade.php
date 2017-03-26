@extends('layouts.site')
@section('title')
    {{--name--}}
    User Profile
@endsection
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-body">
                <img class = "img-thumbnail"src="{!! $user->path_img!!}" align="left" width="44%">
                <div class="restoran_info">
                    <h3><span class="label label-default">
                        {{$user->first_name}} {{ $user->last_name }}
                    </span></h3><br />

                  <p> <h5> <span class="label label-info">Емаіл: {{$user->email}}</span></h5></p>
                </div>
            </div>
        </div>
    </div>
@endsection
