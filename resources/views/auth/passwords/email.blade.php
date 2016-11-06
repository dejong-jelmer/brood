@extends('templates.default') 

@section('content')
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <h2>Wachtwoord reset</h2>
                <form action="{{ route('auth.password.email') }}" method="post" role="form" class="form-vertical">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-mail</label>
                        <input type="email" name="email" class="form-control">
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Stuur wachtwoord reset link</button>
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