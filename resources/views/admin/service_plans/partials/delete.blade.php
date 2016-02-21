{!!Form::open( ['route' => ['admin.service_plans.destroy', $data['service_plan']->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.service_plans.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

