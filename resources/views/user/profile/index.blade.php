@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h3>Aanpassen</h3>
            <hr>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            
            <!-- change name -->
            <div class="form-group">
                <button id="toggleName" class="btn btn-lg btn-info btn-block" role="button"><span class="glyphicon glyphicon-user"></span> Naam</button>       
            </div>
            <div id="name" class="{{ $errors->has('name') ? '' : 'collapse' }}">
                <form action="{{ route('user.profile.username') }}" method="post" role="form" class="form-vertical">
                
                    <h3>Naam aanpassen</h3>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="control-label">Naam:</label>
                        <input id="name" class="form-control" type="text" name="name" placeholder="{{ Auth::user()->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                <hr>
            </div>
            
            <!-- change e-mail -->
            <div class="form-group">
                <button id="toggleEmail" class="btn btn-lg btn-info btn-block" role="button"><span class="glyphicon glyphicon-envelope"></span> E-mail</button>       
            </div>
            <div id="email" class="{{ $errors->has('email') ? '' : 'collapse' }}">
                <form action="{{ route('user.profile.email') }}" method="post" role="form" class="form-vertical">
                
                    <h3>E-mail aanpassen</h3>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-mail:</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="{{ Auth::user()->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                <hr>
            </div>

            <!-- change password -->
            <div class="form-group">
                <button id="togglePassword" class="btn btn-lg btn-info btn-block" role="button"><span class="glyphicons glyphicon-lock"></span> Wachtwoord</button>       
            </div>
            <div id="password" class="{{ $errors->has('current_password')||$errors->has('password')||$errors->has('password_confirmation') ? '' : 'collapse' }}">
                <form action="{{ route('user.profile.wachtwoord') }}" method="post" role="form" class="form-vertical">
                    <h3>Wachtwoord aanpassen</h3>
                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="control-label">Oud wachtwoord:</label>
                        <input id="current_password" class="form-control" type="password" name="current_password">
                        @if ($errors->has('current_password'))
                            <span class="help-block">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Nieuw wachtwoord:</label>
                        <input id="password" class="form-control" type="password" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="control-label">Herhaal wachtwoord:</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                <hr>              
            </div>

        </div>
    </div>
</div>
<div class="row">
    <ul class="pager">
      <li><a href="{{ URL::route('home') }}">Terug</a></li>
    </ul>
</div>
@stop
