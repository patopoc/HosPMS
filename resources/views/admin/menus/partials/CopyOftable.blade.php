<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Actions</th>
			
		</tr>
		@foreach($menu as $menuSection)
		<tr data-id="{{$menuSection['section']->id}}">
			<td>
				
            	<a href="#"><i class="fa {{$menuSection['section']->icon}} fa-fw"></i> {{$menuSection['section']->description}}<span class="fa arrow"></span></a>
                	<table class="table table-striped">
                	@foreach($menuSection['items'] as $menuItem)
	                	<tr data-id="{{$menuItem->id}}">
	                    	<td>
	                        	<a href="#"><i class="fa {{$menuItem->icon}}  fa-fw"></i>{{$menuItem->description}}</a>
	                        </td>
	                        <td>
								<a href="{{ route('admin.menus.edit', $menuItem->id) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="#" class="btn-delete btn btn-danger btn-sm" role='button'><span class="glyphicon glyphicon-minus-sign"></span></a>
							</td>
	                   </tr>
                    @endforeach
                    </table>
                
            </td>
            <td>
				<a href="{{ route('admin.menus.edit', $menuSection['section']->id) }}" class='btn btn-warning btn-sm' role='button'><span class="glyphicon glyphicon-pencil"></span></a>
				
			</td>
		</tr>					
		@endforeach	
				
	</table>