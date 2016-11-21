@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-1 col-md-offset-3">
        <div class="col-xs-10 col-md-10">
            <h2>Broodrooster</h2>
            <hr>
        </div>
    </div>
</div>
<!-- Google calendar iframe-->
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-1">
        <div class="col-xs-11 col-md-11">
            <iframe src="https://calendar.google.com/calendar/embed?mode=AGENDA&amp;src=nmld72u27hg997vtok8p4lf0b0%40group.calendar.google.com&ctz=Europe/Amsterdam" style="border: 0" width="100%" height="400" frameborder="0" scrolling="no"></iframe>
           
        </div>
    </div>
</div>

<!-- Available for broodrooster-->
@if (Auth::user())
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-1">
            <div class="col-xs-5 col-md-5">
            <h2>Opgeven voor het broodrooster</h2>
            <hr>
            <p>Dit zijn de dagen waarop je kunt fietsen om het brood op te halen bij bakker Arend.</p>
            <form action="{{ route('user.broodrooster.cyclist') }}" method="post" role="form" class="form-vertical">
                <div class="form-group">
                    <label for="fist_cyclist" class="control-label">Fietsen op de dinsdagen:</label>
                </div>
                <div class="form-group">
                    <label class="switch">
                        <input id="fist_cyclist" type="checkbox" name="fist_cyclist" {{Auth::user()->isFirstCyclist() ? 'checked': ''}}>
                        <div class="switch-btn switch-sm switch-color"></div>
                    </label>
                    <div id="output_fist_cyclist"></div>
                </div>
                <div class="form-group">
                    <label for="second_cyclist" class="control-label">Fietsen op de vrijdagen:</label>
                </div>
                <div class="form-group">
                    <label class="switch">
                        <input id="second_cyclist" type="checkbox" name="second_cyclist" {{Auth::user()->isSecondCyclist() ? 'checked': ''}}>
                        <div class="switch-btn switch-sm switch-color"></div>
                    </label>
                    <div id="output_second_cyclist"></div>
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Aanpassen</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
            </div>   
        </div>

        <div class="col-xs-offset-6 col-md-offset-6">
            <div class="col-xs-10 col-md-10">
                <h2>Opgeven of ruilen</h2>
                <hr>
                @if (isset($events))
                    <form action="{{ route('user.broodrooster.swap') }}" method="post" role="form" class="form-vertical">
                        <div class="form-group">
                            <label for="first_event" class="control-label">Fietsdienst ruilen:</label>
                            <select class="form-control" name="first_event">
                                <option></option>
                                @foreach ($events as $event)

                                    @if ($event->name == $user->name)
                                        <option value="{{ $event->id }}">{{ $event->start['date'] }} -> {{$event->name}}</option>
                                    @endif
                                @endforeach                     
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="second_event" class="control-label">met:</label>
                            <select class="form-control" name="second_event">
                                <option></option>
                                @foreach ($events as $event)
                                    @if ($event->name != $user->name)
                                        <option value="{{ $event->id }}">{{ $event->start['date'] }} -> {{ $event->name ? : 'nog geen fietser.'}}</option>
                                    @endif
                                @endforeach                     
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Ruilen</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                    <form action="{{ route('user.broodrooster.fill') }}" method="post" role="form" class="form-vertical">
                        <div class="form-group">
                            <label for="fill" class="control-label">Opgeven voor ongevulde fietsdienst:</label>
                            <select class="form-control" name="fill">
                                <option></option>
                                @foreach ($events as $event)
                                    @if (!$event->name))
                                        <option value="{{ $event->id }}">{{ $event->start['date'] }} -> nog geen fietser.</option>
                                    @endif
                                @endforeach                     
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-refresh"></span> Opgeven</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                @endif
            </div>
        </div>
    </div>        
@endif

<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop

