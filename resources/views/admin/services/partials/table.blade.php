<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Actions</th>		
			
		</tr>
				
		@foreach ($services as $service)
		<tr data-id="{{$service->id}}">
			<td> {{$service->name or ''}}</td>
			<td> {{$service->price or ''}}</td>			
			<td>
				<a href="{{ route('admin.services.edit', $service) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>