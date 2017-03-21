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

                @foreach($restaurant->images as $img)
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
                <p> Оцінка: </p>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    Опис:<p>{!! $restaurant->description !!}</p>
                </div>
                <div class="form-group">
                    <div id="map_canvas"
                         style="width: 50%;height: 30%; margin-left: 2%; background-color: #66afe9;float: left">
                    </div>
                    <div style="width: 45%;height: 30%;position:relative; margin-left:54%;overflow-y: scroll">
                        <b>Адреси</b>
                        <ul class="list-group">
                            @foreach($restaurant->addresses as $address)
                                <li class="list-group-item">{{$address->street}} дім № {{$address->house}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <script>

                    var myLatlng = new google.maps.LatLng({{$restaurant->addresses[0]->lat}},{{$restaurant->addresses[0]->lng}}),
                        mapOptions = {
                            zoom: 10,
                            center: myLatlng
                        },
                        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
                        marker = new google.maps.Marker({
                            position: myLatlng,
                            map: map,
                            title: ''
                        });
                            @foreach($restaurant->addresses as $address)
                    var centerLatLng = new google.maps.LatLng({{$address->lat}},{{$address->lng}});
                    var markers = new google.maps.Marker({
                        position: centerLatLng,
                        map: map
                    });
                    map.setZoom(17);
                    marker.push(markers);
                    @endforeach

                </script>


                @if(Auth::user())
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @for($i=1;$i<6;$i++)
                                <span id="{{$i}}" class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                            @endfor
                            <p><label><h4> Коментувати: </h4></label></p>
                            <img for="comment" src="{{ Auth::user()->path_img }}" align="left" width="100px"
                                 height="100px"
                                 class="img-circle">
                            <div class="form-groupe"></div>
                            <form action="{{route('add_comment')}}" method="post">

                                <div class="form-group">
                                    <input type="hidden" id="restaurant_id" name="restaurant_id" value="{{$restaurant->id}}">
                                    <input type="hidden" name="parent_id" id="parent_id" value="0">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                    <p align="right" class="answers" comment-id="{{$comment->id}}">Відповіді</p>
                                    @foreach($comment->children_comments() as $children_comment)
                                        <p class="children_comments comment{{$comment->id}}">
                                            <b>{{$children_comment->user->first_name}}</b>
                                            => {{$children_comment->comment}}</p>
                                        <a class="btn parent_comment children_comments comment{{$comment->id}}"
                                           data-user-id="{{$comment->id}}"
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

    </div>
    <script>
        var token = '{{Session::token()}}';
        var url = '{{route('add_mark')}}';
    </script>

@endsection


