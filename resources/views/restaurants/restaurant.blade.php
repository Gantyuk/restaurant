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
            Опис:<p>{!! $restaurant->description !!}</p>
            <form action="{{route('add_comment')}}" method="post">
            <div class="form-group">
                <label for="comment">Comment:</label>
                <input type="hidden"  name="restaurant_id" value="{{$restaurant->id}}">
                <input type="hidden"  name="user_id" value="{{ Auth::user()->id }}">

                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>



@endsection