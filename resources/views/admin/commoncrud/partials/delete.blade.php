{!!Form::open( ['route' => ['admin.'. $data['controllerRouteName'] .'.destroy', $data["model"]->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.'. $data['controllerRouteName'] .'.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

