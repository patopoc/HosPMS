{!!Form::open( ['route' => ['admin.booking.destroy', $data["booking"]->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.booking.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

