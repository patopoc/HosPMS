<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Info</th>
			<th>Logo</th>
			<th>Address</th>
			
			<th>Actions</th>
		</tr>
				
		@foreach ($properties as $property)
		<tr data-id="{{$property->id}}">
			<td><a href="#" data-toggle="modal" data-target="#detailModal" data-detail="{{json_encode($property->fullData())}}"> {{$property->name or ''}}</a></td>
			<td> {{$property->info or ''}}</td>
			<td>
			@if($property->logo !== null)
				<img alt="" src="{{ asset($property->logo->url)}}">
			@endif	
			</td>
			<td> {{$property->address or ''}}</td>					
			<td>
				<a href="{{ route('admin.property.edit', $property) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>