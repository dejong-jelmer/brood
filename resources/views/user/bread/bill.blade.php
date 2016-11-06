@extends('templates.default')
   
@section('content')
<form action="{{ route('user.bread.monthbill') }}" methode="get" role="form" class="form-horizontal">
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-4">
        <div class="col-xs-10 col-md-6">
            <div class="form-group">
                <label for="year" class="control-label">Kies een jaar:</label>
                    <select id="year" name="year" class="select-year form-control">
                        <option value="" selected></option>                            
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                 </div>
            </div>
        </div>
    </div>

    <div class="collapse" id="monthField">
        <div class="row" >
            <div class="col-xs-offset-1 col-md-offset-4">
                <div class="col-xs-10 col-md-6">
                    <div class="form-group">
                        <label for="month" class="control-label">Keis een maand:</label>
                        <select id="month" name="month" class="select-month form-control">
                            <option value="" selected=""></option>
                            <option value="1">januari</option>
                            <option value="2">februari</option>
                            <option value="3">maart</option>
                            <option value="4">april</option>
                            <option value="5">mei</option>
                            <option value="6">juni</option>
                            <option value="7">juli</option>
                            <option value="8">augustus</option>
                            <option value="9">september</option>
                            <option value="10">oktober</option>
                            <option value="11">november</option>
                            <option value="12">december</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Bekijk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::route('home') }}">Terug</a></li>
    </ul>
</div>
    
@stop

