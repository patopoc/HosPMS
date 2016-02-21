@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit Property {{$property->name}}</div>
<div class="panel-body">
@include('admin.people.partials.messages')

{!!Form::model($property, ['route' => ['admin.property.update', $property], 'method' => 'put', 'files' => 'true'])!!}
		  @include('admin.property.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.property.partials.delete')

</div>
</div>
@endsection

@include('admin.people.partials.scripts')
@include('commonscripts')

@include('menu')

