@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">New Person</div>
<div class="panel-body">

@include('admin.people.partials.messages')

{!!Form::open(['route' => 'admin.people.store', 'method' => 'post'])!!}
		 @include('admin.people.partials.scripts')
		 @include('admin.people.partials.fields')
		  <button type="submit" class="btn btn-success">Create</button>
	{!!Form::close()!!}
</div>
</div>
</div>
</div>
@endsection
@include('menu')