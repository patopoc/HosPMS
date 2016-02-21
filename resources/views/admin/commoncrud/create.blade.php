@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">{{ trans("appstrings.". $data["fieldsData"]["key"]. "." . $data["fieldsData"]["title"]) }}</div>
<div class="panel-body">

@include('admin.commoncrud.partials.messages')

{!!Form::open(['route' => 'admin.'. $data['controllerRouteName'] .'.store', 'method' => 'post'])!!}
		 @include('admin.commoncrud.partials.scripts')
		 @include('admin.commoncrud.partials.fields')
		  <button type="submit" class="btn btn-success">Create</button>
	{!!Form::close()!!}
</div>
</div>
</div>
</div>
@endsection
@include('menu')