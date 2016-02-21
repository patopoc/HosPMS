@extends('main')

@section('content')
<div class="row">
<div class="col-lg-10">
<div class="panel panel-default">
<div class="panel-heading">Edit Facility: {{$facility->name}}</div>
<div class="panel-body">
@include('admin.facilities.partials.messages')

{!!Form::model($facility, ['route' => ['admin.facilities.update', $facility], 'method' => 'put'])!!}
		  @include('admin.facilities.partials.fields')	 
		 
		  <button type="submit" class="btn btn-success">Update</button>
{!!Form::close()!!}


</div>
</div>
@include('admin.facilities.partials.delete')

</div>
</div>
@endsection

@include('admin.facilities.partials.scripts')
@include('commonscripts')
@include('menu')


