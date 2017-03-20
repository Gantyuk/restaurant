@extends('admin::layout.app')

@section('content')

    <div class="right_col" role="main" style="min-height: 3801px;">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">

                <form enctype="multipart/form-data" role="form" href="/admin/restaurant/category" method="post"
                      id="demo-form2" class="form-horizontal form-label-left">


{{csrf_field()}}
                    {{--Name--}}
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="control-label col-md-1 col-sm-1 col-xs-7" for="first-name">Name <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 col-xs-12">
                            <input name="name" type="text" id="first-name" value="{{ old('name') }}" required="required"
                                   class="form-control col-md-4 col-xs-12">
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="button">Cancel</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>


                </form>

            </div>
        </div>


    </div>
    <script src="/admin_asset/js/admin_create.js"></script>

@endsection