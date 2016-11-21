<h3>Log in</h3>
    <form action="{{ route('home') }}" class="form-vertical" role="form" method="post">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">E-mail</label>
            <input type="text" name="email" id="email" class="form-control">
            @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">Wachtwoord</label>
            <input type="password" name="password" id="password" class="form-control">
            @if ($errors->has('password'))
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Onthouden?
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span> Log in</button>
        </div>
        <div class="form-group">   
            <a href="{{ route('auth.signup') }}"><span class="glyphicon glyphicon-user"></span> Nog geen account? Maak een nieuw account aan.</a>
        </div>
        <div class="form-group">   
            <a href="{{ route('auth.password.email') }}"><span class="glyphicon glyphicon-question-sign"></span> Wachtwoord vergeten?</a>
        </div>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
    </form>
