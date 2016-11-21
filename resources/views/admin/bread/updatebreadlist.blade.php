@extends('templates.default')
   
@section('content')

    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <h2>De broodlijst</h2>
                <hr>
                {{-- Output from DB:Breads --}}
                @foreach ($breads as $bread)
                     <div class="@if($bread->updated_at->diffInSeconds() < '2') bg-success @endif select">
                        <p><b>{{ $bread->bread }}</b> € {{ number_format((float)$bread->price, 2, ',', '') }}</p>
                        <div class="hidden">{{$bread->id}}</div>
                        <div class="hidden">{{$bread->bread}}</div>
                        <div class="hidden">{{$bread->price}}</div>
                    </div>
                @endforeach
                <hr>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-offset-1 col-md-offset-4">
            <div class="col-xs-10 col-md-6">
                <h2>Broden <span class="add-or-update">toevoegen</span></h2>
                <hr>
                <form action="{{ route('admin.bread.updatebreadlist') }}" method="post" role="form" class="form-vertical">
                    {{-- Bread inputfield --}}
                    <div class="form-group{{ $errors->has('bread') ? ' has-error' : '' }}">
                        <label for="breadname" class="control-label">Brood <span class="add-or-update">toevoegen</span>:</label>
                       <input type="hidden" class="firstValue" name="id">
                       <input type="text" name="bread" class="secondValue form-control" autocomplete="off">
                        @if ($errors->has('bread'))
                            <span class="help-block">{{ $errors->first('bread') }}</span>
                        @endif
                    </div>
                    {{-- Price inputfield --}}
                    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                        <label for="price" class="control-label">Prijs <span class="add-or-update">toevoegen</span>:</label>
                        <input type="text" name="price" class="thirdValue form-control" autocomplete="off">
                        <small>Prijzen invoeren met een 'punt' ipv 'komma'</small>
                        @if ($errors->has('price'))
                            <span class="help-block">{{ $errors->first('price') }}</span>
                        @endif
                        @if ($errors->has('id'))
                            <span class="help-block">{{ $errors->first('id') }}</span>
                        @endif
                    </div>
                    {{-- Submit button --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block add-or-update">toevoegen</button>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="remove" class="btn btn-success btn-block hidden" name="remove" value="1">verwijderen</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
               </form>
            </div>
        </div>      
    </div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::route('admin.index') }}">Terug</a></li>
    </ul>
</div>
@stop

