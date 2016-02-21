@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">{{trans("appstrings." . $data["fieldsData"]["key"] . "." . $data["fieldsData"]["title"]). " " . $data["model"]->name}}</div>
<div class="panel-body">
@include('admin.commoncrud.partials.messages')

{!!Form::model($data["model"], ['route' => ['admin.'. $data['controllerRouteName'] .'.update', $data["model"]], 'method' => 'put'])!!}
		  @include('admin.commoncrud.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.commoncrud.partials.delete')

</div>
</div>
@endsection

@include('admin.commoncrud.partials.scripts')
@include('commonscripts')
@include('menu')


