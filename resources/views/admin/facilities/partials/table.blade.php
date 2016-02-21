<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Actions</th>
			
		</tr>
				
		@foreach ($facilities as $facility)
		<tr data-id="{{$facility->id}}">
			<td> {{$facility->name or ''}}</td>
			<td> {{$facility->description or ''}}</td>			
			<td>
				<a href="{{ route('admin.facilities.edit', $facility) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>