@extends('templates.default')
   
@section('content')

<div class="row">
    <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
        <div class="col-xs-4 col-sm-8 col-md-8 col-lg-8">
            <h3>De meest recent verstuurde bestelling:</h3>
            <hr>
            @if (!isset($orders))
                <p>Er zijn geen recente bestellingen.</p>
            @else
                @foreach ($orders as $order)
                    <p>{{ $order }} </p>
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

