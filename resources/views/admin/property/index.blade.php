@extends('main')
@include('admin.property.partials.detail')

@section('content')
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Properties</div>
@include('alert')
	
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.property.create') }}" role="button">New</a>
	</p>	
	@include('admin.property.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.property.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('admin.people.partials.scripts')
@include('menu')