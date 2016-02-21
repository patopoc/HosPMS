@extends('main')
@include('admin.booking.partials.detail')

@section('content')
<!-- div class="container"-->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">Bookings</div>
@include('alert')
		
	
<div class="panel-body">

	{!! Form::model(Request::only('reference_code'), ['route' => 'admin.booking.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
	  <div class="form-group">
	  	   {!! Form::text('reference_code', null, ['class' => 'form-control', 'placeholder'=>'Reference Code']) !!}	  	
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	{!! Form::close() !!}
	
	@if($data['status'] == 'a')
	<p>
		<a class="btn btn-info" href="{{ route('admin.booking.create') }}" role="button">New</a>
	</p>
	@endif
	
	@include('admin.booking.partials.table')	
	
	@if(isset($data['bookings']))
	{!! $data['bookings']->render()!!}
	@endif
	
</div>
</div>
</div>
</div>
<!-- /div-->
{!!Form::open( ['route' => ['admin.booking.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection
@include('commonscripts')
@include('menu')