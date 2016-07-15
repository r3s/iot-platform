<input id="switch" type="checkbox" data-size="large" @if($device->currentVal()) checked @endif data-toggle="toggle">

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#switch").bootstrapToggle();
		var prevVal = $("#switch").prop('checked');
		$("#switch").change(function(){
			var check = $(this).prop('checked');
			if(check != prevVal){
				prevVal = check;
				var route = '{{route('device.changeval', $device->id)}}';
				$.get(route, {value:check}, function(data){
					if(data.status != 'success'){
						$("#switch").bootstrapToggle('off');
					}
				});	
			}
		});

		function poll(){
			var val = '{{$device->currentVal()}}';
			if(val == 'true')
				$("#switch").bootstrapToggle('on');
			else
				$("#switch").bootstrapToggle('off');
			setTimeout(poll,1000);
		}

		setTimeout(poll, 1000);
	})
</script>
@stop