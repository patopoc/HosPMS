@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">New Users</div>
<div class="panel-body">

@include('admin.users.partials.messages')

{!!Form::open(['route' => 'admin.users.store', 'method' => 'post'])!!}
		 @include('admin.users.partials.scripts')
		 @include('admin.users.partials.fields')
		  <button type="submit" class="btn btn=success">Create User</button>
{!!Form::close()!!}
</div>
</div>
</div>
</div>
@endsection

@include('commonscripts')
@include('menu')