@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-md-offset-4">
        <div class="col-xs-10 col-md-6">
            <h3>Stuur maandrekeningen.</h3>
            <hr>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-4">
        <div class="col-xs-10 col-md-6">
            <div class="form-group" id="sendField">
                <label for="send" class="control-label">Maandrekeningen van {{ Helper::monthNumberToMonthName((date('m')>1 ? date('m')-1:'12')) }} naar alle bewoners versturen:</label>
                <a href="{{ route('admin.email.userbills', 'admin.email.userbillsoverfew')  }}" name="send" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-send"></span> Versturen</a>
            <hr>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-offset-1 col-md-offset-4">
        <div class="col-xs-10 col-md-6">
            <div class="form-group">
                <button id="changeMonth" class="btn btn-info">Andere maand</button>
                <button id="chooseUser" class="btn btn-warning hidden">Gebruiker kiezen</button>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.email.userbills')  }}" methode="get" role="form" class="form-horizontal">
<div class="collapse" id="userField">
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <div class="form-group">
                    <h3>Gebruiker kiezen.</h3>
                    <hr>
                    <label for="userId" class="control-label">Kies een gebruiker:</label>
                    <select id="user" name="user_id" class="form-control">
                        <option value="" selected></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="collapse" id="yearField">
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <div class="form-group">
                    <h3>Andere maand.</h3>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <div class="form-group">
                    <label for="year" class="control-label">Kies een jaar:</label>
                    <select id="year" name="year" class="select-year form-control">
                        <option value="" selected></option> 
                        @for($year = '2017'; $year <= Carbon::now()->year; $year++)
                            <option value="{{$year}}">{{$year}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <div class="form-group">
                    <label for="month" class="control-label">Kies een maand:</label>
                    <select id="month" name="month" class="select-month form-control">
                        <option value="" selected=""></option>
                        <option value="1">januari</option>
                        <option value="2">februari</option>
                        <option value="3">maart</option>
                        <option value="4">april</option>
                        <option value="5">mei</option>
                        <option value="6">juni</option>
                        <option value="7">juli</option>
                        <option value="8">augustus</option>
                        <option value="9">september</option>
                        <option value="10">oktober</option>
                        <option value="11">november</option>
                        <option value="12">december</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-send"></span> Versturen</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::route('admin.index') }}">Terug</a></li>
    </ul>
</div>
@stop

