<div id="confirm-delete"></div>

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
	
	getPersonData= function(id){
		
		var route= "{{route('peopleSearch')}}";
	    route= route.replace("%7Bci%7D",id);
	    console.log("url: " + route);
		$.get(route, function(data){
			console.log(data);
			if(data !== null && data !==''){
				var person= $.parseJSON(data);
				$("#ci").val(person.ci);
				$("#name").val(person.name);
				$("#last_name").val(person.last_name);
				$("#email").val(person.email);
				$("#telephone").val(person.telephone);
				$("#id_country").val(person.id_country);
			}
			
		});
	};

	$("#ci").focusout(function(){
        getPersonData($(this).val());
    });

});
</script>
@endsection
