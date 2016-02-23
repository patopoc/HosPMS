@foreach($data['fieldsData']['fields'] as $field => $type)
	<div class="form-group">
 	{!! Form::label($field, trans("appstrings.". $data["fieldsData"]["key"]. ".labels." . $field)) !!}
 	@if($type == "text")
 		{!! Form::text($field, null, ['class' => 'form-control']) !!}
 	@elseif($type == "email")
 		{!! Form::email($field, null, ['class' => 'form-control']) !!}
 	@elseif($type == "select")
 		{!! Form::select($field, $data["selectData"][$field], null, ['class' => 'form-control']) !!}
 	@elseif($type == "select-group")
	<div id="items_container">
 		@if(isset($data["model"]))
	 		@for($i=0 ; $i < count($data["model"]->{$field}); $i++) 
				<div id="form-group{{$i}}" class="form-group">		 	
			    {!! Form::select($field . $i, $data['selectData'][$field], $data['model']->{$field}[$i]->id, 
			    	['class' => 'form-control', 		    	
			    	'onchange' => 'addItem(this,"items_container",'. json_encode($data["selectData"][$field . "Json"]) .', "' . $field . '");']) !!}	 	
				<a href="#" class="btn-remove-item"><span class="glyphicon glyphicon-minus-sign"></span>Remove</a>
				</div>
			@endfor
			<div id="form-group{{ count($data['model']->{$field}) }}" class="form-group">
			
		    {!! Form::select($field. count($data['model']->{$field}), $data['selectData'][$field], null, 
		    ['class' => 'form-control',
		    'onchange' => 'addItem(this,"items_container",'. json_encode($data["selectData"][$field . "Json"]) .',  "' . $field . '");']) !!}	 	
		    
			</div>
		@else
			<div id="form-group0" class="form-group">
		    {!! Form::select($field . "0", $data['selectData'][$field], null, 
		    ['class' => 'form-control',
		    'onchange' => 'addItem(this,"items_container",'. json_encode($data["selectData"][$field . "Json"]) .',  "' . $field . '");']) !!}	 	
		    
			</div>
		@endif	
	</div>
 	@endif	 	
    
	</div>
@endforeach