@extends('admin::layout.app')

@section('content')


    <div class="right_col" role="main" style="min-height: 3801px;">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">

                <form enctype="multipart/form-data" role="form" href="/admin/restaurant/store" method="post" id="demo-form2" class="form-horizontal form-label-left" >


                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-7" for="first-name">Name <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <input name="name" type="text" id="first-name" required="required"
                                   class="form-control col-md-4 col-xs-12">
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Category<span
                                    class="required">*</span></label>
                        <div class="col-md-7 col-sm-9 col-xs-12">
                            <select name="category[]" class="select2_multiple form-control" multiple="multiple">
                                @foreach($category as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Short discription</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea name="short_description" class="resizable_textarea form-control"
                                      placeholder="Shourt description about Restaurant"></textarea>
                        </div>
                    </div>

                    <div class="ln_solid"></div>





                    <div class="fileUpload btn btn-primary  btn-sm">
                        <span>Upload photos</span>
                        <input id="uploadBtn" type="file" name="image[]" multiple class="upload" autofocus/>
                    </div>
                    <input id="uploadImg"  placeholder="Choose File" disabled="disabled"/>
                    <script type="text/javascript">

                        document.getElementById("uploadBtn").onchange = function () {

                            var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1;
                            if (numFiles < 2) {
                                $("#uploadImg").val(input.val());
                            }
                            else {
                                $("#uploadImg").val("uploaded " + numFiles + " files");

                            }

                        };
                    </script>




                    <div class="ln_solid"></div>

                    <div class="fileUpload btn btn-primary btn-sm">
                        <span>Upload menus</span>
                        <input id="uploadFls" type="file" name="menu[]" multiple class="upload"/>
                    </div>
                    <input id="uploadFile" placeholder="Choose File" multiple disabled="disabled"/>
                    <script type="text/javascript">

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




                    <div class="ln_solid"></div>


                    <div class="x_title">
                        <h2>Description
                            <small>about restaurant</small>
                        </h2>

                        @include('admin::helpers.text_editor')
                        <div class="form-group">


                            <div class="ln_solid"></div>

                            @include('admin::helpers.map2')






                            <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-2 col-xs-2 col-md-offset-0">
                                <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>





                </form>

            </div>
        </div>


    </div>

@endsection