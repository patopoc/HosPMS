@extends('main')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">New Menu Item</div>
			<div class="panel-body">
			
			@include('admin.menus.partials.messages')
			
			{!!Form::open(['route' => 'admin.menus.store', 'method' => 'post'])!!}
					 
					 @include('admin.menus.partials.fields')
					  <button type="submit" class="btn btn-success">Create</button>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
</div>
@endsection

@include('admin.menus.partials.scripts')
@include('menu')