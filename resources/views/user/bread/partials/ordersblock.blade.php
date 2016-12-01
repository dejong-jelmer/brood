{{ Carbon::setLocale('nl') }}

@if(Auth::user()->isDeactivated())
    <div class="well">
        <div class="center">
            <h4>Je account is gedeactiveerd, je kunt geen bestellingen meer plaatsen</h4>
        </div>
    </div>
@else
    @if(!$orders->count())
        <div class="well">
            <div class="center">
                <h4>Je hebt nog geen (nieuwe) bestellingen gedaan.</h4>
            </div>
        </div>
    @else
        <form action="{{ route('user.bread.removeorder') }}" method="post" role="form" class="form-horizontal" >
            <div class="well">
                <h4>Je bestelling(en):</h4>
                @foreach ($orders as $order)
                    <div class="col-xs-offset-1 col-md-offset-1">
                        <p><button class="btn btn-danger btn-xs" name="id" value="{{ $order->pivot->id }}" data-toggle="tooltip" title="Bestelling verwijderen?"><span class="glyphicon glyphicon-erase" style="margin-top:3px"></span></button> {{ $order->pivot->amount }} x {{ $order->bread }} - {{ $order->pivot->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    @endif
    <div class="well">
        <p>
            @if (isset($mostRecentOrder))
                De laatste bestelling verstuurd: <b>{{ $mostRecentOrder->updated_at->diffForHumans() }}</b>.<br>
                Volgende bestelling voor: <b>{{ Helper::nextDeliveryDay($mostRecentOrder->updated_at) }}</b><br>
            @else
                Er zijn nog geen bestellingen verstuurd.<br>
            @endif

            @if (isset($firstEvent) && $firstEvent->name)
                
                De volgende fietser: <b>{{ $firstEvent->name }}</b>.<br>
            @else
                <span class="error"><b>Er is nog geen volgende fietsdienst!</b></span><br>
            @endif
        
    </div>
@endif