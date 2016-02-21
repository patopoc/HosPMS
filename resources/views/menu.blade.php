<?php 
use \Hotpms\Helpers\MenuHelper;
$menu= MenuHelper::create();
?>
@section('menu')

<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!-- li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        <!-- /li-->
                                    
                        	
						@foreach($menu as $menuSection)
							<li>
							@if($menuSection['section']->name != 'toplevel')
                            	<a href="#"><i class="fa {{$menuSection['section']->icon}} fa-fw"></i> {{$menuSection['section']->description}}<span class="fa arrow"></span></a>
                            @endif
                            @foreach($menuSection['items'] as $menuItem)
	                            @if($menuSection['section']->name != 'toplevel')
	                            <ul class="nav nav-second-level">
	                            @endif
	                                <li>
	                                    @if($menuItem->route !== '' && Route::has($menuItem->route))
	                                    	<a href="{{route($menuItem->route)}}">
	                                    @else
	                                    	<a href="#">
	                                    @endif
	                                    <i class="fa {{$menuItem->icon}}  fa-fw"></i>{{$menuItem->description}}</a>
	                                </li>
	                            @if($menuSection['section']->name != 'toplevel')
	                            </ul>
	                            @endif
                            @endforeach
                            </li>
							
						@endforeach                        
							
                        </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
@endsection