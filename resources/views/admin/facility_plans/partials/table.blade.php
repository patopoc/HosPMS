<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Actions</th>			
			
		</tr>
				
		@foreach ($facility_plans as $facility_plan)
		<tr data-id="{{$facility_plan->id}}">
			<td> 
				{{$facility_plan->name or ''}}
				<table>
					@foreach($facility_plan->facilities as $facility)
						<tr data-id="{{$facility->id}}">
							<td> {{$facility->name or ''}}</td>							
						</tr>
					
					@endforeach
				</table>
			</td>
			<td>
				<a href="{{ route('admin.facility_plans.edit', $facility_plan) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>			
		</tr>			
		@endforeach
				
	</table>