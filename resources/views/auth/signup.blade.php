@extends('templates.default') 

@section('content')
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <h2>Maak een account</h2>
                <form action="{{ route('auth.signup') }}" method="post" role="form" class="form-vertical">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Naam</label>
                        <input type="text" name="name" class="form-control" id="username" autocomplete="off">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-mail adres</label>
                        <input type="text" name="email" class="form-control" id="email" autocomplete="off">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Wachtwoord</label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="off" value="">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="control-label">Herhaal wachtwoord:</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Account aanmaken</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <ul class="pager">
          <li><a href="{{ URL::route('home') }}">Terug</a></li>
        </ul>
    </div>
@stop