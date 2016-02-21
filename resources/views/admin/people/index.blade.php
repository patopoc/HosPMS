@extends('main')
@include('admin.people.partials.detail')		

@section('content')
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">People</div>
@include('alert')
	
<div class="panel-body">
	{!! Form::model(Request::only('name'), ['route' => 'admin.people.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
	  <div class="form-group">
	  	   {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}	  	   
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	{!! Form::close() !!}
	<p>
		<a class="btn btn-info" href="{{ route('admin.people.create') }}" role="button">New</a>
	</p>
	@include('admin.people.partials.table')
	
	{!! $people->render() !!}
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.people.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('admin.people.partials.scripts')
@include('menu')