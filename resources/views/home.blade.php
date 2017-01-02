@extends('templates.default')
   
@section('content')

@if (!Auth::check())
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6">
               <p>Welkom op de broodbestelsite van Iewan en Eikpunt.</p>
                @include('auth.signin')
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-offset-0 col-sm-offset-0 col-md-offset-0 col-lg-offset-0">
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <!-- Navigation menu -->
                @include('partials.menu')
            </div>
        </div>
        <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-2 col-lg-offset-2">
            <div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">
                @if ($messages->count())
                    @foreach($messages as $message)
                        <div class="alert alert-{{$message->color ?: 'info'}} alert-dismissible" role="alert">
                            {{ $message->message }}
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>                
                    @endforeach
                @endif
                <!-- Orders block -->     
                @include('user.bread.partials.ordersblock')
            </div>
        </div>
    </div>
   
@endif

@stop

