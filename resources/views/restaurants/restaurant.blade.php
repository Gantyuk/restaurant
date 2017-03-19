@extends('layouts.site')
@section('title')
    {{$restaurant->name}}
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h1>{{$restaurant->name}}</h1></div>
        <div class="panel-body">
            <div class="form-group">
                {{--galereia--}}

                @foreach($path_img as $img)
                    <div class="col-md-4 col-sm-3 col-xs-7 thumb">
                        <a class="fancyimage" data-fancybox-group="group" href="{{$img->path}}">
                            <img class="img-responsive" src="{{$img->path}}"/>
                        </a>
                    </div>
                @endforeach


                <script type="text/javascript">
                    $(document).ready(function () {
                        $("a.fancyimage").fancybox();
                    });
                </script>
            </div>
            {{--*****--}}
            <div class="form-group">
                <p> Оцінка: {!! $mark !!}</p>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    Опис:<p>{!! $restaurant->description !!}</p>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <p><label><h4> Коментувати: </h4></label></p>
                    <img for="comment" src="{{ Auth::user()->path_img }}" align="left" width="100px" height="100px"
                         class="img-circle">
                    <form action="{{route('add_comment')}}" method="post">

                        <div class="form-group">
                            <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">
                            <input type="hidden" name="parent_id" id="parent_id" value="0">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <p><textarea rows="3" cols="100" name="comment" id = "comment"></textarea></p>
                        </div>
                        <button type="submit" class="btn btn-primary">Відправити</button>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <div class="form-group">

                @foreach($comments as $comment)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="{{ $comment->user->path_img }}" align="left" width="100px" height="100px"
                                 class="img-circle">
                            <h4>{{$comment->user->first_name}}</h4>
                            <p>{{$comment->comment}}</p>
                            <a class="parent_comment btn btn-info" data-user-id="{{$comment->user->id}}"
                               data-user-name="{{$comment->user->first_name}}">Відповісти</a>
                            <p align="right">{{$comment->created_at}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection