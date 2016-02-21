@section('scripts')
<script type="text/javascript">

$(document).ready(function(){
	$('#checkin-time-picker').datetimepicker({
		format:'LT'
	});
	$('#checkout-time-picker').datetimepicker({
		format:'LT'
	});
	
});
</script>
@endsection
