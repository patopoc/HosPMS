@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">New Service</div>
			<div class="panel-body">
			
			@include('admin.services.partials.messages')
			
			{!!Form::open(['route' => 'admin.services.store', 'method' => 'post'])!!}
					 
					 @include('admin.services.partials.fields')
					  <button type="submit" class="btn btn-success">Create</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@endsection

@include('admin.services.partials.scripts')
@include('menu')