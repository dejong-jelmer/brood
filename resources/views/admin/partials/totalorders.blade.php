@if(!Helper::newOrders())
	<p><b><i>Er zijn dit keer geen bestellingen.</i></b></p>
@else
@foreach($breads as $bread)						
	@if($bread->users->count())
		@foreach($bread->users as $user)
			@if(!$user->pivot->send)
				<div style="display:none;">
					{{ $amountSum[] = $user->pivot->amount }}
				</div>
			@endif
		@endforeach					
	@endif
	@if(isset($amountSum))
		<p><strong>{{ array_sum($amountSum) }} x {{ Bread::getBreadName($user->pivot->bread_id)->bread }}</strong></p>
		@unset($amountSum) 
	@endif
@endforeach
@endif
