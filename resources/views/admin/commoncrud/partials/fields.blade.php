@foreach($data['fieldsData']['fields'] as $field => $type)
	<div class="form-group">
 	{!! Form::label($field, trans("appstrings.". $data["fieldsData"]["key"]. ".labels." . $field)) !!}
 	@if($type == "text")
 		{!! Form::text($field, null, ['class' => 'form-control']) !!}
 	@elseif($type == "email")
 		{!! Form::email($field, null, ['class' => 'form-control']) !!}
 	@elseif($type == "select")
 		{!! Form::select($field, $data["selectData"], null, ['class' => 'form-control']) !!}
 	@endif	 	
    
	</div>
@endforeach