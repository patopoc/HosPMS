@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Users</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.users.create') }}" role="button">New</a>
	</p>
	@include('admin.users.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.bed_types.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('menu')