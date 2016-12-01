@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <h3>Bestellingen wijzigen.</h3>
            <hr>
        </div>
    </div>
</div>
<div class="row"> 
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <form role="search" action="{{route('admin.user.search')}}" class="form-vertical">
                <div class="form-group">
                    <label for="query" class="control-label">Zoek een gebruiker</label>
                    <input type="text" name="query" class="form-control" autocomplete="off" placeholder="Type een naam">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Zoek</button>
                </div>
                <hr>
            </form>
        </div>
    </div>      
</div>
<div class="row">
   
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            @if (isset($users))
                @if (!$users->count())
                    <p>Geen gebruiker gevonden.</p>
                @else
                    @foreach ($users as $user)
                        <p>Bestelling(en) van: <b>{{$user->name}} </b>({{$user->email}})</p>
                        @foreach($user->breads as $bread)
                        <div class="select">
                                <div><p>{{ date('Y-m-d', strtotime($bread->pivot->created_at)) }}: {{ $bread->pivot->amount }} x {{ $bread->bread }}</p></div>
                                <div class="hidden">{{$bread->pivot->id}}</div>
                                <div class="hidden">{{$bread->pivot->amount}}</div>
                            </div>
                             
                        @endforeach
                    @endforeach
                    <hr>
                
                <form role="form" action="{{ route('admin.user.changeorder') }}" method="post" class="form-vertical">
                    <input type="hidden" class="firstValue" name="id">
                    <div class="form-group {{$errors->has('amount') ? ' has-error':''}}">   
                        <label for="aantal">Aantal aanpassen</label>
                        <input type="text" name="amount" class="form-control">
                        @if ($errors->has('amount'))
                            <span class="help-block">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                    <div class="form-group">   
                        <button class="btn btn-warning btn-block" type="submit">Aantal aanpassen</button>
                    </div>
                    <div class="form-group">   
                        <button class="btn btn-danger btn-block" type="submit" name="remove" value="1">Vewijderen</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                @endif
            @endif
                
        </div>
    </div>
</div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::route('admin.index') }}">Terug</a></li>
    </ul>
</div>
@stop

