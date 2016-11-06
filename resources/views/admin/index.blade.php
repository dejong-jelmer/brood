@extends('templates.default')
   
@section('content')
<div class="row">
	<div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class="container-fluid">
	        	@if(!Helper::newOrders())
					<h3>Er zijn geen nieuwe bestellingen.</h3>
					<label for="send" class="control-label">Doorgeven aan Arend.</label>
					<a href="{{ route('admin.email.order')  }}" name="send" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-send"></span></a>
				@else
		        	<div class="vertical-align">
						<div class="form-group">
			        		<label for="send" class="control-label">Bestellingen naar Arend versturen:</label>
							<a href="{{ route('admin.email.order')  }}" name="send" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-send"></span> Versturen</a>
						</div>
						<div class="form-group">
						<label for="button" class="control-label">Bestellingen bekijken:</label>
							<button class="btn btn-md btn-block btn-info" name="button" data-toggle="collapse" data-target="#totalOrders">Totale bestelling</button>
						</div>
						<div class="form-group">
							<button class="btn btn-md btn-block btn-info" data-toggle="collapse" data-target="#userOrders">Per gebruiker</button>
						</div>
					</div>
					
					
					<div id="orders">
						<div id="totalOrders" class="collapse">
							<h3>De bestellingen:</h3>
							@include('admin.partials.totalorders')
							<hr>
						</div>
						<div id="userOrders" class="collapse">
							<h3>De bestellingen per gebruiker:</h3>
							@include('admin.partials.userorders')
							<hr>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="row">
    <div class="col-xs-offset-1 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-4 col-sm-8 col-md-8 col-lg-8">
    	   <div class="container-fluid">
      			<div class="tab-content vertical-align">
					<ul class="nav-list list-inline">
						<li><a href="{{ route('admin.user.bills') }}"><img src="{{ URL::asset('img/menu/check.jpg') }}"><span>Rekeningen</span></a></li>
						<li><a href="{{ route('admin.user.changeorder')  }}"><img src="{{ URL::asset('img/admin-menu/revise.jpg') }}"><span>bestellingen herzien</span></a></li>
						<li><a href="{{ route('admin.user.changerights') }}"><img src="{{ URL::asset('img/menu/admin.jpg') }}"><span>Rechten Aanpassen</span></a></li>
						<li><a href="{{ route('admin.bread.updatebreadlist') }}"><img src="{{ URL::asset('img/admin-menu/breadlist.jpg') }}"><span>Broodlijst</span></a></li>
					</ul>
				</div>
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
