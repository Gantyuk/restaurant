@extends('layouts.site')
@section('title')
    {{--name--}}
    Registration
@endsection

@section('content')

            {{--galereia--}}

                    @for($i=1;$i<10;$i++)
                        <div class="col-md-4 col-sm-3 col-xs-7 thumb">
                            <a class="fancyimage" data-fancybox-group="group" href="/img/restaurants/00{{$i}}.jpg">
                                <img class="img-responsive" src="/img/restaurants/00{{$i}}.jpg"/>
                            </a>
                        </div>
                    @endfor

            <script src="/jquery/jquery-1.11.2.min.js"></script>
            <script src="/bootstrap-3.3.2/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("a.fancyimage").fancybox();
                });
            </script>
            {{--*****--}}
            <p>mark</p>....
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" rows="5" id="comment"></textarea>
            </div>
            <button type="button" class="btn btn-primary">Coment</button>



@endsection