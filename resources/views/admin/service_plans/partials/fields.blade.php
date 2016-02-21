@if(isset($data['service_plan']))
	<div class="form-group">
 	{!! Form::label('name', 'Service Plan Name') !!}
 	{!! Form::text('name', $data['service_plan']->name, ['class' => 'form-control']) !!}	 	
    
	</div>
	<div id="services_container">
	{!! Form::label('service', 'Facilites') !!}
		@for($i=0 ; $i < count($data['service_plan']->services); $i++)
			<div id="form-group{{$i}}" class="form-group">		 	
		    {!! Form::select('service'.$i, $data['services'], $data['service_plan']->services[$i]->id, 
		    ['class' => 'form-control', 
		    "placeholder" => "Select Service",
		    'onchange' => 'addItem(this,"services_container",'. json_encode($data["servicesJson"]) .', "service");']) !!}	 	
			<a href="#" class="btn-remove-item"><span class="glyphicon glyphicon-minus-sign"></span>Remove</a>
			</div>
		@endfor
		<div id="form-group{{count($data['service_plan']->services)}}" class="form-group">
	    {!! Form::select('service'. count($data['service_plan']->services), $data['services'], null, 
	    ['class' => 'form-control',
	    'placeholder' => 'Select Service', 
	    'onchange' => 'addItem(this,"services_container",'. json_encode($data["servicesJson"]) .', "service");']) !!}	 	
	    
		</div>
	</div>
@else
<div class="form-group">
 	{!! Form::label('name', 'Service Plan Name') !!}
 	{!! Form::text('name', null, ['class' => 'form-control']) !!}	 	
    
</div>
<div id="services_container">
	{!! Form::label('service0', 'Services') !!}
	<div id="form-group0" class="form-group">	 	
	    {!! Form::select('service0', $data['services'], null, 
	    ['class' => 'form-control',
	    'placeholder' => 'Select Service', 
	    'onchange' => 'addItem(this,"services_container",'. json_encode($data["servicesJson"]) .', "service");']) !!}	 	
	    
	</div>
</div>
@endif



