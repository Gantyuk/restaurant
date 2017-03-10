@extends('layouts.site')
@section('title')
    Registration
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Реєстрація</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" action="{{route('registration')}}" method="post"
                  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="col-md-4 control-label">Ім'я</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name"
                               value="{{ old('first_name') }}" required autofocus>

                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="col-md-4 control-label">Прізвище</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name"
                               value="{{ old('last_name') }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Електронна адреса</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Пароль</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Підтвердити пароль</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                               required>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}"><br>
                    <label for="image" class="col-md-4 control-label">Зображення:</label>

                    <div class="col-md-6">
                        <input id="image" class="form-control" type="file" name="image" accept="image/*"
                               value="{{ old('image') }}" required autofocus>

                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Реєстрація
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection