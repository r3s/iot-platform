<input id="switch" type="checkbox" data-size="large" @if($device->currentVal()) checked @endif data-toggle="toggle">

<br><br>

<div >
	<p>Current Value: <span id="curValue"></span></p>
</div>

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
		//Create toggle btn
		$("#switch").bootstrapToggle();

		//get current value
		var prevVal = $("#switch").prop('checked');

		//on change
		$("#switch").change(function(){
				//get new value
			var check = $(this).prop('checked');
			//if old value and new val are different
			if(check != prevVal){
				//do a get requet to update value
				var route = '{{route('device.changeval', $device->id)}}';
				$.get(route, {value:check}, function(data){
					//if response is not success
					if(data.status != 'success'){
						// make btn back to old state
						if(prevVal)
							$("#switch").bootstrapToggle('on');
						else
							$("#switch").bootstrapToggle('off');
					}
				});
				// set new value as old value
				prevVal = check;	
			}
		});


		function poll(){
			var val1 = '{{$device->currentVal()}}';
			//get current value in db
			var route = '{{route("device.getval",$device->id)}}';
			$.get(route, function(data){
				val1 = String(data.value);
				//get current state of btn
				var check = $('#switch').prop('checked');
				console.log('val1:'+val1, 'check:'+check);
				//if db value is checked and btn is off, turn it on
				if((val1==='true')){
					// $("#switch").bootstrapToggle('disable');
					console.log('if');
					$("#switch").bootstrapToggle('on');
					$("#curValue").val('TRUE');
					// $("#switch").bootstrapToggle('enable');
				}
				else{
					// $("#switch").bootstrapToggle('disable');
					console.log('else');
					$("#switch").bootstrapToggle('off');
					$("#curValue").val('FALSE');
					// $("#switch").bootstrapToggle('disable');
				}
				//timeout
				setTimeout(poll,1000);
			});
			
			
		}

		setTimeout(poll, 1000);
	})
</script>
@stop