@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">New Property</div>
			<div class="panel-body">
			
			@include('admin.property.partials.messages')
			
			{!!Form::open(['route' => 'admin.property.store', 'method' => 'post', 'files' => 'true'])!!}
					 
					 @include('admin.property.partials.fields')
					  <button type="submit" class="btn btn-success">Create Property</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@endsection

@include('admin.property.partials.scripts')
@include('menu')