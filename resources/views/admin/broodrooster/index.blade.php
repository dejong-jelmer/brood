@extends('templates.default')

<!-- cdn for modernizr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<!-- polyfiller file to detect and load polyfills -->
<script src="http://cdn.jsdelivr.net/webshim/1.16.0/polyfiller.js"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>
   
@section('content')
<div class="row">
    <div class="col-xs-offset-0 col-md-offset-4">
        <div class="col-xs-5 col-md-5">
            <h2>Broodrooster - beheer</h2>
            <hr>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-offset-0 col-md-offset-1">
        <div class="col-xs-4 col-md-3">
            <h4>Fietsers</h4>
            <hr>
            <form action="{{ route('admin.broodrooster.remove')}}" method="post" role="form" class="form-vertical">
                @if(isset($events))
                    @foreach ($events as $event)
                        <div class="form-group{{ !$event->name ? ' error' : ''}}">
                            {{ $event->start['date'] }}: 
                            {{ !$event->name ? 'Nog geen fietser!' : $event->name }} &nbsp;<button class="btn btn-danger btn-xs pull-right" name="id" type="button" value="{{ $event->id }}"  title="Dienst verwijderen of legen?" data-toggle="modal" data-target="#modal{{$event->id}}"><span class="glyphicon glyphicon-remove"></span></button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modal{{$event->id}}" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Fietsdienst verwijderen of legen?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <button type="submit" class="btn btn-primary" title="Dienst blijft bestaan, maar naam van fietser wordt uit de agenda gehaald." name="id" value="{{$event->id}}:0">Dienst legen?</button>
                                        <button type="submit" class="btn btn-warning" title="Dienst wordt voledig uit de agenda gehaald." name="id" value="{{$event->id}}:1">Dienst verwijderen?</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    
        <div class="col-xs-4 col-md-5">
            <h4>Invoer</h4>
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
                    <button class="btn btn-success btn-block">Invoeren in kalender</button>
                </div>
                <hr>
                <ul class="pager">
        <li><a href="{{ URL::route('admin.index') }}">Terug</a></li>
    </ul>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>             
        </div>    
   
        <div class="col-xs-4 col-md-3">                               
            
                <h4>Beschikbaar</h4>
                <hr>
                @if (isset($users))
                    @foreach($users as $user)
                        <p><b>{{$user->name}}'s</b> beschikbaarheid:</p>
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


@stop

