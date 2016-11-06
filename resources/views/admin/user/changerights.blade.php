@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-xs-offset-1 col-md-offset-4">
        <div class="col-xs-10 col-md-6">
            <h3>Rechten aanpassen.</h3>
                <div class="form-group {{ $errors->has('user') ? ' has-error' : ''}}">
                    <h3>Gebruiker:</h3>
                        @foreach ($users as $user)
                            <div class="select">
                                <p><b>{{ $user->name }}</b> ({{$user->email}})</p>
                                <div class="hidden">{{$user->id}}</div>
                                <div class="hidden">{{$user->name}}</div>
                                <div class="hidden">{{$user->isAdmin()}}</div>
                                <div class="hidden">{{$user->deactivated}}</div>
                            </div>
                        @endforeach
                    @if($errors->has('user'))
                      <span class="help-block">{{ $errors->first('user') }}</span>
                    @endif
                      
                </div>
                
                <div class="form-group">
                <label for="user">Geselecteerde gebruiker:</label>
                    <input type="text" class="secondValue form-control" name="user" value="">
                </div>
                <form action="{{ route('admin.user.adminrights') }}" method="post">
                        <input type="hidden" class="firstValue" name="id" value="">
                        <input type="hidden" class="thirdValue" name="admin" value="">
                    <div class="form-group">
                        <button class="btn btn-danger btn-block hidden is-admin">Beheerdersrechten intrekken</button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block hidden is-not-admin">Beheerdersrechten geven</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>

                <form action="{{ route('admin.user.userrights') }}" method="post">
                    <input type="hidden" class="firstValue" name="id" value="">
                    <input type="hidden" class="forthValue" name="deactivated" value="">
                    <div class="form-group">
                        <button class="btn btn-success btn-block hidden is-deactivated">Gebruikersrechten (terug)geven</button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-block hidden is-not-deactivated">Gebruikersrechten intrekken</button>
                    </div>
                    
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
        </div>
    </div>
</div>
<div class="row">
    <ul class="pager">
        <li><a href="{{ URL::previous() }}">Terug</a></li>
    </ul>
</div>
@stop
