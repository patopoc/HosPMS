<table class="table table-striped">
		<h3>{{$data['role']->name}}</h3>
		<tr>
			<th>Module</th>
			<th>Show</th>
			<th>Insert</th>
			<th>Update</th>
			<th>Delete</th>
			
		</tr>
				
		@foreach ($data['modules'] as $module)
		<tr>
			<td> {{$module->name or ''}}</td>
			<td>
				@if($data['role']->roleDetails->where('id_module',$module->id)->first() !== null)
					{!! Form::checkbox($module->id . '[]',"mod_show" ,$data['role']->roleDetails->where('id_module',$module->id)->first()->mod_show)!!}
				@else
					{!! Form::checkbox($module->id . '[]',"mod_show" , false) !!}
				@endif
				<input type="hidden" name="{{$module->id . '[]'}}" value="">
			</td>
			<td>
				@if($data['role']->roleDetails->where('id_module',$module->id)->first() !== null)
					{!! Form::checkbox($module->id . '[]',"mod_insert" ,$data['role']->roleDetails->where('id_module',$module->id)->first()->mod_insert)!!}
				@else
					{!! Form::checkbox($module->id . '[]',"mod_insert" , false) !!}
				@endif
				<input type="hidden" name="{{$module->id . '[]'}}" value="">
			</td>
			<td>
				@if($data['role']->roleDetails->where('id_module',$module->id)->first() !== null)
					{!! Form::checkbox($module->id . '[]',"mod_update" ,$data['role']->roleDetails->where('id_module',$module->id)->first()->mod_update)!!}
				@else
					{!! Form::checkbox($module->id . '[]',"mod_update" , false) !!}
				@endif
				<input type="hidden" name="{{$module->id . '[]'}}" value="">
			</td>
			<td>
				@if($data['role']->roleDetails->where('id_module',$module->id)->first() !== null)
					{!! Form::checkbox($module->id . '[]',"mod_delete" ,$data['role']->roleDetails->where('id_module',$module->id)->first()->mod_delete)!!}
				@else
					{!! Form::checkbox($module->id . '[]',"mod_delete" , false) !!}
				@endif
				<input type="hidden" name="{{$module->id . '[]'}}" value="">
			</td>
			</tr>
		@endforeach
				
	</table>