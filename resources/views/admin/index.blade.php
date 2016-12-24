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

<!-- for colorpicker -->
<style type="text/css">

#info {
  background-color: #D9EDF7;
  color: #3180B3;
}
#success {
  background-color: #DFF0D8;
  color: #3C7655;
}
#warning {
  background-color: #FCF8E3;
  color: #8A6D55;
}
#danger {
  background-color: #F2DEDE;
  color: #A9445A;
}
</style>



@section('content')
<div class="row">
    <div class="col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
			<ul class="nav-list list-inline">
				<li><a href="{{ route('admin.user.bills') }}"><img src="{{ URL::asset('img/menu/check.jpg') }}"><span>Rekeningen</span></a></li>
				<li><a href="{{ route('admin.user.changeorder')  }}"><img src="{{ URL::asset('img/admin-menu/revise.jpg') }}"><span>Bestellingen herzien</span></a></li>
				<li><a href="{{ route('admin.user.changerights') }}"><img src="{{ URL::asset('img/menu/admin.jpg') }}"><span>Rechten</span></a></li>
				<li><a href="{{ route('admin.bread.updatebreadlist') }}"><img src="{{ URL::asset('img/admin-menu/breadlist.jpg') }}"><span>Broodlijst</span></a></li>
				<li><a href="{{ route('admin.broodrooster.index') }}"><img src="{{ URL::asset('img/menu/toaster.jpg') }}"><span>Broodrooster</span></a></li>
			</ul>          	  	
        </div>
    </div>
	<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
			<div class="container-fluid">
	        	@if(!Helper::newOrders())
					<h3>Er zijn geen nieuwe bestellingen.</h3>
					<label for="send" class="control-label">Doorgeven aan Arend.</label>
					<a href="{{ route('admin.email.order') }}" name="send" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-send"></span></a>
				@else
		        	<div class="vertical-align">
						<div class="form-group">
			        		<label for="send" class="control-label">Bestellingen naar Arend versturen:</label>
							<a href="{{ route('admin.email.order') }}" name="send" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-send"></span> Versturen</a>
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
				<form action="{{ route('admin.message')}}" method="post" role="form" class="form-vertical">
					<div class="form-group">
						<label class="control-label">Mededelingen voor gebruikers op hoofdpagina.<small> Bijvoorbeeld de dagen dat Arend op vakantie is.</small></label>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#message">Mededeling opstellen</button>
					</div>
					<input type="hidden" name="_token" value="{{ Session::token() }}">
					<!-- Modal -->
			        <div class="modal fade" id="message" role="dialog">
			            <div class="modal-dialog">

			                <!-- Modal content-->
			                <div class="modal-content">
			                    <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal">&times;</button>
			                        <h4 class="modal-title">Mededeling opstellen</h4>
			                    </div>
			                    <div class="modal-body">
			                    	<div class="form-group">
			                            <label for="message" class="control-label">Mededeling</label>
			                            <textarea class="form-control" rows="5" name="message"></textarea>
			                        </div>
			                    	<div class="form-group">
				                        <label for="expires" class="control-label">Verloopt (datum tot wanneer de mededeling moet blijven staan)</label>
			                            <input type="date" class="form-control" name="expires">
			                        </div>
			                        <div class="form-group">
				                        <label for="color" class="control-label">Kleur</label>
				                        
			                            <select class="form-control" name="color">
				                            <option></option>
				                            <option value="info" id="info">Blauw</option>
				                            <option value="success" id="success">Groen</option>succes
				                            <option value="warning" id="warning">Geel</option>
				                            <option value="danger" id="danger">Rood</option>
			                            </select>
			                        </div>
			                    	<div class="form-group">
			                            <button type="submit" class="btn btn-success">Plaatsen</button>
			                        </div>
			                    </div>
			                    <div class="modal-footer">
			                        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
			                    </div>
			                </div>
			            </div>
			        </div>
				</form>

			@if($messages->count())
			

				<div class="form-group">
					<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeMessage">Mededelingen verwijderen</button>
				</div>
			<input type="hidden" name="_token" value="{{ Session::token() }}">
			@endif
			@if($errors->has('message'))
                <span class="help-block error">{{ $errors->first('message') }}</span>
            @endif
            @if($errors->has('expires'))
                <span class="help-block error">{{ $errors->first('expires') }}</span>
            @endif

				
				<!-- Modal -->
		        <div class="modal fade" id="removeMessage" role="dialog">
				    <div class="modal-dialog">
    
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
							    <button type="button" class="close" data-dismiss="modal">&times;</button>
							    <h4 class="modal-title">Mededelingen verwijderen</h4>
							</div>
							<div class="modal-body">
						        @if($messages->count())
						        	@foreach($messages as $message)
						        		<div class="alert alert-{{$message->color ?: 'info'}} alert-dismissible">
				                        {{ $message->message }}
										<a href="{{ route('admin.message.remove', ['message' => $message->id]) }}" class="close" >&times;</a> 
					                    </div>
						        	@endforeach
						        @endif
							</div>
							<div class="modal-footer">
							    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
				    </div>
				  </div>
			</div>
		</div>
	</div>
	<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
		    <ul class="pager">
		        <li><a href="{{ URL::route('home') }}">Terug</a></li>
		    </ul>
	    </div>
    </div>
</div>
@stop
