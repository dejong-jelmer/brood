<div class="form-group{{ $errors->has('bread[]') ? ' has-error' : '' }}">
	<label for="bread">Brood:</label>
    <select id="bread[]" name="bread[]" class="form-control">
		<option></option>
		@foreach ($breads as $bread)
       		<option value="{{ $bread->id }}">
				{{ $bread->bread }} - € {{ number_format((float)$bread->price, 2, ',', '') }}
  	   		</option>
  		@endforeach
	</select>
	@if ($errors->has('bread[]'))
		<span class="help-block">{{ $errors->first('bread[]') }}</span>
	@endif
</div>

<div class="form-group{{ $errors->has('amount[]') ? ' has-error' : '' }}">
<label for="amount">Aantal:</label>
    <select id="amount[]" name="amount[]" class="form-control">
    	<option></option>
    	<option value="1">1</option>
    	<option value="2">2</option>
    	<option value="3">3</option>
    	<option value="4">4</option>
    	<option value="5">5</option>
    	<option value="6">6</option>
    	<option value="7">7</option>
    	<option value="8">8</option>
    	<option value="9">9</option>
    	<option value="10">10</option>
    </select>
    @if ($errors->has('amount[]'))
    	<span class="help-block">{{ $errors->first('amount[]') }}</span>
	@endif
</div>
