@extends('templates.default') 

@section('content')
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <h2>Wachtwoord reset</h2>
                <form action="#" method="post" role="form" class="form-vertical">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Nieuw wachtwoord:</label>
                        <input id="password" class="form-control" type="password" name="password" autocomplete="off" placeholder="wachtwoord">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="control-label">Herhaal wachtwoord:</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="off" placeholder="Bevestiging">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                    </div>
                    <input type="hidden" name="token" value="{{$token}}">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
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



