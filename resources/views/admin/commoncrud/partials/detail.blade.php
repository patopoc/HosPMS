@extends('detailbox')

@section('detail')
<div class="form-group">
 	{!! Form::label('ci', 'CI') !!}
 	{!! Form::text('ci', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('name', 'Nombre') !!}
 	{!! Form::text('name', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('last_name', 'Apellido') !!}
 	{!! Form::text('last_name', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('email', 'Email') !!}
 	{!! Form::text('email', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('telephone', 'Telephone') !!}
 	{!! Form::text('telephone', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('country', 'Pais') !!}
 	{!! Form::text('country', null, ['class' => 'form-control', 'readonly' => true]) !!}	 	
    
</div>
@endsection