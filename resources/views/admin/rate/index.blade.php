@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Rates</div>
@include('alert')
	
<div class="panel-body">
	<p>
		<a class="btn btn-info" href="{{ route('admin.rate.create') }}" role="button">New</a>
	</p>	
	
	@include('admin.rate.partials.table')
	
	
</div>
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.rate.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('admin.rate.partials.scripts')
@include('commonscripts')
@include('menu')