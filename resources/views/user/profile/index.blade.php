@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-6">
            <h2>Profiel</h2>
            <hr>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-6">
            <h4>Gegevens:</h4>
            <p>
            Naam: {{ $user->name }}<br>      
            Email: {{ $user->email }}<br>
            Overige: <br>
            </p>
            <ul>
            @if ($roles->count())
                @foreach($roles as $role )
                   
                    @php  
                    switch($role->role) {
                    
                        case($role->role == "Admin" && $role->pivot->active);
                            print('<li>Beheerder</li>');
                            break; 
                        case($role->role == "first_cyclist" && $role->pivot->active); 
                            print('<li>Beschikbaar voor fietsen op de <b>dinsdagen</b> </li>');
                            break;
                        case($role->role == "second_cyclist" && $role->pivot->active); 
                            print('<li>Beschikbaar voor fietsen op de <b>vrijdagen</b> </li>');
                            break;
                        case($role->role == "reminder_mail" && $role->pivot->active); 
                            print('<li>Ontvangt herinneringsmail</li>');
                            break;
                        case($role->role == "Iewan" && $role->pivot->active); 
                            print('<li>Woont bij <b>Iewan</b></li>');
                            break;
                        case($role->role == "Eikpunt"  && $role->pivot->active); 
                            print('<li>Woont bij <b>Eikpunt</b></li>');
                            break;    

                        default: print('');
                    }
                    @endphp
                @endforeach
            @else
                <li>Geen overige informatie</li>
            @endif
            </ul>
            <hr>
            <h3>Herinneringsmail ontvangen?</h3>
            <p>Wil je op de besteldagen een mailtje ontvangen als reminder.</p>
            <form action="{{route('user.profile.remindermail')}}" method="post" role="form" class="form-vertical">
                <div class="form-group">
                        <label class="switch">
                            <input id="reminder_mail" class="hidden" type="checkbox" onClick="submit()" name="reminder_mail" @foreach($roles as $role) {{$role->role == "reminder_mail" && $role->pivot->active ? 'checked': ''}}@endforeach>
                            <div class="switch-btn switch-sm switch-color"></div>
                        </label>  
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <div class="{{ $user->hasWoonprojectSet() ? 'hidden' : '' }}">
                <hr>
                <h3>Woonproject</h3>
                <p>In welk project woon je?</p>
                <form action="{{ route('user.profile.woonproject') }}" method="post" role="form" class="form-vertical">

                <div class="form-group">
                    <div class="radio">
                        <label><input type="radio" name="role" value="0" @foreach($roles as $role) {{$role->role == "Iewan" ? 'checked': ''}}@endforeach>Iewan</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="role" value="1" @foreach($roles as $role) {{$role->role == "Eikpunt" ? 'checked': ''}}@endforeach>Eikpunt</label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Doorgeven</button>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>

            <hr>
            <h3>Opgeven voor het broodrooster</h3>
                
            <p>Dit zijn de dagen waarop je kunt fietsen om het brood op te halen bij bakker Arend.</p>
            <form action="{{ route('user.broodrooster.cyclist') }}" method="post" role="form" class="form-vertical">
                <div class="form-group">
                    <label for="fist_cyclist" class="control-label">Fietsen op de dinsdagen:</label>
                </div>
                <div class="form-group">
                    <label class="switch">
                        <input id="fist_cyclist" class="hidden" type="checkbox" name="fist_cyclist" {{Auth::user()->isFirstCyclist() ? 'checked': ''}}>
                        <div class="switch-btn switch-sm switch-color"></div>
                    </label>
                    <div id="output_fist_cyclist"></div>
                </div>
                <div class="form-group">
                    <label for="second_cyclist" class="control-label">Fietsen op de vrijdagen:</label>
                </div>
                <div class="form-group">
                    <label class="switch">
                        <input id="second_cyclist" class="hidden" type="checkbox" name="second_cyclist" {{Auth::user()->isSecondCyclist() ? 'checked': ''}}>
                        <div class="switch-btn switch-sm switch-color"></div>
                    </label>
                    <div id="output_second_cyclist"></div>
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            <hr>
        </div>
        <div class="col-xs-10 col-sm-6 col-md-6 col-lg-6">    
            <!-- change name -->
            <h3>Aanpassen:</h3>
            <p>Klik op een van de onderstaande knoppen om je gegevens te wijzigen.</p>
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
                <button id="togglePassword" class="btn btn-lg btn-info btn-block" role="button"><span class="glyphicon glyphicon-lock"></span> Wachtwoord</button>       
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
