{!!Form::open( ['route' => ['admin.'. $data['controllerRouteName'] .'.destroy', $data["models"]->id], 'method' => 'delete', 
				'id' => 'form-delete'])!!}
	 
		  <button type="submit" class="btn btn-danger">Delete</button>
		  @if(isset($data["routeParam"]))
		  <a class="btn btn-info" href="{{ route('admin.'. $data['controllerRouteName'] .'.index') }}?{{$data['routeParam']}}" role="button">Cancel</a>
		  @else
		  <a class="btn btn-info" href="{{ route('admin.'. $data['controllerRouteName'] .'.index') }}" role="button">Cancel</a>
		  @endif
{!!Form::close()!!}

