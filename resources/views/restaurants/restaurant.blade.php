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
            @if(Auth::user())
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
                                <p><textarea rows="3" id="comment" cols="100" name="comment"></textarea></p>
                            </div>
                            <button type="submit" class="btn btn-primary">Відправити</button>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endif
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

                            @if($comment->children_comments() != null)
                                <p align="right" class="answers" comment-id = "{{$comment->id}}">Відповіді</p>
                                @foreach($comment->children_comments() as $children_comment)
                                    <p class="children_comments comment{{$comment->id}}"><b>{{$children_comment->user->first_name}}</b> => {{$children_comment->comment}}</p>
                                    <a  class="btn parent_comment children_comments comment{{$comment->id}}" data-user-id="{{$comment->id}}"
                                        data-user-name="{{$children_comment->user->first_name}}">Відповісти</a>
                                @endforeach
                            @endif
                            {{--{{$comment->children_comments()}}--}}

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



@endsection