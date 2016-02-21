{!!Form::open( ['route' => ['admin.room_types.destroy', $data['room']->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.room_types.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

