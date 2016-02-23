@extends('main')
@include('admin.commoncrud.partials.detail')		

@section('content')
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
@if(isset($data["titleParams"]))
	<div class="panel-heading">
	{{ trans("appstrings." . $data["labels"]["key"]. "." . $data["labels"]["title"], $data["titleParams"]) }}
	</div>
@else
	<div class="panel-heading">
	{{ trans("appstrings." . $data["labels"]["key"]. "." . $data["labels"]["title"]) }}
	</div>
@endif

@include('alert')
	
<div class="panel-body">
	{!! Form::model(Request::only('name'), ['route' => 'admin.'. $data["controllerRouteName"] .'.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
	  <div class="form-group">
	  	   {!! Form::text('name', null, ['class' => 'form-control', 'placeholder'=>'Name']) !!}	  	   
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	  @if(isset($data['routeParams']))
	  	@foreach($data['routeParams'] as $key => $val)
	  		<input type="hidden" name="{{$key}}" value="{{$val}}">	
	  	@endforeach	  
	  @endif
	{!! Form::close() !!}
	<p>
		<a class="btn btn-info" href="{{ route('admin.'. $data['controllerRouteName'] .'.create') }}" role="button">New</a>
	</p>
	@include('admin.commoncrud.partials.table')
	
	{!! $data["models"]->render() !!}
</div>
</div>
</div>
</div>
{!!Form::open( ['route' => ['admin.'. $data['controllerRouteName'] .'.destroy', ':PERSON_ID'], 'method' => 'delete', 'id'=>'form-delete'])!!}
{!!Form::close()!!}

@endsection

@include('commonscripts')
@include('admin.commoncrud.partials.scripts')
@include('menu')