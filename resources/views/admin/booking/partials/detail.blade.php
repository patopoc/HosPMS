@extends('detailbox')

@section('detail')
<div class="form-group">
 	{!! Form::label('date', 'Date') !!}
 	{!! Form::text('date', null, ['class' => 'form-control']) !!}	 	
    
</div>

<div class="form-group">
	{!! Form::label('ci', 'CI') !!}	
 	{!! Form::text('ci', null, ['class' => 'form-control']) !!}
    
</div>
<div class="form-group">
 	{!! Form::label('name', 'Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>

<div class="form-group">
 	{!! Form::label('last_name', 'Last Name') !!}
 	{!! Form::text('last_name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('email', 'Email') !!}
 	{!! Form::text('email', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('telephone', 'Telephone') !!}
 	{!! Form::text('telephone', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('country', 'Country') !!}
 	{!! Form::text('country', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
	{!! Form::label('check_in', 'Check In') !!}
	{!! Form::text('check_in', null, ['class' => 'form-control']) !!}
</div>	 	
    
<div class="form-group">
	{!! Form::label('check_out', 'Check Out') !!}
 	{!! Form::text('check_out', null, ['class' => 'form-control']) !!}
</div>	 	
    
<div class="form-group">
	{!! Form::label('arrival_time', 'Arrival Time') !!}
 	{!! Form::text('arrival_time', null, ['class' => 'form-control']) !!}
    
</div>
<div class="form-group">
 	{!! Form::label('comments_and_requests', 'Comments And Requests') !!}
 	{!! Form::textarea('comments_and_requests', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('room_type', 'Room Type') !!}
  	{!! Form::text('room_type', null, ['class' => 'form-control']) !!}
 		 	    
</div>
<div class="form-group">
 	{!! Form::label('number_of_rooms', 'Rooms') !!}
 	{!! Form::text('number_of_rooms', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('adults', 'Number of Adults') !!}
 	{!! Form::number('adults', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('children', 'Number of Children') !!}
 	{!! Form::number('children', null, ['class' => 'form-control']) !!}	 	
    
</div>

<div class="form-group">
 	{!! Form::label('pets', 'Number of Pets') !!}
 	{!! Form::number('pets', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('rate_plan', 'Rate Plan') !!}
 	{!! Form::text('rate_plan', null, ['class' => 'form-control']) !!}
</div>

@endsection