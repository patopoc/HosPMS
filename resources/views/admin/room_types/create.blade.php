@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">New Room</div>
			<div class="panel-body">
			
			@include('admin.bed_types.partials.messages')
			
			{!!Form::open(['route' => 'admin.room_types.store', 'method' => 'post', 'files' => 'true'])!!}
					 
					 @include('admin.room_types.partials.fields')
					  <button type="submit" class="btn btn-success">Create</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@endsection

@include('admin.bed_types.partials.scripts')
@include('menu')