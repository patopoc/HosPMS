{!!Form::open( ['route' => ['admin.roles.destroy', $data['role']->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.roles.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

