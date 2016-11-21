@extends('templates.email')
   
@section('content')
    <p>Hallo {{ $userName }},<br>
    <br>
    De maandrekening van {{ Helper::monthNumberToMonthName($month) }}:</p>
    @include('user.bread.partials.monthbillfield')
    @if(isset($totalMonthPrice))
        <h3><b>€&nbsp;{{ str_replace('.', ',', Helper::totalMonthPrice($totalMonthPrice)) }}</b></h3>

    @endif
    <p>Groeten,<br>
    <br>
    @if (Auth::user()->name)
        {{ Auth::user()->name }}
    @else
        <p>Iewan</p>
    @endif
    </p>
@stop

