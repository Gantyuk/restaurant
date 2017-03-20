@extends('layouts.site')
@section('title')
    Ресторани
@endsection

@section('content')

    @foreach ($restaurants as $restaurant)
        <div class="panel panel-default">
            <div class="panel-heading">{!! $restaurant->name !!}</div>
            <div class="panel-body">

                <img src="{{ $restaurant->images[0]->path}}" align="left" width="44%">


                <div class="restoran_info">
                    <ul class="list-group">
                        <li class="list-group-item">Оцінка: {{$restaurant->marks->avg('mark')}} </li>
                        <li class="list-group-item">Категорій:
                            @foreach($restaurant->categories as $category)

                                {{$category->name}}

                            @endforeach
                        </li>
                        <li class="list-group-item">Адреса:</li>
                        <li class="list-group-item">Опис:<p>{{ $restaurant->short_description }}</p></li>
                        <li class="list-group-item">
                            <form method="get" action="{{route('view_restaurant',['id'=>$restaurant->id])}}">
                                <p>
                                    {{ csrf_field() }}
                                    <input type="submit" value="Детальніше!"/>
                                </p>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    <div class="panel panel-default" align="center">

        {{$restaurants->links()}}

    </div>
@endsection