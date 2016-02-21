<table class="table table-striped">
		<tr>
			<th>CI</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Pais</th>
			<th>Actions</th>
		</tr>
				
		@foreach ($people as $person)
		<tr data-id="{{$person->id}}">
			<td> <a href="#" data-toggle="modal" data-target="#detailModal" data-detail="{{json_encode($person->fullData())}}"> {{$person->ci}}</a></td>
			<td> {{$person->name}}</td>
			<td> {{$person->last_name}}</td>
			<td> {{$person->country->name or ''}}</td>			
			<td>
				<a href="{{ route('admin.people.edit', $person) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
		@endforeach
				
	</table>