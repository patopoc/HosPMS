<table class="table table-striped">
		
		<tr>
		@foreach ($data["labels"]["list"] as $label => $type)
			<th>{{ trans("appstrings." . $data["labels"]["key"] . ".labels." . $label) }}</th>			
		@endforeach
			<th>{{ trans("appstrings.models.actions") }}</th>
		</tr>
				
		@foreach ($data["model"] as $model)
		<tr data-id="{{$model->id}}">			
			@foreach ($data["labels"]["list"] as $label => $type)	
								
				@if($type == "link")
					<td> <a href="#" data-toggle="modal" data-target="#detailModal" 
						data-detail="{{json_encode($model->fullData())}}"> 
						{{ $model->fullData()[$label] }}
						</a>
					</td>	
				@elseif($type == "text")
					<td> {{ $model->fullData()[$label] }}</td>
										
				@endif
				
			@endforeach
			
			<td>
				<a href="{{ route('admin.'. $data['controllerRouteName'] .'.edit', $model) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
			</td>
			
		</tr>	
		@endforeach
				
	</table>