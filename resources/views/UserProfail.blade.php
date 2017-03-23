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

                    {{--<form class="form-horizontal" role="form" action="{{route('update_profile')}}" method="post"--}}
                    {{--enctype="multipart/form-data">--}}
                    {{--<input type="hidden" name="id" value="{{$user->id}}">--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="first_name" class="col-md-4 control-label">Ім'я</label>--}}

                    {{--<div class="col-md-6">--}}
                    {{--<input id="first_name" type="text" class="form-control" name="first_name"--}}
                    {{--value="{{ $user->first_name }}" autofocus>--}}

                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<label for="last_name" class="col-md-4 control-label">Прізвище</label>--}}

                    {{--<div class="col-md-6">--}}
                    {{--<input id="last_name" type="text" class="form-control" name="last_name"--}}
                    {{--value="{{ $user->last_name }}" autofocus>--}}

                    {{--</div>--}}
                    {{--</div>--}}
                    {{--{{ csrf_field() }}--}}

                    {{--@if($user->path_img != '')--}}

                    {{--<div class="form-group"><br>--}}
                    {{--<label for="image" class="col-md-4 control-label">Зображення:</label>--}}
                    {{--<img src="{{ $user->path_img }}" alt="" width="100px" height="100px" class="img-circle">--}}

                    {{--</div>--}}
                    {{--@endif--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="image" class="col-md-4 control-label">Змінити зображення:</label>--}}
                    {{--<div class="col-md-6">--}}
                    {{--<input id="image" class="form-control" type="file" name="image" accept="image/*"--}}
                    {{--value="{{ $user->path_img }}" autofocus>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                    {{--<div class="col-md-6 col-md-offset-4">--}}
                    {{--<button type="submit" class="btn btn-primary">--}}
                    {{--Внести Зміни--}}
                    {{--</button>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
