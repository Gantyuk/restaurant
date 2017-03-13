@extends('admin::layout.app')


@section('content')
    <div class="right_col" role="main" style="min-height: 1161px;">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Tables <small>Some examples to get you started</small></h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">



                <div class="clearfix"></div>




                <div class="clearfix"></div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Table design <small>Custom design</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                                        <th class="column-title" style="display: table-cell;">id </th>
                                        <th class="column-title" style="display: table-cell;">name </th>
                                        <th class="column-title" style="display: table-cell;">addresses </th>
                                        <th class="column-title" style="display: table-cell;">date_create </th>
                                        <th class="column-title" style="display: table-cell;">visible </th>
                                        <th class="column-title" style="display: table-cell;">images count </th>
                                        <th class="column-title" style="display: table-cell;">Category </th>
                                        <th class="column-title no-link last" style="display: table-cell;"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7" style="display: none;">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($model as $md)


                                    <tr class="even pointer">
                                        <td class=" ">{{$md->id}}</td>

                                        <td class=" ">{{$md->name}}</td>
                                        <td class=" ">{{$md->id}}</td>

                                        <td class=" ">{{$md->created_at}}</td>
                                        <td class="a-center ">
                                            <div ><input type="checkbox"   <?php if($md->visible) echo "checked" ?> class="checkbox" id="{{$md->id}}" onchange="visible({{$md->id}})"/>
                                                <label for="{{$md->id}}"></label></div>
                                        </td>
                                        <td class=" ">{{count($md->images)}}</td>
                                       <td><select class="form-control">
                                        @if(!empty($md->categories[0]->name))
                                                   <option>{{$md->categories[0]->name}}</option>
                                        @else
                                                   <option>null</option>
                                        @endif
                                        </select></td>

                                        <td class=" last"><a href="#"><button class="btn btn-primary" type="button">Edit</button></a></td>


                                    </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                                {{$model->links()}}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
function visible(id) {

}
    </script>
@endsection