@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Rooms</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.room_types.create') }}" role="button">New</a>
	</p>
	@include('admin.room_types.partials.table')
	
	
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.room_types.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.room_types.partials.scripts')
@include('commonscripts')
@include('menu')