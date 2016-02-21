@if(isset($data['today']))
	<h3>Today Arrivals</h3>
@endif

@if($data['status'] == 'c')
	<h3>Canceled Bookings</h3>
@endif

<table class="table table-striped">
		<tr>
			<th>Reference</th>
			<th>Name</th>
			<th>Check In</th>
			<th>Nights</th>			
			<th>Total Price</th>
			@if($data['status'] == 'a')
				<th>Actions</th>
			@endif
		</tr>
		@if(isset($data['today']))		
			@foreach ($data['today'] as $booking)
				<tr data-id="{{$booking->id}}">
					<td><a href="" data-toggle="modal" data-target="#detailModal" data-detail="{{json_encode($booking->fullData())}}"> {{$booking->reference_code or ''}}</a></td>
					<td> {{$booking->personData->full_name or ''}}</td>
					<td> {{$booking->check_in or ''}}</td>					
					
					<td> {{$booking->number_of_days or ''}}</td>
					<td> {{$booking->total_price}}</td>					
					<td>
						<a href="{{route('admin.booking.edit', $booking->id)}}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
					</td>
				</tr>	
			@endforeach
		@else
			@foreach ($data['bookings'] as $booking)
				<tr data-id="{{$booking->id}}">
					<td><a href="" data-toggle="modal" data-target="#detailModal" data-detail="{{json_encode($booking->fullData())}}"> {{$booking->reference_code or ''}}</a></td>
					<td> {{$booking->personData->full_name or ''}}</td>
					<td> {{$booking->check_in or ''}}</td>					
					<td> {{$booking->number_of_days or ''}}</td>
					<td> {{$booking->total_price}}</td>
					@if($data['status'] == 'a')
					<td>
						<a href="{{route('admin.booking.edit', $booking->id)}}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
					</td>
					@endif
					
				</tr>	
			@endforeach
		@endif
				
</table>

@if(isset($data['tomorrow']))	
<h3>Tomorrow Arrivals</h3>
<table class="table table-striped">
		<tr>
			<th>Reference</th>
			<th>Name</th>
			<th>Check In</th>
			<th>Nights</th>
			<th>Total Price</th>
			<th>Actions</th>
			
		</tr>
	@foreach ($data['tomorrow'] as $booking)
		<tr data-id="{{$booking->id}}">
			<td><a href="" data-toggle="modal" data-target="#detailModal" data-detail="{{json_encode($booking->fullData())}}"> {{$booking->reference_code or ''}}</a></td>
					<td> {{$booking->personData->full_name or ''}}</td>
					<td> {{$booking->check_in or ''}}</td>					
					<td> {{$booking->number_of_days or ''}}</td>
					<td> {{$booking->total_price}}</td>
			<td>
				<a href="{{route('admin.booking.edit', $booking->id)}}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
		</tr>	
	@endforeach	
				
</table>
@endif