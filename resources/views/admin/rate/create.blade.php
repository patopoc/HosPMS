@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">New rate</div>
			<div class="panel-body">
			
			@include('admin.rate.partials.messages')
			
			{!!Form::open(['route' => 'admin.rate.store', 'method' => 'post'])!!}
					 
					 @include('admin.rate.partials.fields')
					  <button type="submit" class="btn btn-success">Create</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
</div>
@endsection

@include('admin.rate.partials.scripts')
@include('menu')