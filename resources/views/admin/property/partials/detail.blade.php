@extends('detailbox')

@section('detail')
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
 	<img id="logo" name="logo" alt="" src="">   
</div>

<div class="form-group">
 	{!! Form::label('address', 'Address') !!}
 	{!! Form::text('address', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
	{!! Form::label('checkin_time', 'Hora de Check In') !!}
 	{!! Form::text('checkin_time', null, ['class' => 'form-control']) !!}
    
</div>
<div class="form-group">
 	{!! Form::label('checkout_time', 'Hora de Check Out') !!}
 	{!! Form::text('checkout_time', null, ['class' => 'form-control']) !!}
 	
</div>
<div class="form-group">
 	{!! Form::label('cancelation_policy', 'Cancelation Policy') !!}
 	{!! Form::textarea('cancelation_policy', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('time_zone', 'Timezone') !!}
 	{!! Form::text('time_zone', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('conditions', 'Conditions') !!}
 	{!! Form::textarea('conditions', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('pet_rules', 'Pet Rules') !!}
 	{!! Form::textarea('pet_rules', null, ['class' => 'form-control']) !!}	 	
    
</div>

@endsection