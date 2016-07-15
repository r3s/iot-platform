<input id="switch" type="checkbox" data-size="large" @if($device->currentVal()) checked @endif data-toggle="toggle">

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#switch").bootstrapToggle();
		$("#switch").change(function(){
				var route = '{{route('device.changeval', $device->id)}}';
				var check = $(this).prop('checked');
				$.get(route, {value:check}, function(data){
					if(data.status != 'success'){
						$("#switch").bootstrapToggle('off');
					}
				});	
		});

		function poll(){
			var route = '{{route('device.getval',$device->id)}}';
			// $.get(route,function(data){
			// 	if(data.value != null || data.value != undefined){
			// 		if(data.value == 'true')
			// 			$("#switch").bootstrapToggle('on');
			// 		else
			// 			$("#switch").bootstrapToggle('off');
			// 	}
			// });
			var val = '{{$device->currentVal()}}';
			console.log(val);
			setTimeout(poll,1000);
		}

		setTimeout(poll, 1000);
	})
</script>
@stop