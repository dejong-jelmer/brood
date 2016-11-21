@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-2 col-md-offset-5">
        <h2>Broodrooster</h2>
    </div>    
	<div class="embed-responsive embed-responsive-16by9">
	    <iframe class="embed-responsive-item" src="http://iewan.nl/broodrooster/"></iframe>
	</div>
</div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop

