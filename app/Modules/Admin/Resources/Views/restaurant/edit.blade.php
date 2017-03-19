@extends('admin::layout.app')

@section('content')

    <div class="right_col" role="main" style="min-height: 3801px;">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">

                <form enctype="multipart/form-data" role="form" action="/admin/restaurant/{{$model->id}}" method="post"
                      id="demo-form2" class="form-horizontal form-label-left">

                    {{csrf_field()}}
                    {{method_field('put')}}
                    {{--Name--}}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label col-md-1 col-sm-1 col-xs-7" for="first-name">Name <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <input name="name" type="text" id="first-name"
                                   value="<?php echo !empty(old('name')) ? old('name') : $model->name; ?>"
                                   required="required"
                                   class="form-control col-md-4 col-xs-12">
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    {{--End Name--}}
                    <div class="ln_solid"></div>
                    {{--Category--}}
                    <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Category<span
                                    class="required">*</span></label>
                        <div class="col-md-5 col-sm-9 col-xs-12">
                            <select name="category[]" class="select2_multiple form-control" multiple="multiple">
                                @foreach($category as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('category'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                        @endif
                    </div>
                    {{--End Category--}}

                    <div class="ln_solid"></div>
                    {{--Short description--}}
                    <div class="form-group {{ $errors->has('short_description') ? ' has-error' : '' }}">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Short discription</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea value="" name="short_description" class="resizable_textarea form-control"
                                      placeholder="Shourt description about Restaurant"><?php echo !empty(old('short_description')) ? old('short_description') : $model->short_description; ?></textarea>
                        </div>
                        @if ($errors->has('short_description'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('short_description') }}</strong>
                                    </span>
                        @endif
                    </div>
                    {{--End Short description--}}

                    <div class="ln_solid"></div>

                    {{--Images--}}
                    <div class="form-group">
                        <div class="col-md-6 col-sm-2 col-xs-2 col-md-offset-0">
                            <div class=" fileUpload btn btn-primary  btn-sm {{ $errors->has('image') ? ' has-error' : '' }}"
                                 style="
                         padding-top: 0px;
                         margin-top: 0px;
                         margin-bottom: 0px;">
                                <span>Upload photos</span>
                                <input id="uploadBtn" type="file" name="image[]" multiple class="upload" autofocus/>

                            </div>
                            <input id="uploadImg" placeholder="Choose File" disabled="disabled"/>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <p style="color: darkred">{{ $errors->first('image') }}</p>
                                    </span>
                            @endif</div>
                        <div class="col-md-6 col-sm-6 col-xs-2 form-group has-feedback address"
                             style="max-height: 300px; width: 500px; overflow-y: scroll;">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">

                                    <th class="column-title" style="display: table-cell;">images</th>
                                    <th class="column-title" style="display: table-cell;">delete</th>

                                </tr>
                                </thead>
                                <tbody class="address">

                                @foreach($model->images as $image)
                                    <tr class="even pointer " id="img{{$image->id}}">
                                        <td><img src="{{$image->path}}" height="100px" width="100px"></td>
                                        <td>
                                            <button type="button" class="btn btn-round btn-info fa fa-trash"
                                                    onclick="deleteFile('{{$image->id}}','image','img{{$image->id}}')">
                                                delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                    {{-- End Images--}}


                    <div class="ln_solid"></div>
                    {{--Menu--}}

                    <div class="form-group">
                        <div class="col-md-6 col-sm-2 col-xs-2 col-md-offset-0">
                            <div class=" fileUpload btn btn-primary  btn-sm {{ $errors->has('menu') ? ' has-error' : '' }}"
                                 style="
                         padding-top: 0px;
                         margin-top: 0px;
                         margin-bottom: 0px;">
                                <span>Upload Menu</span>
                                <input id="uploadFls" type="file" name="menu[]" multiple class="upload" autofocus/>

                            </div>
                            <input id="uploadFile" placeholder="Choose File" disabled="disabled"/>
                            @if ($errors->has('menu'))
                                <span class="help-block">
                                        <strong style="color: darkred">{{ $errors->first('menu') }}</strong>
                                    </span>
                            @endif</div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback address"
                             style="max-height: 300px; width: 500px; overflow-y: scroll;">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">

                                    <th class="column-title" style="display: table-cell;">type</th>
                                    <th class="column-title" style="display: table-cell;">delete</th>

                                </tr>
                                </thead>
                                <tbody class="address">
                                @foreach($model->documents as $doc)
                                    <tr class="even pointer " id="menu{{$doc->id}}">
                                        <td>{{$doc->type}}</td>
                                        <td>
                                        <button type="button" class="btn btn-round btn-info fa fa-trash"
                                                onclick="deleteFile('{{$doc->id}}','menu','menu{{$doc->id}}')">delete
                                        </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>
                    </div>

                    <script type="text/javascript">
                        function deleteFile(id, type_m, tr_id) {
                            $.ajax({
                                type: 'POST',
                                url: "/admin/restaurant/" +id,
                                data: '_method=delete&_token={{csrf_token()}}&type=' + type_m,
                                success: function (data) {
                                    $('#' + tr_id).remove();

                                }
                            });
                        }
                        document.getElementById("uploadFls").onchange = function () {

                            var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1;
                            if (numFiles < 2) {
                                $("#uploadFile").val(input.val());
                            }
                            else {
                                $("#uploadFile").val("uploaded " + numFiles + " files");

                            }

                        };
                    </script>
                    {{--End Menu--}}

                    <div class="ln_solid"></div>

                    {{--Description--}}
                    <div class="x_title">
                        <h2>Description
                            <small>about restaurant</small>
                            @if ($errors->has('image'))
                                <span class="help-block">
                                        <strong style="color: darkred">{{ $errors->first('desctiption') }}</strong>
                                    </span>
                            @endif
                        </h2>

                        @include('admin::helpers.text_editor')
                        {{--End Description--}}

                        {{--Map--}}
                        <div class="form-group">
                            <div class="ln_solid"></div>
                            <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="inputSuccess2"
                                       placeholder="Street, house №">
                                <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                            </div>
                            <button class="btn btn-primary"  id="che" onclick="checkAddress()" type="button">Check
                            </button>
                            <button class="btn btn-primary" type="button" onclick="addAddress()">Add</button>
                        </div>
                        <div class="form-group">
                            <div class="map">
                                @include('admin::helpers.map')
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback address"
                                 style="height: 300px; width: 500px; overflow-y: scroll;">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">

                                        <th class="column-title" style="display: table-cell;">locality</th>
                                        <th class="column-title" style="display: table-cell;">home</th>
                                        <th class="column-title" style="display: table-cell;">delete</th>

                                    </tr>
                                    </thead>
                                    <tbody class="address">

                                    @foreach($model->addresses as $adr)
                                        <tr class="even pointer " id="address{{$adr->id}}">
                                            <td>{{$adr->street}}</td>
                                            <td>{{$adr->house}}</td>
                                            <td>
                                                {{$adr->id}}
                                                <button type="button" class="btn btn-round btn-info fa fa-trash"
                                                        onclick="deleteFile('{{$adr->id}}','address','address{{$adr->id}}')">delete
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        {{--new addresses--}}


                                    </tbody>

                                </table>

                            </div>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                        <h1 style="color: darkred">{{ $errors->first('address') }}</h1>
                                    </span>
                            @endif
                            <div class="results"></div>

                        </div>

                        {{--End Map--}}

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="addAddress()" type="button">Cancel</button>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>


    </div>
    <script src="/admin_asset/js/admin_create.js"></script>

@endsection