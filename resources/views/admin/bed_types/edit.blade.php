@extends('main')

@section('content')
<!-- div class="container"-->
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit Bed Type: {{$bed_type->type}}</div>
<div class="panel-body">
@include('admin.bed_types.partials.messages')

{!!Form::model($bed_type, ['route' => ['admin.bed_types.update', $bed_type], 'method' => 'put'])!!}
		  @include('admin.bed_types.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.bed_types.partials.delete')

</div>
</div>
<!-- /div -->
@endsection

@include('admin.bed_types.partials.scripts')
@include('commonscripts')

@include('menu')

