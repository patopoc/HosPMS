@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Menu Settings</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.menus.create') }}" role="button">New</a>
	</p>
	@include('admin.menus.partials.table')
	
	
</div>
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.menus.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.menus.partials.scripts')
@include('commonscripts')
@include('menu')
