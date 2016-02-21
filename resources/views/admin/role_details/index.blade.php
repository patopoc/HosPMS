@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Role Details</div>
@if(Session::has('message'))
	<p class="alert alert-success"> {{Session::get('message')}}</p>
@endif
		
	
<div class="panel-body">
	{!!Form::open(['route' => 'admin.role_details.store', 'method' => 'post'])!!}
		@include('admin.role_details.partials.table')
		<input type="hidden" name="role-id" value="{{$data['role']->id}}">
		<button type="submit" class="btn btn-default">Save</button>
	{!!Form::close() !!}
</div>
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.role_details.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('menu')