@section('scripts')

<script type="text/javascript">

jsonData= "{{json_encode($data['bookingsByMonth'])}}";
biggestValue= {{$data['biggestValue']}};
jsonData= jsonData.replace(/&quot;/g,"\"")
jsonData= JSON.parse(jsonData);

var graphdef = {
	    categories : ['Bookings'],
	    dataset : {
	        'Bookings' : jsonData
	    }
	};

var config= {
		graph:{
			orientation: 'Vertical',
			custompalette: ['orange']
		},
		axis: {
			ticks: biggestValue
		},
		tooltip:{
			show: false
		},
		effects:{
			hovercolor: 'orange'
		}		
};

var chart = uv.chart('Bar', graphdef, config);

$(document).ready(function(){	
	
	/*jsonData= "{{json_encode($data['bookingsByMonth'])}}";
	jsonData= jsonData.replace(/&quot;/g,"\"")
	jsonData= JSON.parse(jsonData);
	new Morris.Bar({
		  // ID of the element in which to draw the chart.
		  element: 'bookings-chart',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: jsonData,
		  // The name of the data record attribute that contains x-values.
		  xkey: 'month',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['val'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: []
		});*/

	
	
});
</script>
@endsection
