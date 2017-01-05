@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-10 col-sm-10 col-md-7 col-lg-7">
            <h3>De meest recent verstuurde bestelling:</h3>
            <hr>
             <!-- overview of users personal last send orders -->
            <h4>Alleen de door jouw bestelde broden:</h4>
            @if (!isset($user_orders) || !$user_orders->count() )
                <p>Er zijn geen recente peroonlijke bestellingen.</p>
            @else
                @foreach ($user_orders as $user_order)
                    <p>{{ $user_order->pivot->amount }} x {{ $user_order->bread }} </p>
                @endforeach
            @endif
        </div>
    </div>
</div>
<div class="row">

    <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-10 col-sm-10 col-md-7 col-lg-7">
            <hr>
            <!-- overview of total last send orders -->
            <h4>De bestellingen van alle gebruikers:</h4>
            @if (!isset($total_orders))
                <p>Er zijn geen recente bestellingen.</p>
            @else
                @foreach ($total_orders as $total_order)
                    <p>{{ $total_order }} </p>
                @endforeach
            @endif
        </div>
    </div>     
</div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop

