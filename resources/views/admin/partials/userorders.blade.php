@foreach($users as $user)						
	@if($user->breads->count())
		@if($user->hasUnsendOrders($user->id))
			<b>{{$user->name }}</b> - {{ $user->email }}:
			@foreach($user->breads as $bread)
			<ul>
				@if(!$bread->pivot->send)
					<li><b>{{ $bread->pivot->amount }} x
					{{ $bread->bread }}</b> </li>
					<li>{{ ($bread->pivot->created_at) }}</li>
				@endif
			</ul>
			@endforeach
		@endif
	@endif
@endforeach

