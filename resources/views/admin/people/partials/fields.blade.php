<div class="form-group">
 	{!! Form::label('ci', 'CI') !!}
 	{!! Form::text('ci', null, ['class' => 'form-control', 'placeholder' => 'please enter your ci']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('name', 'Nombre') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('last_name', 'Apellido') !!}
 	{!! Form::text('last_name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('email', 'Email') !!}
 	{!! Form::email('email', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('telephone', 'Telephone') !!}
 	{!! Form::text('telephone', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('id_country', 'Pais') !!}
 	{!! Form::select('id_country', ['' => 'Select Country'] + $data["countries"], null, ['class' => 'form-control']) !!}	 	
    
</div>