<input id="switch" type="checkbox" data-size="large" @if($device->value) checked @endif data-toggle="toggle">

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#switch").bootstrapToggle();
		$("#switch").change(function(){
				var route = '{{route('device.changeval', $device->id)}}';
				var check = $(this).prop('checked');
				$.get(route, {value:check}, function(data){
					console.log(data.status);
					if(data.status != 'success'){
						setTimeout(function(){$("#switch").bootstrapToggle('off');}, 1000);
					}
				});	
		});
	})
</script>
@stop