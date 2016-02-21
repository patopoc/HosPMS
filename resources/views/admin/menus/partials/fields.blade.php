<div class="form-group">
 	{!! Form::label('name', 'Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('description', 'Description') !!}
 	{!! Form::text('description', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('icon', 'icon') !!}
 	{!! Form::text('icon', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('route', 'Route') !!}
 	{!! Form::select('route', $data["routes"], null, ['class' => 'form-control', 'placeholder' => 'Route']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('type', 'Type') !!}
 	{!! Form::select('type', ["section" => "section", "item" => "item"],null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('id_module', 'Module') !!}
 	{!! Form::select('id_module', ['' => 'Select Module'] + $data["modules"], null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('action', 'Action') !!}
 	{!! Form::select('action', ["show"=>"show","insert"=>"insert","update"=>"update","delete"=>"delete", ],null, ['class' => 'form-control']) !!}	 	
    
</div>
<div class="form-group">
 	{!! Form::label('id_section', 'Section') !!}
 	{!! Form::select('id_section', ['' => 'Select Section'] + $data["menuSections"], null, ['class' => 'form-control']) !!}	 	
    
</div>