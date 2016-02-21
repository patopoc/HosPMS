@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit {{$data['user']->username}}</div>
<div class="panel-body">
@include('admin.users.partials.messages')

{!!Form::model($data['user'], ['route' => ['admin.users.update', $data['user']], 'method' => 'put'])!!}
		  @include('admin.users.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.users.partials.delete')

</div>
</div>
@endsection

@include('admin.users.partials.scripts')
@include('commonscripts')
@include('menu')


