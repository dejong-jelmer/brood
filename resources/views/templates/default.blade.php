<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Brood bestellen bij Arend voor Iewan en Eikpunt</title>
    
    <!-- Icon -->
    <link rel="icon" href="{{ URL::asset('img/icon.jpg') }}">
    <!-- Latest compiled and minified CSS - Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Costum CCS stylesheet -->
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <!-- switch button css-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/switch.css') }}">
    <!-- Latest compiled and minified JavaScript - JQuery -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript - Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Costum Javascript - jQuery -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>

</head>
<body>
    @include('templates.partials.navigation')

    <div class="container-fluid">
        @include('templates.partials.alerts')
        @yield('content')
    </div>
    
</body>
</html>