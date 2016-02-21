<div id="confirm-delete"></div>

@section('scripts')
<script type="text/javascript">

$(document).ready(function(){

	/*var propertyCounter=0;	

	addProperty= function(el){

		var elName= el.name.split('property');
		//console.log(elName[1]);
		if(elName[1] >= propertyCounter){
			propertyCounter++;
			var selectElem='{!! Form::select("prop", ["" => "Select a Service"] + $data["properties"], null, ["class" => "form-control", "onchange"=>"addProperty(this);"]) !!}';
			selectElem= selectElem.replace('prop','property' + propertyCounter);
			
			$("#properties-container").append('<div class="form-group">' + selectElem + "</div>");	
		}
	};*/
	
	$('#check_in').datetimepicker({
		format: 'YYYY/MM/DD'
	});
	$('#check_out').datetimepicker({
		format: 'YYYY/MM/DD'
	});
	
	$('#arrival_time').datetimepicker({
		format:'LT'
	});
	
    $("#ci").focusout(function(){
        var route= "{{route('peopleSearch')}}";
        route= route.replace("%7Bci%7D",$(this).val());
        console.log("route: " + route);
		$.get(route, function(data){
			console.log(data);
			if(data !== null && data !==''){
				var person= $.parseJSON(data);
				$("#name").val(person.name).attr("readonly",true);
				$("#last_name").val(person.last_name).attr("readonly",true);
				$("#email").val(person.email).attr("readonly",true);
				$("#telephone").val(person.telephone).attr("readonly",true);
				$("#id_country").val(person.id_country).attr("readonly",true);
			}
			
		});
    });
});
</script>
@endsection
