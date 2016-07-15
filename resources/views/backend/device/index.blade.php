@extends('backend.layouts.default')

@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Devices</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">My Devices</div>
									<div class="panel-body">

										<table id="devices" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
					                            <tr>
					                                <th>Name</th>
					                                <th>Type</th>
					                                <th>Output Enabled</th>
					                                <th>Created At</th>
					                                <th>Board Name</th>
					                                <th>Current Value</th>
					                                <th>Active</th>
					                                <th>Actions</th>
					                            </tr>
					                        </thead>
										</table>
										
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
	    var devices = '{{ route('device.table') }}';
	    var reqTable = $('#devices').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": devices,
	        
	    });
	});
</script>
@stop