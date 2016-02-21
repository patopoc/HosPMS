@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Services</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.services.create') }}" role="button">New</a>
	</p>
	@include('admin.services.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.services.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.services.partials.scripts')
@include('commonscripts')
@include('menu')