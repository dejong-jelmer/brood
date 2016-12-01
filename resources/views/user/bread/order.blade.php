@extends('templates.default')
   
@section('content')

<style type="text/css">
	.hiddden {
		display: none;
	}
</style>

<form action="{{ route('user.bread.order') }}" method="post" role="form" class="form-vertical">
	<div id="orderForm">
		<div class="row">
			<div class="col-xs-offset-2 col-md-offset-4">
				<div class="col-xs-10 col-md-6">
					@include('user.bread.partials.orderfield')
					<hr>
		    	</div>
	    	</div>
		</div>
	</div>
	<div class="hidden" id="multiOrderForm">
		<!-- This is where a copy of the initial orderField is displayed for more orders -->
	</div>
	<div class="row">
		<div class="col-xs-offset-2 col-md-offset-4">
			<div class="col-xs-10 col-md-6">
				<div class="form-group">
					<button type="submit" class="btn btn-lg btn-success btn-block">Bestel</button>
				</div>
				<div class="form-group">
					<button id="deleteField" type="button" class="btn btn-sm btn-default hidden btn-block">Minder</button>
				</div>
				<div class="form-group">
					<button id="createField" type="button" class="btn btn-sm btn-default btn-block">Meer</button>
    			</div>
    		</div>
		</div>
	</div>
	<input type="hidden" name="_token" value="{{ Session::token() }}">
</form>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop

