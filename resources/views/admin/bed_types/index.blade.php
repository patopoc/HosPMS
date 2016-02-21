@extends('main')

@section('content')
<!--div class="container"-->
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Bed Types</div>
@include('alert')
		
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.bed_types.create') }}" role="button">New</a>
	</p>
	
	@include('admin.bed_types.partials.table')
	
	
</div>
</div>
</div>
</div>
<!-- /div -->
{!!Form::open( ['route' => ['admin.bed_types.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.bed_types.partials.scripts')
@include('commonscripts')
@include('menu')