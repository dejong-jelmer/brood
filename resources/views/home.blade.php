@extends('templates.default')
   
@section('content')

@if (!Auth::check())
	<div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-4 col-sm-4 col-md-6 col-lg-8">
        	   <p>Welkom op de broodbestelsite van Iewan</p>
                @include('auth.signin')
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
            <div class="col-xs-4 col-sm-4 col-md-6 col-lg-8">
            {{-- Orders block --}}
                @include('user.bread.partials.ordersblock')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
            <div class="col-xs-4 col-sm-4 col-md-6 col-lg-8">
                {{-- Navigation menu --}}
        	    @include('partials.menu')
            </div>
        </div>
    </div>
@endif

@stop

