

<div class="form-group">
 	{!! Form::label('username', 'Username') !!}
 	{!! Form::text('username', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('password', 'Password') !!}
 	{!! Form::password('password', ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('password_confirmation', 'Repeat Password') !!}
 	{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('ci', 'CI') !!}
 	@if(isset($data['user']))
 		{!! Form::text('ci', $data['user']->person->ci, ['class' => 'form-control', 'placeholder' => 'Enter CI and press Enter']) !!}
 	@else
 		{!! Form::text('ci', null, ['class' => 'form-control', 'placeholder' => 'Enter CI and press Enter']) !!}
 	@endif	 	
    
</div>
<div class="form-group">
 	{!! Form::label('name', 'Name') !!}
 	@if(isset($data['user']))
 		{!! Form::text('name', $data['user']->person->name, ['class' => 'form-control']) !!}
 	@else
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
 	@endif	
 		 	
    
</div>

<div class="form-group">
 	{!! Form::label('last_name', 'Apellido') !!}
 	@if(isset($data['user']))
 		{!! Form::text('last_name', $data['user']->person->last_name, ['class' => 'form-control']) !!}
 	@else
		{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
 	@endif	
 		 	
    
</div>
<div class="form-group">
 	{!! Form::label('email', 'Email') !!}
 	@if(isset($data['user']))
 		{!! Form::email('email', $data['user']->person->email, ['class' => 'form-control']) !!}
 	@else
		{!! Form::email('email', null, ['class' => 'form-control']) !!}
 	@endif	
 		 	
    
</div>
<div class="form-group">
 	{!! Form::label('telephone', 'Telephone') !!}.
 	@if(isset($data['user']))
 		{!! Form::text('telephone', $data['user']->person->telephone, ['class' => 'form-control']) !!}
 	@else
		{!! Form::text('telephone', null, ['class' => 'form-control']) !!}
 	@endif	
 		 	
    
</div>
<div class="form-group">
 	{!! Form::label('id_country', 'Pais') !!}
 	@if(isset($data['user']))
 		{!! Form::select('id_country', ['' => 'Select Country'] + $data["countries"], $data['user']->person->id_country, ['class' => 'form-control']) !!}
 	@else
		{!! Form::select('id_country', ['' => 'Select Country'] + $data["countries"], null, ['class' => 'form-control']) !!}
 	@endif
 		 	
    
</div>

<div class="form-group">
 	{!! Form::label('id_role', 'Roles') !!}
 	{!! Form::select('id_role', $data["roles"], null, ['class' => 'form-control', 'placeholder' => 'Select Role']) !!}	 	    
</div>
<div id="properties-container">
{!! Form::label('property0', 'Properties') !!}
<div id="form-group0" class="form-group"> 	
 	{!! Form::select('property0', $data["properties"], null, 
 		['class' => 'form-control', 
 		'placeholder' => 'Select Property (default)', 
 		'onchange' => 'addItem(this,"properties-container",'. json_encode($data["propertiesJson"]) .', "property");']) !!}	 	    
</div>
</div>