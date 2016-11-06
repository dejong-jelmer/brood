@foreach($users as $user)						
	@if($user->breads->count())
		@if($user->hasUnsendOrders($user->id))
			<p>
			Van: <b>{{$user->name }}</b> ({{ $user->email }}) <br>
			@foreach($user->breads as $bread)
				@if(!$bread->pivot->send)
					-> Bestelling: <b>{{ $bread->pivot->amount }} x
						{{ $bread->bread }}</b> <br>
					Gedaan op: {{ $bread->pivot->created_at }} <br>
				@endif
			@endforeach
			</p>
		@endif
	@endif
@endforeach

