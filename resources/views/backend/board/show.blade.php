@extends('backend.layouts.default')

@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Board Details</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Board Details</div>
									<div class="panel-body">
										<table class="display table table-striped table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{$board->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Key</td>
                                                    <td>{{$board->key}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Board Password</td>
                                                    <td>{{$board->password}}</td>
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
									<div class="panel-heading">Connected Devices</div>
									<div class="panel-body">
										@if(count($board->devices)>0)
										<table class="display table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Name</th>
													<th>Type</th>
													<th>Created At</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($board->devices as $device)
													<tr>
														<td>{{$device->name}}</td>
														<td>{{$device->display_type}}</td>
														<td>{{$device->created_at}}</td>
														<td>
															<a href="{{route('device.show',$device->id)}}" class="btn btn-primary btn-circle">
																<i class="fa fa-search-plus"></i>
															</a>
														</td>
													</tr>	
												@endforeach
											</tbody>
										</table>

										@else
										<p>No data to display</p>
										@endif

										<a href="{{route('device.create')}}" class="btn btn-primary">Create a new device connected to this board</a>
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