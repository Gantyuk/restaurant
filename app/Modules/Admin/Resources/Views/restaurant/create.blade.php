@extends('admin::layout.app')

@section('content')


    <div class="right_col" role="main" style="min-height: 3801px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left">

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-1 col-xs-7" for="first-name">Name <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <input type="text" id="first-name" required="required"
                                   class="form-control col-md-4 col-xs-12">
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Select Multiple</label>
                        <div class="col-md-7 col-sm-9 col-xs-12">
                            <select class="select2_multiple form-control" multiple="multiple">
                                <option>Choose option</option>
                                <option>Option one</option>
                                <option>Option two</option>
                                <option>Option three</option>
                                <option>Option four</option>
                                <option>Option five</option>
                                <option>Option six</option>
                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3 col-xs-12">Short discription</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="resizable_textarea form-control"
                                      placeholder="Shourt description about Restaurant"></textarea>
                        </div>
                    </div>
                    <div class="ln_solid"></div>


                    <div class="x_title">
                        <h2>Description
                            <small>about restaurant</small>
                        </h2>

                        @include('admin::helpers.text_editor')
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