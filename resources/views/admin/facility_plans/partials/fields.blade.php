
@if(isset($data['facility_plan']))
	<div class="form-group">
 	{!! Form::label('name', 'Facility Plan Name') !!}
 	{!! Form::text('name', $data['facility_plan']->name, ['class' => 'form-control']) !!}	 	
    
	</div>
	<div id="facilities_container">
	{!! Form::label('facility', 'Facilites') !!}
		@for($i=0 ; $i < count($data['facility_plan']->facilities); $i++)
			<div id="form-group{{$i}}" class="form-group">		 	
		    {!! Form::select('facility'.$i, $data['facilities'], $data['facility_plan']->facilities[$i]->id, 
		    	['class' => 'form-control', 
		    	"placeholder" => "Select Facility",
		    	'onchange' => 'addItem(this,"facilities_container",'. json_encode($data["facilitiesJson"]) .', "facility");']) !!}	 	
			<a href="#" class="btn-remove-item"><span class="glyphicon glyphicon-minus-sign"></span>Remove</a>
			</div>
		@endfor
		<div id="form-group{{count($data['facility_plan']->facilities)}}" class="form-group">
	    {!! Form::select('facility'. count($data['facility_plan']->facilities), $data['facilities'], null, 
	    ['class' => 'form-control',
	    'placeholder' => 'Select a Facility', 
	    'onchange' => 'addItem(this,"facilities_container",'. json_encode($data["facilitiesJson"]) .', "facility");']) !!}	 	
	    
		</div>
	</div>
@else
<div class="form-group">
 	{!! Form::label('name', 'Facility Plan Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div id="facilities_container">
	{!! Form::label('facility0', 'Facilites') !!}
	<div id="form-group0" class="form-group">	 	
	    {!! Form::select('facility0', $data['facilities'], null, 
	    ['class' => 'form-control',
	    'placeholder' => 'Select a Facility', 
	    'onchange' => 'addItem(this,"facilities_container",'. json_encode($data["facilitiesJson"]) .', "facility");']) !!}	 	
	    
	</div>
</div>
@endif

