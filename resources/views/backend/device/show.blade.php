@extends('backend.layouts.default')

@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Device Details</div>
									<div class="panel-body">
										<table class="display table table-striped table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{$device->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Topic</td>
                                                    <td>{{$device->topic}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Device Type</td>
                                                    <td>{{$device->type()}}</td>
                                                </tr>
                                                <tr>
                                                	<td>Output Enabled</td>
                                                	<td>
                                                		@if($device->output_enabled)
                                                		Yes
                                                		@else
                                                		No
                                                		@endif
                                                	</td>
                                                </tr>
                                                <tr>
                                                	<td>Board</td>
                                                	<td>{{$device->board->name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
										
										<div id="legendDiv"></div>
									</div>
								</div>
							</div>
						</div>



						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">History</div>
									<div class="panel-body">
										

										
										<div id="legendDiv"></div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">Update</div>
									<div class="panel-body value-change">
										
										@include('snippets.switch',['device'=>$device])
										<div id="legendDiv"></div>
									</div>
								</div>
							</div>

						</div>


					</div>
				</div>

			</div>
		</div>
@stop

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
	    var boards = '{{ route('board.table') }}';
	    var reqTable = $('#boards').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": boards,
	        
	    });
	});
</script>
@stop