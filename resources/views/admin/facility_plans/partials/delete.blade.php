{!!Form::open( ['route' => ['admin.facility_plans.destroy', $data['facility_plan']->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  <a class="btn btn-info" href="{{ route('admin.facility_plans.index') }}" role="button">Cancel</a>
		  
{!!Form::close()!!}

