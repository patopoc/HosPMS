{!!Form::open( ['route' => ['admin.facilities.destroy', $facility->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.facilities.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

