<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">

    <title>@yield('title')</title>
    <link href="/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/fancybox/jquery.fancybox.css" type="text/css" media="screen"/>
    <script src="/js/sidenav.js"></script>
    <script src="/jquery/jquery-1.11.2.min.js"></script>
    <script src="/bootstrap-3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img id="logo" src="/img/LOGO.png" width="90" height="25"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Головна</a></li>
                <li><a href="#">Автор</a></li>
                <li><a href="#">Контакти</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('authentication') }}">Вхід</a></li>
                    <li><a href="{{ route('registration') }}">Реєстрація</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                            <img src="{{Auth::user()->path_img }}" alt="" width="20px" height="20px" class="img-circle">
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{route('comments', ['id'=>Auth::user()->id])}}">Мої коментарі</a>
                            </li>
                            <li>
                                <a href="{{route('marks', ['id'=>Auth::user()->id])}}">Мої оцінки</a>
                            </li>
                            <li>
                                <a href="{{route('profile',['id'=> Auth::user()->id])}}" onclick="event.preventDefault();
                                                     document.getElementById('users-form').submit();">
                                    Змінити профіль
                                </a>
                                <form id="users-form" action="{{route('profile',['id'=> Auth::user()->id])}}"
                                      method="GET"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon-share"></i> Вихід
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="/">Головна</a></li>
                        <li><a href="/top_10">
                                ТОП 10 Ресторанів
                            </a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Категорій<span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php  $categories = \App\Category::get();?>
                                @foreach($categories as $category)
                                    <li><a href="{{route('view_restaurant_category',['id'=>$category->id])}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>

                        </li>
                        <li><a href="#">#</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <br>
        <div class="col-sm-8 text-left">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
        <div class="col-sm-2 sidenav">
            {{--Реклама--}}
            {{--<div class="well">
                <p>ADS</p>
            </div>
            <div class="well">
                <p>ADS</p>
            </div>--}}
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>Автори: © 2017</p>
</footer>

</body>
<script src="/jquery/jquery-1.11.2.min.js"></script>
<script src="/js/project.js"></script>
</html>