@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Service Plans</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.service_plans.create') }}" role="button">New</a>
	</p>
	@include('admin.service_plans.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.service_plans.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('menu')