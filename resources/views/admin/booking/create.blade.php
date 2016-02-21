@extends('main')

@section('content')
<div class="row">
<div class="col-lg-8">
<div class="panel panel-default">
<div class="panel-heading">New Booking</div>
<div class="panel-body">

@include('admin.booking.partials.messages')

{!!Form::open(['route' => 'admin.booking.store', 'method' => 'post'])!!}
		 @include('admin.booking.partials.scripts')
		 @include('admin.booking.partials.fields')
		  <button type="submit" class="btn btn-success">Book</button>
	{!!Form::close()!!}
</div>
</div>
</div>
</div>

@endsection
@include('menu')