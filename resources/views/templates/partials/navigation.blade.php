<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-left" href="{{ route('home') }}"><img src="{{ URL::asset('img/logo.jpg') }}"></a>
            <a class="navbar-brand" href="{{ route('home') }}"> Brood&nbsp;bestellen</a>
             @if (Auth::check())
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="glyphicon glyphicon-th-list"></span>                   
                </button>
            @endif
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
            @if (!Auth::check())
                <li><a href="{{ route('user.broodrooster') }}"><span class="glyphicon glyphicon-calendar"></span> Broodrooster</a></li>
            @endif
            @if (Auth::check())
                <li><a href="#" style="cursor:default">Ingelogd als {{Auth::user()->name}}</a></li>
                @if(Auth::user()->isAdmin()) 
                    <li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-wrench"></span> Beheermenu</a></li>
                @endif
                <li><a href="{{ route('auth.signout') }}"><span class="glyphicon glyphicon-log-out"></span> Log uit</a></li>
            @endif                
            </ul>
        </div>
    </div>
</nav>