

    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            <tr class="headings">

                <th class="column-title" style="display: table-cell;">id</th>
                <th class="column-title" style="display: table-cell;">name</th>
                <th class="column-title" style="display: table-cell;">addresses</th>
                <th class="column-title" style="display: table-cell;">date_create</th>
                <th class="column-title" style="display: table-cell;">visible</th>
                <th class="column-title" style="display: table-cell;">images count</th>
                <th class="column-title" style="display: table-cell;">Category</th>
                <th class="column-title no-link last" style="display: table-cell;"><span
                            class="nobr">Action</span>
                </th>
                <th class="bulk-actions" colspan="7" style="display: none;">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                class="action-cnt">1 Records Selected</span> ) <i
                                class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($model as $md)


                <tr class="even pointer">
                    <td class=" ">{{$md->id}}</td>

                    <td class=" ">{{$md->name}}</td>
                    <td><select class="form-control">
                            @if(count($md->categories)!=0)
                                @foreach($md->categories as $cat)
                                    <option>{{$cat->name}}</option>
                                @endforeach
                            @else
                                <option>null</option>
                            @endif
                        </select></td>

                    <td class=" ">{{$md->created_at}}</td>
                    <td class="a-center ">
                        <div><input type="checkbox" onclick="hiddenRestaurant({{$md->id-1}})"
                                    <?php if ($md->visible) echo "checked" ?> class="checkbox name"
                                    id="{{$md->id}}"/>
                            <label for="{{$md->id}}"></label></div>

                    </td>
                    <td class=" ">{{count($md->images)}}</td>
                    <td><select class="form-control">
                            @if(count($md->addresses))
                                @foreach($md->addresses as $address)
                                    <option>{{$address->street}} {{$address->house}}</option>
                                @endforeach
                            @else
                                <option>null</option>
                            @endif
                        </select></td>

                    <td class=" last"><a href="/admin/restaurant/{{$md->id}}/edit">
                            <button class="btn btn-primary" type="button">Edit</button>
                        </a></td>
                </tr>
            @endforeach
            <script type="text/javascript">
                function hiddenRestaurant(id) {
                    $mad = document.getElementsByClassName('name');
                    if ($mad[id].checked) {
                        ajaxH(1,id);

                    } else {
                        ajaxH(0,id);
                    }
                }
                function ajaxH(visible,id) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/restaurant/hidde/'+id+1,
                        data: 'visible='+visible+'&_method=put&_token={{csrf_token()}}',
                        success: function(data){
                        }
                    });
                }

            </script>

            </tbody>
        </table>
        {{$model->links()}}
    </div>


