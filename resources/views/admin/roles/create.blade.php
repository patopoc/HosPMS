@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">New Role</div>
			<div class="panel-body">
			
			@include('admin.roles.partials.messages')
			
			{!!Form::open(['route' => 'admin.roles.store', 'method' => 'post'])!!}
					@include('admin.roles.partials.fields')
					@include('admin.roles.partials.scripts')
					<button type="submit" class="btn btn-success">Create</button>
			{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@endsection
@include('menu')