{!!Form::open( ['route' => ['admin.services.destroy', $service->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.services.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

