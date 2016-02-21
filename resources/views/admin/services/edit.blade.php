@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit {{$service->name}}</div>
<div class="panel-body">
@include('admin.services.partials.messages')

{!!Form::model($service, ['route' => ['admin.services.update', $service], 'method' => 'put'])!!}
		  @include('admin.services.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.services.partials.delete')

</div>
</div>
@endsection

@include('admin.services.partials.scripts')
@include('commonscripts')
@include('menu')


