{!!Form::open( ['route' => ['admin.rate.destroy', $rate->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.rate.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

