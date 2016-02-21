<table class="table table-striped">
		<tr>
			<th>Role</th>			
			<th>Actions</th>
		</tr>
				
		@foreach ($roles as $role)
		<tr data-id="{{$role->id}}">
			<td> {{$role->name or ''}}</td>
			<td>
				<a href="{{ route('admin.role_details.show', $role->id) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>
		@endforeach
				
	</table>