@extends('layouts.site')
@section('title')
{{$restaurant->name}}

@endsection

@section('content')
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Докланіше</a></li>
    <li><a data-toggle="tab" href="#menu2">Фотографії</a></li>
    <li><a data-toggle="tab" href="#menu3">Меню</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div class="panel panel-default">
            <div class="panel-heading" style="font-size: 24px">{{$restaurant->name}}</div>

            <div class=" thumb" style="float: none; height:220px; margin-left: 2%">
                <img class="img-responsive col-md-4" width="100%" height="100%"
                     src="{{$restaurant->images[0]->path}}"/>


                <div class="form-group thumb panel panel-default" style="margin-left:35%;margin-right:5%">
                    <div style="width:100%;height:90%">
                        <p> Оцінка: {{@round($restaurant->marks->avg('mark'),2)}} </p>
                        <div class="ln_solid"></div>
                        <p> Категорії:
                           @foreach($restaurant->categories as $category)
                            {{$category->name}},
                            @endforeach
                        </p>
                        @if(Auth::check())
                            <p> Ваша оцінка:
                                @for($i=1;$i<6;$i++)
                                    <span id="{{$i}}" class="glyphicon glyphicon-star-empty"
                                          aria-hidden="true"></span>
                                @endfor
                            </p>
                        @endif
                    </div>
                </div>
            </div>


            <script type="text/javascript">
                $(document).ready(function () {
                    $("a.fancyimage").fancybox();
                });
            </script>

            <div class="panel-body">
                {{--*****--}}

                <div class="panel panel-default" style="float: none">
                    <div class="panel-body">
                        Короткий опис:<p>{!! $restaurant->short_description !!}</p>
                    </div>
                    <br>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div id="map_canvas"
                             style="width: 50%;height: 30%; margin-left: 2%; background-color: #66afe9;float: left">
                        </div>
                        <div style="width: 45%;height: 30%;position:relative; margin-left:54%;overflow-y: scroll">
                            <b>Адреси</b>
                            <ul class="list-group">
                               @foreach( $restaurant->addresses as $address)
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
                        <div class="panel " style="border-top: solid; border-color: whitesmoke">
                            <div class="panel-body">

                                <p><label><h4> Коментувати: </h4></label></p>
                                <img for="comment" src="{{ Auth::user()->path_img }}" align="left" width="50px"
                                     height="50px"
                                     class="img-circle"
                                >
                                <form action="{{route('add_comment')}}" method="post"
                                      class="form-horizontal form-label-left">

                                    <div class="form-group">
                                        <input type="hidden" id="restaurant_id" name="restaurant_id"
                                               value="{{$restaurant->id}}">
                                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                                        <input type="hidden" id="user_id" name="user_id" user-mark = "{{$mark}}"
                                               value="{{ Auth::user()->id }}">
                                        <p >
<textarea rows="2" id="comment" name="comment"
          style="width: 50%;">
</textarea>
                                            <button type="submit" class="btn btn-primary" style="top: 5px">
                                                Відправити
                                            </button>
                                        </p>


                                    </div>

                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">

                        @foreach($comments as $comment)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="{{ $comment->user->path_img }}" align="left" width="80px"
                                     height="80px"
                                     class="img-circle">
                                <h4>{{$comment->user->first_name}}</h4>
                                <p>{{$comment->comment}}</p>
                                <a class="parent_comment btn btn-link" data-user-id="{{$comment->id}}"
                                   data-user-name="{{$comment->user->first_name}}">Відповісти »</a>
                                <p align="right">{{$comment->created_at}}</p>

                                @if($comment->children_comments() != null)
                                    <p align="right" class="answers" comment-id="{{$comment->id}}">Відповіді</p>
                                    @foreach($comment->children_comments() as $children_comment))
                                    <p class="children_comments comment{{$comment->id}}">
                                        <img src="{{ $comment->user->path_img }}" align="left" width="40px"
                                             height="40px"
                                             class="img-circle">
                                        {{$children_comment->comment}}</p>
                                    <a class=" btn parent_comment children_comments comment{{$comment->id}}"
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
    </div>
    <div id="menu1" class="tab-pane fade">
        <div id="home" class="tab-pane fade in active">
            <div class="panel panel-default">


                <div class="panel-body">
                    <div class="panel-heading" style="font-size: 24px">{{$restaurant->name}}</div>
                    <div class="ln_solid"></div>
                    {!! $restaurant->description !!}


                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback "
                         style="height: auto; width: 300px;">
                        <table class="table jambo_table bulk_action">
                            <thead>
                            <tr class="headings">

                                <th class="column-title" style="display: table-cell;"> Графік роботи</th>
                                <th class="column-title" style="display: table-cell;"></th>
                                <th class="column-title" style="display: table-cell;"></th>

                            </tr>
                            </thead>
                            <tbody class="address">
                            <?php $days = ['неділя', 'понеділок', 'вівторок', 'середа', 'четвер', "п'ятниця", 'субота'];?>

                            @for($i=0;$i<7;$i++)
                                <tr class="even pointer">
                                    <td>{{$days[$i]}}</td>
                                    <td>{{date('G:i',strtotime($restaurant->schedule[$i]->start))}}</td>
                                    <td>{{date('G:i',strtotime($restaurant->schedule[$i]->end))}}</td>
                                </tr>
                            @endfor


                            </tbody>

                        </table>
                    </div>
                    <div class="ln_solid"></div>

                </div>

            </div>
        </div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <div id="home" class="tab-pane fade in active">
            <div class="panel panel-default" style="min-height: 70%">
                <div class="panel-body">
                    <div class="panel">
                        @foreach($restaurant->images as $image)


                        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
                            <a class="fancyimage" data-fancybox-group="group" href="{{$image->path}}">
                                <img class="img-responsive" src="{{$image->path}}" />
                            </a>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu3" class="tab-pane fade">
        <div id="home" class="tab-pane fade in active">
            <div class="panel panel-default" style="min-height: 70%">
                <div class="panel-body">
                    @foreach($restaurant->documents as $coment)
                    <div class="panel">
                        <iframe src="{{$coment->path}}" width="100%" height="100%" alt="Попробуйте в другом браузере"></iframe>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>



<script>
    var token = '{{Session::token()}}';
    var url = '{{route('add_mark')}}';
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("a.fancyimage").fancybox();
    });
</script>
@endsection
