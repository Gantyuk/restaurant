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

                <script src="/jquery/jquery-1.11.2.min.js"></script>
                <script src="/bootstrap-3.3.2/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
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
            Опис:<p>{!! $restaurant->description !!}</p>
            <form action="{{route('add_comment')}}" method="post">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <input type="hidden"  name="restaurant_id" value="{{$restaurant->id}}">
                <input type="hidden"  name="parent_id" id="parent_id" value="0">
                <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">

                <textarea  class="form-control" rows="5" id="comment" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
                {{ csrf_field() }}
            </form>
            <div class="form-group">
                <h3> COMMENTS: </h3>
                @foreach($comments as $comment)
                    <h4>{{$comment->user->first_name}}</h4>
                    <p>{{$comment->comment}}</p>
                    <p class="parent_comment" data-user-id="{{$comment->user->id}}" data-user-name="{{$comment->user->first_name}}">Відповісти</p>
                    <p align="right">{{$comment->created_at}}</p>
                    @endforeach
            </div>
        </div>
    </div>



@endsection