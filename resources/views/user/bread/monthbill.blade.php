@extends('templates.default')
   
@section('content')
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-5">
        <div class="col-xs-10 col-md-6">
            <h2 class="nav-collapse">{{ Helper::monthNumberToMonthName($month) }} {{ $year }}</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-3">
        <div class="col-xs-10 col-md-8">
            <hr>
        </div>
    </div>
</div>
@include('user.bread.partials.monthbillfield')
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>

	
@stop


