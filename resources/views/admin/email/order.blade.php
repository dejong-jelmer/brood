@extends('templates.email')
   
@section('content')

<p>
Hallo Arend,
<br>
<br>
De bestelling van Iewan voor aanstaande {{ Helper::nextDeliveryDay($mostRecentOrder->updated_at) }}:

    @include('admin.partials.totalorders')

Groeten,
<br>
<br>
{{ $name }}
</p>
          
@stop

