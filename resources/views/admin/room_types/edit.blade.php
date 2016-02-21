@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit rooms {{$data['room']->type}}</div>
<div class="panel-body">
@include('admin.room_types.partials.messages')

{!!Form::model($data['room'], ['route' => ['admin.room_types.update', $data['room']], 'method' => 'put', 'files' => 'true'])!!}
		  @include('admin.room_types.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update rooms</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.room_types.partials.delete')

</div>
</div>
@endsection

@include('admin.room_types.partials.scripts')
@include('commonscripts')
@include('menu')


