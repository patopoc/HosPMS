@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit {{$data['property']->name}}</div>
<div class="panel-body">
@include('admin.property.partials.messages')

{!!Form::model($data['property'], ['route' => ['admin.property.update', $data['property'] ], 'method' => 'put', 'files' => 'true'])!!}
		  @include('admin.property.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>

</div>
</div>
@endsection

@include('admin.property.partials.scripts')
@include('commonscripts')

@include('menu')

