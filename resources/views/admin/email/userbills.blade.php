@extends('templates.email')
   
@section('content')
    <p>Hallo, <br>
    <br>
    De maandrekening van {{ Helper::monthNumberToMonthName($month) }}:</p>
    @include('user.bread.partials.monthbillfield')
    @if(isset($totalMonthPrice))
        <h3><b>€&nbsp;{{ str_replace('.', ',', Helper::totalMonthPrice($totalMonthPrice)) }}</b></h3>

    @endif
    <p>Groeten,<br>
    <br>
    @if (Auth::user()->first_name_1)
        {{ Auth::user()->first_name_1 }}
    @else
        <p>Iewan</p>
    @endif
    </p>
@stop

