<table class="table table-striped">
		<tr>
			<th>Bed Types</th>
			<th>Actions</th>
			
		</tr>
				
		@foreach ($bed_types as $bed_type)
		<tr data-id="{{$bed_type->id}}">
			<td> {{$bed_type->type or ''}}</td>
			<td>
				<a href="{{ route('admin.bed_types.edit', $bed_type) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>