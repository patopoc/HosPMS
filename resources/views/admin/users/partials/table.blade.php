<table class="table table-striped">
		<tr>
			<th>User</th>
			<th>Name</th>			
			<th>Properties</th>
			<th>Role</th>	
			<th>Actions</th>		
		</tr>
				
		@foreach ($users as $user)
		<tr data-id="{{$user->id}}">
			<td> {{$user->username or ''}}</td>
			<td> {{$user->person->name or ''}}</td>
			<td> 
			@foreach($user->properties as $property)
			{{$property->name or ''}}
			<br>
			@endforeach
			</td>
			<td> {{$user->role->name or ''}}</td>
			<td>
				<a href="{{route('admin.users.edit', $user)}}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>