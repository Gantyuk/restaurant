@extends('admin::layout.app')

@section('content')

    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Tables
                        <small>Some examples to get you started</small>
                    </h3>
                </div>
                <form action="/admin/user" method="get">
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="search">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="clearfix"></div>

                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Table design
                                <small>Custom design</small>
                            </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title" style="display: table-cell;">id</th>
                                        <th class="column-title" style="display: table-cell;">name</th>
                                        <th class="column-title" style="display: table-cell;">Last Name</th>
                                        <th class="column-title" style="display: table-cell;">date_create</th>
                                        <th class="column-title" style="display: table-cell;">ban</th>
                                        <th class="bulk-actions" colspan="7" style="display: none;">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                        class="action-cnt">1 Records Selected</span> ) <i
                                                        class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $a=0; ?>
                                    @foreach($user as $us)
                                        <?php
                                        $a++;
                                        $a=$a%21;
                                        ?>
                                        <tr class="even pointer">
                                            <td class=" ">{{$us->id}}</td>

                                            <td class=" ">{{$us->first_name}}</td>
                                            <td>{{$us->last_name}}</td>

                                            <td class=" ">{{$us->created_at}}</td>
                                            <td class="a-center ">
                                                <div><input type="checkbox" onclick="hiddenRestaurant({{$us->id}},{{$a}})"
                                                            <?php if ($us->ban) echo "checked" ?> class="checkbox name"
                                                            id="{{$us->id}}"/>
                                                    <label for="{{$us->id}}"></label></div>

                                            </td>
                                        </tr>
                                    @endforeach
                                    <script type="text/javascript">
                                        function hiddenRestaurant(rest_id, id) {
                                            $mad = document.getElementsByClassName('name');
                                            if ($mad[id - 1].checked) {
                                                alert('asd');
                                                ajaxH(1, rest_id);

                                            } else {
                                                alert('bsd');
                                                ajaxH(0, rest_id);
                                            }
                                        }
                                        function ajaxH(ban, id) {
                                            $.ajax({
                                                type: 'POST',
                                                url: '/admin/user/ban/' + id,
                                                data: 'ban=' + ban + '&_method=put&_token={{csrf_token()}}',
                                                success: function (data) {
                                                }
                                            });
                                        }

                                    </script>

                                    </tbody>
                                </table>
                                {{$user->links()}}

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection