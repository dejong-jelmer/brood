@extends('templates.email')
   
@section('content')

<p>
Hallo Arend,
<br>
<br>
De bestelling van Iewan:

    @include('admin.partials.totalorders')

Groeten,
<br>
<br>
{{ $name }}
</p>
          
@stop

