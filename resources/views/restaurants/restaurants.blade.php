@extends('layouts.site')
@section('title')
    Ресторани
@endsection

@section('content')
    @if ($categories != "")
        <div class="panel panel-default">
            <div class="panel-heading"><h4>
                    {{$categories}}
                </h4>
            </div>
        </div>
    @endif

    <div class="row">
        <section id="pinBoot">

            @foreach ($restaurants as $restaurant)

                <article class="white-panel">
                    <img class="img_rest" src="{{ $restaurant->images[0]->path}}">
                    <h4>
                        <a href="{{route('view_restaurant',['id'=>$restaurant->id])}}">
                            {!! $restaurant->name !!}
                        </a>
                    </h4>
                    <p>Оцінка:<span class="badge"> {{@round($restaurant->marks->avg('mark'),2)}}</span> |
                        <span class=" glyphicon glyphicon-comment" aria-hidden="true"></span> {{count($restaurant->comments)}}
                              </p>
                    <p>
                        Адреса:
                        @foreach($restaurant->addresses as $address)

                            {{$address->street}},
                            {{$address->house}};

                        @endforeach
                    </p>
                </article>

            @endforeach
        </section>


    </div>
@endsection