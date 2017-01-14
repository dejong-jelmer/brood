
            @if(!$bills->count())
                <p>Je hebt in de maand {{ Helper::monthNumberToMonthName($month) }} ({{ $year }}) geen bestellingen gedaan en dus ook geen broodrekening.</p>
            @else
                @foreach($bills as $bill)
                    <p>Besteld&nbsp;op <b> {{ $bill->pivot->updated_at->day }}&nbsp;{{ Helper::monthNumberToMonthName($bill->pivot->updated_at->month) }}:</b> {{ $bill->pivot->amount }}&nbsp;x&nbsp;<b>{{ $bill->bread }}</b> á&nbsp;€&nbsp;{{ number_format((float)$bill->price, 2, ',', '') }} totaalprijs: <b>€&nbsp;{{ str_replace('.', ',', $totalMonthPrice[] = Helper::totalPrice($bill->pivot->amount, $bill->price)) }}</b>.</p>
                @endforeach
            @endif
            <hr>
    <div class="col-md-offset-8">
        
            @if(isset($totalMonthPrice))
                <h3><b>€&nbsp;{{ str_replace('.', ',', Helper::totalMonthPrice($totalMonthPrice)) }}</b></h3>
            @endif
        </div>