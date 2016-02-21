<div class="form-group">
 	{!! Form::label('name', 'Property Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('info', 'Description') !!}
 	{!! Form::text('info', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('logo', 'Logo') !!}
 	@if(isset($property) && $property->logo !== null)
 		<img alt="" src="{{asset($property->logo->url)}}">
 	@endif 	
 	{!! Form::file('logo', ['class' => 'form-control']) !!}	 	
    
</div>

<div class="form-group">
 	{!! Form::label('address', 'Address') !!}
 	{!! Form::text('address', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
	{!! Form::label('checkin_time', 'Hora de Check In') !!}
	<div class='input-group date' id='checkin-time-picker'>
	 	{!! Form::text('checkin_time', null, ['class' => 'form-control']) !!}
	 	<span class="input-group-addon">
        	<span class="glyphicon glyphicon-time"></span>
        </span>
 	</div>	 	
    
</div>
<div class="form-group">
 	{!! Form::label('checkout_time', 'Hora de Check Out') !!}
 	<div class='input-group date' id='checkout-time-picker'>
 		{!! Form::text('checkout_time', null, ['class' => 'form-control']) !!}
 		<span class="input-group-addon">
        	<span class="glyphicon glyphicon-time"></span>
        </span>
 	</div>
 		 	
    
</div>
<div class="form-group">
 	{!! Form::label('cancelation_policy', 'Cancelation Policy') !!}
 	{!! Form::text('cancelation_policy', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('time_zone', 'Timezone') !!}
 	{!! Form::select('time_zone', config('options.timezones') ,null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('conditions', 'Conditions') !!}
 	{!! Form::text('conditions', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('pet_rules', 'Pet Rules') !!}
 	{!! Form::text('pet_rules', null, ['class' => 'form-control']) !!}	 	
    
</div>

