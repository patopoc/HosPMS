{!!Form::open( ['route' => ['admin.menus.destroy', $data['menuItem']->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.menus.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

