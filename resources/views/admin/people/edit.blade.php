@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit Person {{$data["person"]->name}}</div>
<div class="panel-body">
@include('admin.people.partials.messages')

{!!Form::model($data["person"], ['route' => ['admin.people.update', $data["person"]], 'method' => 'put'])!!}
		  @include('admin.people.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.people.partials.delete')

</div>
</div>
@endsection

@include('admin.people.partials.scripts')
@include('commonscripts')
@include('menu')


