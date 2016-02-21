@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit {{$data['service_plan']->name}}</div>
<div class="panel-body">
@include('admin.service_plans.partials.messages')

{!!Form::model($data['service_plan'], ['route' => ['admin.service_plans.update', $data['service_plan']], 'method' => 'put'])!!}
		  @include('admin.service_plans.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.service_plans.partials.delete')

</div>
</div>
@endsection

@include('admin.service_plans.partials.scripts')
@include('commonscripts')
@include('menu')


