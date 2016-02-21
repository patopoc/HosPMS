@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit Menu Item {{$data['menuItem']->name}}</div>
<div class="panel-body">
@include('admin.menus.partials.messages')

{!!Form::model($data['menuItem'], ['route' => ['admin.menus.update', $data['menuItem']], 'method' => 'put'])!!}
		  @include('admin.menus.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.menus.partials.delete')

</div>
</div>
@endsection

@include('admin.menus.partials.scripts')
@include('commonscripts')
@include('menu')


