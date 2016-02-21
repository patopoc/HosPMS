{!!Form::open( ['route' => ['admin.users.destroy', $data["user"]->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.users.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

