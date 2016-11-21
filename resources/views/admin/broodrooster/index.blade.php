@extends('templates.default')
<!-- cdn for modernizr, if you haven't included it already -->
<script src="http://cdn.jsdelivr.net/webshim/1.16.0/extras/modernizr-custom.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.16.0/polyfiller.js"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-md-offset-1">
        <div class="col-xs-2 col-md-2">
            <h3>Fietsers</h3>
            <hr>
            @if(isset($events))
                @foreach ($events as $event)
                    <div class="form-group{{ !$event->name ? ' error' : ''}}">
                        <p>{{ $event->start['date'] }}: 
                        {{ !$event->name ? 'Nog geen fietser!' : $event->name }}</p>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>
  
    <div class="col-xs-offset-4 col-md-offset-4">
        <div class="col-xs-5 col-md-5">
            <h2>Broodrooster - beheer</h2>
            <hr>
            <form action="{{ route('admin.broodrooster.index')}}" method="post" role="form" class="form-vertical">
                <div class="form-group">
                    <select name="cyclist" class="form-control">
                        <option></option>
                        @foreach($users as $user)
                                <option value="{{$user->name}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block">Invoeren in Google agenda</button>
                </div>
                <hr>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
                        
        </div>    
    </div>
    <div class="col-xs-offset-8 col-md-offset-8">
        <div class="col-xs-10 col-md-10">                               
            <div class="form-group">
                <h3>Beschikbaarheid</h3>
                <hr>
                @if (isset($users))
                    @foreach($users as $user)
                        <p><b>{{$user->name}}'s</b> beschikbaarheid voor fietsendiensten:</p>
                        @if (!$user->isCyclist() )
                            <p><b>geen van de dagen.</b></p>
                        @elseif($user->isFirstCyclist() && !$user->isSecondCyclist())
                            <p><b>alleen op dinsdagen.</b></p>
                        @elseif(!$user->isFirstCyclist() && $user->isSecondCyclist())
                            <p><b>alleen op vrijdagen.</b></p>
                        @elseif($user->isFirstCyclist() && $user->isSecondCyclist())
                            <p><b>dinsdagen en vrijdagen.</b></p>
                        @endif
                        <hr>
                    @endforeach
                @endif
            </div>
        </div>
    </div>   
</div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop

