@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Facilities</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.facilities.create') }}" role="button">New</a>
	</p>
	@include('admin.facilities.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.facilities.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.facilities.partials.scripts')
@include('commonscripts')
@include('menu')