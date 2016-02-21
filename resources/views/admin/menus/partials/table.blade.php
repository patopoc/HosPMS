
		@foreach($menu as $menuSection)
		<div class="row" data-id="{{$menuSection['section']->id}}" >			
	    	<div class="col-lg-12" >
            	<div class="nav div-table-head">
	            	<span><i class="fa {{$menuSection['section']->icon}} fa-fw"></i> {{$menuSection['section']->description}}</span>
	            	<a href="{{ route('admin.menus.edit', $menuSection['section']->id) }}" 
	            		class='btn btn-warning btn-sm pull-right' role='button'>
	            		<span class="glyphicon glyphicon-pencil"></span>
	            	</a>
            	</div>
                	@foreach($menuSection['items'] as $menuItem)
	                	<div class="row" data-id="{{$menuItem->id}}" style="padding-bottom:5px;">
	                    	<div class="col-lg-11 col-lg-offset-1 vertical-align">
	                        	<div class="nav div-table-child">
	                        	<span><i class="fa {{$menuItem->icon}}  fa-fw"></i>{{$menuItem->description}}</span>
	                    
	                        	<a href="{{ route('admin.menus.edit', $menuItem->id) }}" 
	                        		class='btn btn-warning btn-sm pull-right' role='button'
	                        		style="margin-left:5px">
	                        		<span class="glyphicon glyphicon-pencil"></span>
	                        	</a>
								<a href="#" class="btn-delete btn btn-danger btn-sm pull-right" 
									role='button' style="margin-left:5px">
									<span class="glyphicon glyphicon-minus-sign"></span>
								</a>
								</div>
	                        </div>	                        
	                   </div>
	                   
                    @endforeach
	        </div>	        
	        
		</div>					
		@endforeach	
				
