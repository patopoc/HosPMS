<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Actions</th>
			
		</tr>
				
		@foreach ($service_plans as $service_plan)
		<tr data-id="{{$service_plan->id}}">
			<td> {{$service_plan->name or ''}}</td>
			<td>
				<a href="{{ route('admin.service_plans.edit', $service_plan) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>
			@foreach($service_plan->services as $service)
				<tr data-id="{{$service->id}}">
					<td> {{$service->name or ''}}</td>
					<td>										
						<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
					</td>
				</tr>
			
			@endforeach	
		@endforeach
				
	</table>