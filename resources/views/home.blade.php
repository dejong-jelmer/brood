@extends('templates.default')
   
@section('content')

	<div class="row">
	    @if (!Auth::check())
            <div class="col-xs-offset-1 col-md-offset-4">
                <div class="col-xs-10 col-md-6">
            	   <p>Welkom op de broodbestelsite van Iewan</p>
                    @include('auth.signin')
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                    <div class="col-xs-8 col-sm-7 col-md-7 col-lg-7">
                        {{-- Orders block --}}
                        @include('user.bread.partials.ordersblock')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-offset-2 col-sm-offset-4 col-md-offset-4 col-lg-offset-4">
                    <div class="col-xs-4 col-sm-8 col-md-8 col-lg-8">
                        {{-- Navigation menu --}}
                	    @include('partials.menu')
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

