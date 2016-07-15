<input type="text" class="span2 slider slider-horizontal" id="slider" value="" data-slider-min="0" data-slider-max="100" data-slider-step="10" data-slider-value="{{ ($device->currentVal() || 10)}}" data-slider-orientation="horizontal" data-slider-selection="after"data-slider-tooltip="hide">

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
		var route = '{{route('device.changeval', $device->id)}}';
		var slider = $("#slider").slider()
					.on('slideStop',function(){
						var val = $("#slider").data('slider').getValue();
						$.get(route, {value:val}, function(data){
							if(data.status != 'success'){
								$("#slider").slider();
							}
						});	
					});

		function poll(){
			var route = '{{route('device.getval',$device->id)}}';
			$.get(route,function(data){
				if(data.value != null || data.value != undefined){
					$("#slider").slider('setValue',data.value);
				}
			});
			setTimeout(poll, 1000);
		}

		setTimeout(poll, 1000);
	})
</script>
@stop