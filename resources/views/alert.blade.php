@if(Session::has('message'))
	@if(Session::has('message_type'))
		@if(Session::get('message_type') == 'success')
			<div id="alert-box" class="alert alert-success alert-dismissible fade in" role="alert">
		@elseif(Session::get('message_type') == 'error')
			<div id="alert-box" class="alert alert-danger alert-dismissible fade in" role="alert">
		@endif
	@else
	<div id="alert-box" class="alert alert-info alert-dismissible fade in" role="alert">	
	@endif
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button> 
		
		{{Session::get('message')}}
		
	</div>
@endif